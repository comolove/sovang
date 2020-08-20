<?php

require_once __DIR__ . '/..' . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/..', '.php_env');
$dotenv->load();

class MailSender
{
    private $mail;
    private $host = "";
    private $username = "";
    private $password = "";
    private $sender = "";
    private $port = 0;

    private $error;

    public function __construct()
    {
        $this->mail = new PHPMailer\PHPMailer\PHPMailer();

        $this->host = $_ENV["MAIL_HOST"];
        $this->port = $_ENV["MAIL_PORT"];
        $this->username = $_ENV["MAIL_USERNAME"];
        $this->password = $_ENV["MAIL_PASSWORD"];
        $this->sender = $_ENV["MAIL_SENDER"];
    }

    public function SendTo($to, $subject, $body, $attachmentArr)
    {
        $this->mail->isSMTP();
        $this->mail->CharSet = 'utf-8';
        $this->mail->Host = $this->host;
        $this->mail->SMTPAuth = true;
        $this->mail->Username = $this->username;
        $this->mail->Password = $this->password;
        $this->mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
        $this->mail->Port = $this->port;

        $this->mail->setFrom($this->sender);
        $this->mail->addAddress($to);

        for ($i = 0 ; $i < count($attachmentArr) ; $i++)
        {
            $this->mail->addAttachment($attachmentArr[$i]);
        }

        $this->mail->isHTML(true);
        $this->mail->Subject = $subject;
        $this->mail->Body = $body;
        $this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if ($this->mail->send()) 
        {
            return TRUE;
        }
        else 
        {
            $this->error = $this->mail->ErrorInfo;
            return FALSE;
        }
    }

    public function GetError()
    {
        return $this->error;
    }
}

?>