<?php

namespace dwes\app\utils;

use dwes\core\App;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use dwes\app\exceptions\MailException;

class MyMail
{
    private $mail;
    public function __construct()
    {
        $this->mail = new PHPMailer;
    }
    public function send($mailFrom, $nombre, $asunto, $texto)
    {
        $config = App::get('config')['mailer'];
        $this->mail->isSMTP();
        $this->mail->SMTPDebug = 2; // Pasar a 0 en producción y a 2 en desarrollo
        $this->mail->Host = $config['smtp_server'];
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Habilitar el cifrado TLS
        $this->mail->SMTPAuth = true;
        $this->mail->Port = $config['smtp_port'];
        $this->mail->Username = $config['username'];
        $this->mail->Password = $config['password'];
        $this->mail->setFrom($mailFrom, $nombre);
        $this->mail->addAddress($config['email'], $config['nombre']);
        $this->mail->Subject = $asunto;
        $this->mail->Body = $texto;
        if (!$this->mail->send()) {
            echo 'Mailer Error: ' . $this->mail->ErrorInfo;
            throw new MailException('No se ha podido enviar el mensaje');
        }
    }
}
