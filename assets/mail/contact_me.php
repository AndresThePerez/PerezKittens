<?php
// Check for empty fields
if(empty($_POST['name'])      ||
   empty($_POST['email'])     ||
   empty($_POST['phone'])     ||
   empty($_POST['message'])   ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
   echo "No arguments Provided!";
   return false;
   }
   
$name = strip_tags(htmlspecialchars($_POST['name']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$message = strip_tags(htmlspecialchars($_POST['message']));
   
require "../../phpmailer/includes/PHPMailer.php";
require "../../phpmailer/includes/SMTP.php";
require "../../phpmailer/includes/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer();

$mail->isSMTP();

$mail->Host = "smtp.gmail.com";

$mail->SMTPAuth = true;

$mail->SMTPSecure = "tls";

$mail->Port = "587";

$mail->Username = "";

$mail->Password = "";

$mail->Subject = "New Contact Us Request from www.perezkittens.com";

$mail->setFrom("");

$mail->isHTML(true);

$mail->Body = "<p><h1>Name: </h1> ".$name."</p><br><p><h1>Email: </h1> ".$email_address."</p><br><p><h1>Phone: </h1> ".$phone."</p><br><p><h1>Message: </h1> ".$message."</p><br>";

$mail->addAddress("");

if ( $mail->Send() ) {
   echo "Email Sent..!";
} else {
   Echo "error";
}

$mail->smtpClose();
return true;         
?>