<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';

class Mail
{
    public function __construct()
    {
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
        $mail->isHTML(true);
    }

    public function SendMail($address, $subject, $body)
    {
        $this->$mail->addAddress($address);
        $this->$mail->Subject = $subject;
        $this->$mail->Body = $body;

        $this->$mail->send();
    }
}
