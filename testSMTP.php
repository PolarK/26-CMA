<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once "./classes/mail.class.php";
/*
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
*/

$mail = new Mail();

$mail->SendMail(
    '102561444@student.swin.edu.au',
    'Whatz Cookin',
    'I am there for the test testing android servers and the test servers are running on different machines.'
);


?>