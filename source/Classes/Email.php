<?php

namespace Source\Classes;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    /**
     * @var PHPMailer
     */
    private $mailer;

    private $data;

    private $message;

    public function __construct()
    {
        $this->mailer = new PHPMailer(true);
        $this->mailer->isSMTP();
        $this->mailer->SMTPSecure = $this->mailer::ENCRYPTION_STARTTLS;
        $this->mailer->setLanguage("br");
        $this->mailer->CharSet = EMAIL_CHARSET;
        $this->mailer->isHTML(true);
        $this->mailer->SMTPAuth = true;
        $this->mailer->Host = EMAIL_SERVER;
        $this->mailer->Username = EMAIL_USERNAME;
        $this->mailer->Password = EMAIL_PASSWORD;
        $this->mailer->Port = EMAIL_PORT;
        $this->message = new \StdClass();
    }

    public function boostrap(string $subject, string $message, string $toEmail, string $toName): Email
    {
        $this->data = new \StdClass();
        $this->data->subject = $subject;
        $this->data->message = $message;
        $this->data->toEmail = $toEmail;
        $this->data->toName = $toName;
        return $this;
    }

    public function attach(string $filePath, string $fileName): Email
    {
        $this->data->attach[$filePath] = $fileName;
        return $this;
    }


    public function send($fromEmail = EMAIL_SENDER['adress'], $fromName = EMAIL_SENDER['name']): string
    {
        if (empty($this->data)) {
            $this->message->error("Erro ao enviar, favor verifique os dados");
            return false;
        }

        try {
            $this->mailer->Subject = $this->data->subject;
            $this->mailer->msgHTML($this->data->message);
            $this->mailer->addAddress($this->data->toEmail, $this->data->toName);
            $this->mailer->setFrom($fromEmail, $fromName);
            if (!empty($this->data->attach)) {
                foreach ($this->data->attach as $path => $name) {
                    $this->mailer->addAttachment($path, $name);
                }
            }
            if (!$this->mailer->send()) {
                $this->message->error = "Falha ao enviar email";
                return $this->message->error;
            }
            return $this->message->sucess = "Email enviado com sucesso";
        } catch (Exception $exception) {
            $this->message->error($exception->getMessage());
            return false;
        }
    }
}