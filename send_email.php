<?php
require 'vendor/autoload.php'; // Path to PHPMailer autoload file

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Check for form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $subject = $_POST["subject"];
  $message = $_POST["message"];

  $mail = new PHPMailer(true);

  try {
    // Configure the SMTP settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'your-email@gmail.com'; // Your Gmail email address
    $mail->Password = 'your-password'; // Your Gmail password
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Set the sender and recipient
    $mail->setFrom($email, $name);
    $mail->addAddress('recipient-email@gmail.com'); // Recipient email address

    // Set email content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = "<h3>Message from $name ($email)</h3><p>$message</p>";

    // Send the email
    $mail->send();

    echo 'Email sent successfully!';
  } catch (Exception $e) {
    echo "Email could not be sent. Error: {$mail->ErrorInfo}";
  }
}
?>
