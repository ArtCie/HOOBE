<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/EmailValid.php';
require_once __DIR__ .'/../repository/EmailRepository.php';

class EmailValidController extends AppController {

    private $emailRepository;

    public function __construct()
    {
        parent::__construct();

        session_start();
        $this->emailRepository = new EmailRepository();
    }

    public function email()
    {

        $email = $_POST['email'];
        $_SESSION["email"] = $email;

        if($this->isGet()){
            return $this->render('email');
        }

        if(!$this->checkEmailAddress($email)){
            return $this->render('email', ['message'=>'This email doesn\'t make sense XD']);
        }

        $user_id = $this->emailRepository->checkIfUserExist($email);
        if(!$user_id) {
            return $this->redirect('registration');
        }

        $_SESSION["user_id"] = $user_id;
        return $this->redirect('login');
    }

    public function checkEmailAddress(string $email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}