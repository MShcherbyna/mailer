<?php
namespace App;

use App\Src\Mailer;
use App\Src\View;
use App\Src\Validation;

class App
{
    protected $mailer;

    protected $view;

    protected $path;

    protected $request;

    protected $validation;

    public function __construct()
    {
        $this->mailer = new Mailer();
        $this->view = new View();
        $this->validation = new Validation();
        $this->path = $_SERVER['REQUEST_URI'];
        $this->request = $_REQUEST;
        session_start();
    }

    public function run(): void
    {
        switch ($this->path) {
            case '/':
                $this->view->render('index', ['title' => 'Home Page']);
            break;
            case '/send':
                unset($_SESSION['errors']);
                unset($_SESSION['success']);
                $this->dispatch();
                header('location:' . $_SERVER['HTTP_REFERER']);
            break;
            default:
                $this->view->render('not_found', ['title' => 'Page Not Found', 'data' => 'Page Not Found']);
        }
    }

    protected function dispatch(): void
    {
        $email_errors = [];
        $name_errors = [];
        $send_mail_errors = [];
        $send_mail_success = [];

        for ($i = 0; $i < count($this->request['email']); $i++) {
            $name = $this->validation->validate_name($this->request['name'][$i]);
            $email = $this->validation->validate_email($this->request['email'][$i]);

            if ($email !== true) {
                $email_errors[] = $email;
                continue;
            };

            if ($name !== true) {
                $name_errors[] = $name;
                continue;
            };

            if ($this->mailer->sendMail($this->request['name'][$i], $this->request['email'][$i], 'new_year')) {
                $send_mail_success[] = 'Email sent successfully, [' . $this->request['email'][$i] . ']';
            } else {
                $send_mail_errors[] = 'Email not sent, [' . $this->request['email'][$i] . ']';
            }
        }

        if (!empty($email_errors)) {
            $_SESSION['errors']['email'] = $email_errors;
        }
 
        if (!empty($name_errors)) {
            $_SESSION['errors']['name'] = $name_errors;
        }

        if (!empty($send_mail_errors)) {
            $_SESSION['errors']['result'] = $send_mail_errors;
        }

        if (!empty($send_mail_success)) {
            $_SESSION['success'] = $send_mail_success;
        }
    }

}