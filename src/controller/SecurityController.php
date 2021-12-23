<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/User.php';

class SecurityController extends AppController {

    public function login()
    {
        $user = new User('jsnow@pk.edu.pl');

        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($user->getEmail() !== $email) {
            $this->render('login', ['messages' => ['User with this email not exist!']]);
        }
        else if ($user->getPassword() !== $password) {
            $this->render('login', ['messages' => ['Wrong password!']]);
        }
        else {
            $this->render('main_page');
        }
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/projects");
    }
}