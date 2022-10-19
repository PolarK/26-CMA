<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

$mail = new PHPMailer(true);
$mail->SMTPDebug = SMTP::DEBUG_SERVER;
$mail->isSMTP();
$mail->Host = 'smtp-mail.outlook.com';
$mail->SMTPAuth = true;
$mail->Username = 'csms-26@outlook.com';
$mail->Password = 'Qw3rty@123';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
$mail->setFrom('csms-26@outlook.com');
$mail->addAddress('102561444@student.swin.edu.au');
$mail->isHTML(true);
$mail->Subject = 'test';
$mail->Body = 'test';
$mail->send();
?>