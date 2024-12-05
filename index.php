<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

function getRealIpAddr() {
    $headers = [
        'HTTP_CLIENT_IP',
        'HTTP_X_FORWARDED_FOR',
        'HTTP_X_FORWARDED',
        'HTTP_X_CLUSTER_CLIENT_IP',
        'HTTP_FORWARDED_FOR',
        'HTTP_FORWARDED',
        'REMOTE_ADDR'
    ];

    foreach ($headers as $header) {
        if (isset($_SERVER[$header]) && filter_var($_SERVER[$header], FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
            return $_SERVER[$header];
        }
    }

    return $_SERVER['REMOTE_ADDR'];
}

$ip = getRealIpAddr();
$cache_file = "cache/{$ip}.txt";
$log_file = 'logs.csv';
if (!file_exists($log_file)) {
  // Create the file and write the headers if it does not exist.
  $headers = "IP,ISP,Type,Country,Timestamp\n";
  file_put_contents($log_file, $headers);
}

class Bot {
    const api1 = "https://blackbox.ipinfo.app/lookup/";
    const api2 = "http://check.getipintel.net/check.php?ip=";
    const api3 = "https://ip.teoh.io/api/vpn/";
    const api4 = "http://proxycheck.io/v2/";
    const api5 = "https://v2.api.iphub.info/guest/ip/";
    const api6 = "https://ipleak.net/json";
    const block = "BLOCK";
    const allow = "ALLOW";
    
    private function __curl($url) {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Return the transfer as a string
      curl_setopt($ch, CURLOPT_HEADER, 0); // Don’t return header in output
      $output = curl_exec($ch);
      if (curl_errno($ch)) {
          return false;
      }
      curl_close($ch);
      return $output;
    }
    
    private function __jsondecode($json) {
        return json_decode($json);
    }

    // Proxy checking functions (same as existing)
    public function proxy1($ip) {
        $url = self::api1 . $ip;
        $response = $this->__curl($url);
        if($response === false) {
            return self::allow;
        }
        return $response == "Y" ? self::block : self::allow;
    }

    public function proxy2($ip) {
        $url = self::api2 . $ip . "&contact=yourEmail" . rand(1999999, 19999999) . "@domain.com";
        $response = $this->__curl($url);
        if($response === false || !is_numeric($response)) {
            return self::allow;
        }
        return ((float)$response >= 0.99) ? self::block : self::allow;
    }

    public function proxy3($ip) {
        $url = self::api3 . $ip;
        $response = $this->__curl($url);
        if($response === false) {
            return self::allow;
        }
        $json = $this->__jsondecode($response);
        return (isset($json->risk) && $json->risk == "high") ? self::block : self::allow;
    }

    public function proxy4($ip) {
        $url = self::api4 . $ip . "&risk=1&vpn=1";
        $response = $this->__curl($url);
        if($response === false) {
            return self::allow;
        }
        $json = $this->__jsondecode($response);
        return (isset($json->status) && $json->status == "ok" && isset($json->$ip->proxy) && $json->$ip->proxy == "yes") ? self::block : self::allow;
    }

    public function proxy5($ip) {
      $url = self::api5 . $ip . "?c=" . md5(rand(0, 11));
      $response = $this->__curl($url);
      if($response === false) {
          return self::allow;
      }
      $json = $this->__jsondecode($response);
      return (isset($json->block) && $json->block == 1) ? self::block : self::allow;
    }

    public function checkcountry($ip) {
      $url = "http://ipinfo.io/{$ip}/json";
      $response = $this->__curl($url);
      $json = $this->__jsondecode($response);
      return $json;
    }
}

// Check if the IP is a bot
function isBot($bot, $ip) {
    if ($bot->proxy1($ip) == Bot::block) return true;
    if ($bot->proxy2($ip) == Bot::block) return true;
    if ($bot->proxy3($ip) == Bot::block) return true;
    if ($bot->proxy4($ip) == Bot::block) return true;
    if ($bot->proxy5($ip) == Bot::block) return true;
    return false;
}

if (!is_dir('cache')) {
  mkdir('cache');
}

if (file_exists($cache_file) && (time() - filemtime($cache_file)) < 3600) {
  $is_bad_ip = file_get_contents($cache_file) === '1';
} else {
  $bot = new Bot();
  $is_bad_ip = isBot($bot, $ip);
  $is_human = !$is_bad_ip ? 'human' : 'bot';

  // Append a log entry
  $jsoni = $bot->checkcountry($ip);
  $isp = isset($jsoni->org) ? $jsoni->org : 'Unknown';
  $country = isset($jsoni->country) ? $jsoni->country : 'Unknown';

  // Append a log entry
  $timestamp = date("Y-m-d H:i:s");
  $log_entry = "$ip,$isp,$is_human,$country,$timestamp\n";
  file_put_contents($log_file, $log_entry, FILE_APPEND);
  file_put_contents($cache_file, $is_bad_ip ? '1' : '0');
}

$log_entries = file($log_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$human_count = 0;
$bot_count = 0;
$log_html = '';

foreach($log_entries as $entry) {
  list($ip, $isp, $type, $country, $timestamp) = explode(',', $entry);
  if(trim($type) == 'human') $human_count++;
  if(trim($type) == 'bot') $bot_count++;
  $log_html .= "<div class='log-entry'>
                  <span class='timestamp'>$timestamp</span>
                  <span class='ip'>$ip</span>
                  <span class='isp'>$isp</span>
                  <span class='type $type'>$type</span>
                  <span class='country'>$country</span>
                </div>";
}

// Discord Webhook for notifications when a bot is detected
if ($is_bad_ip) {
    $discord_webhook_url = "https://discord.com/api/webhooks/1314060980216397834/6oTvISKAwap2feJ3eGci4kyVimOWZgPLIi5m3e6QtPNVtBhEyUTFZ_iQkJSTg4ANN8tL";
    $message = "⚠️ **Bot detected!**\n\n**IP:** $ip\n**ISP:** $isp\n**Country:** $country\n**Time:** $timestamp";
    $data = array("content" => $message);

    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
        ),
    );
    $context = stream_context_create($options);
    file_get_contents($discord_webhook_url, false, $context);

    // Display access denied page
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <title>Access Denied</title>
        <style>
            body {
                font-family: 'Arial', sans-serif;
                background-color: #f4f4f4;
                text-align: center;
                padding-top: 20%;
            }
            .message {
                background-color: #ffcccc;
                padding: 20px;
                display: inline-block;
                border: 1px solid red;
            }
        </style>
    </head>
    <body>
        <div class='message'>Access Denied: We don't accept people from your location. Please try later or disable any VPN if you are using it!</div>
    </body>
    </html>";
    exit();
} else {
    header('Location: ./MT
