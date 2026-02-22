<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.yourserver.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'your@email.com';
    $mail->Password = 'your_password';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('shravanjare@email.com', 'Chatbot');
    $mail->addAddress('your@email.com'); 

    // Body content from AJAX POST
    $body = "";
    foreach ($_POST as $key => $value) {
        $body .= ucfirst($key) . ": " . $value . "\n";
    }

    $mail->Subject = "New Chatbot Submission";
    $mail->Body = $body;

    $mail->send();
    echo "Mail sent successfully";
} catch (Exception $e) {
    echo "Mail could not be sent. Error: {$mail->ErrorInfo}";
}

