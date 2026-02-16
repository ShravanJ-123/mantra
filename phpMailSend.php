<?php

// Include PHPMailer classes
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Get data from URL query parameters
$name = isset($_REQUEST['name']) ? trim($_REQUEST['name']) : null;
$phone = isset($_REQUEST['phone']) ? trim($_REQUEST['phone']) : null;
$email = isset($_REQUEST['email']) ? trim($_REQUEST['email']) : null;
$projectName = isset($_REQUEST['projectName']) ? trim($_REQUEST['projectName']) : null;

// Validate required fields
if (empty($name) || empty($phone) || empty($email) || empty($projectName)) {
    die("Error: Missing required fields (name, phone, email, or projectName).");
}

// Email content
$to = "contactrkrealtysolutions@gmail.com"; // Recipient email address
$cc = "abhijitsarvade39@gmail.com";  // CC recipient
$subject = "Mantra-home inquiry by $name";
$body = "
You have received a new inquiry:
- Name: $name
- Phone: $phone
- Email: $email
- Project Name: $projectName
";

try {
    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    // SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.hostinger.com';         // Hostinger SMTP server
    $mail->SMTPAuth = true;                     // Enable SMTP authentication
    $mail->Username = 'info@mirarimundhwa.com'; // Your Hostinger email
    $mail->Password = 'Info@@##123';            // Your email password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
    $mail->Port = 587;                          // TCP port for TLS

    // Email headers and content
    $mail->setFrom('info@mirarimundhwa.com', 'Mantra-home'); // Sender address
    $mail->addAddress($to);                    // Add recipient
    $mail->addCC($cc);                         // Add CC recipient
    $mail->addReplyTo($email, $name);          // Reply-to address

    $mail->Subject = $subject;
    $mail->Body = $body;

    // Enable debugging for troubleshooting
    $mail->SMTPDebug = 0; // Set to 2 for verbose output, 0 for production

    // Send the email
    if ($mail->send()) {
        echo "Email sent successfully to $to.";
    } else {
        echo "Failed to send email.";
    }
} catch (Exception $e) {
    // Display error message with debugging info
    echo "Error sending email: " . $mail->ErrorInfo;
}
?>
