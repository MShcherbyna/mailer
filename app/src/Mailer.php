<?php
namespace App\Src;

use App\Src\View;
use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;

class Mailer
{
    protected $mailer;

    public function __construct()
    {
        $transport = (new Swift_SmtpTransport(getenv('SMTP_HOST'), getenv('SMTP_PORT'), getenv('SMTP_ENCRYPTION')))
            ->setUsername(getenv('SMTP_USER'))
            ->setPassword(getenv('SMTP_PASSWORD'));
        
        $this->mailer = new Swift_Mailer($transport);
        $this->view = new View();
    }
    
    public function sendMail(string $name, string $email, string $template)
    {
        return $this->mailer->send($this->prepareMail($name, $email, $template));
    }

    protected function prepareMail(string $name, string $email, string $template): Swift_Message
    {
        return (new Swift_Message('Heppy New Year'))
            ->setFrom([getenv('SMTP_FROM')])
            ->setTo([$email => $name])
            ->setBody($this->view->add_template($template, ['name' => $name]), 'text/html');
    }

}