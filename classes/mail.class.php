<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require './vendor/autoload.php';

class Mail
{
    private $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp-mail.outlook.com';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'csms-26@outlook.com';
        $this->mail->Password = 'Qw3rty@123';
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->Port = 587;
        $this->mail->setFrom('csms-26@outlook.com');
    }

    public function SendMail($address, $subject, $body)
    {
        $this->mail->addAddress($address);
        $this->mail->Subject = $subject;
        $this->mail->Body = $body;

        $this->mail->send();
    }
}
