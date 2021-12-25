<?php
session_start();
require_once 'AppController.php';
require_once __DIR__ .'/../models/ValidUser.php';
require_once __DIR__ .'/../repository/LoginRepository.php';

class LoginController extends AppController {

    private $login_repository;

    public function __construct()
    {
        parent::__construct();

        $this->login_repository = new LoginRepository();
    }

    public function login()
    {

        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_SESSION['email'];
        $password = $_POST['password'];

        $user = new ValidUser($email, $password);

        if($this->valid_password($user)){
            $this->redirect('main_page');
        }

        $this->render('login');
    }

    public function valid_password(ValidUser $user): bool
    {
        $result =  $this->login_repository->select_password_data($user->getEmail());
        return $this->is_valid($result["password"], $result["password_salt"], $user);
    }

    private function is_valid($password, $salt, $user): bool
    {
        $options = [
            'salt' => $salt
        ];

        return password_hash($user->getPassword(), PASSWORD_BCRYPT, $options) == $password;
    }
}