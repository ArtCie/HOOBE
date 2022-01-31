<?php
session_start();
require_once 'AppController.php';
require_once __DIR__ .'/../models/ValidUser.php';
require_once __DIR__ .'/../repository/LoginRepository.php';
require_once __DIR__ .'/../repository/UserRepository.php';

class LoginController extends AppController {

    private $login_repository;
    private $userRepository;

    public function __construct()
    {
        parent::__construct();

        $this->login_repository = new LoginRepository();
        $this->userRepository = new UserRepository();
    }

    public function login(): void
    {

        if (!$this->isPost()) {
            $this->render('login');
        }

        $email = $_SESSION['email'];
        $password = $_POST['password'];

        $user = new ValidUser($email, $password);


        $result = $this->valid_password($user);
        if($result["passwordValid"]){
            $account_type = $this->userRepository->selectAccountType($result["id"]);
            if($account_type == 'admin'){
                $this->redirect('admin');
            }
            else{
            $this->redirect('main_page');
            }
        }

        $this->render('login');
    }

    public function valid_password(ValidUser $user)
    {
        $result =  $this->login_repository->select_password_data($user->getEmail());
        return ["id" => $result["id"], "passwordValid" => $this->is_valid($result["password"], $result["password_salt"], $user)];
    }

    private function is_valid($password, $salt, $user): bool
    {
        $options = [
            'salt' => $salt
        ];

        return password_hash($user->getPassword(), PASSWORD_BCRYPT, $options) == $password;
    }
}