<?php
session_start();
require_once 'AppController.php';
require_once __DIR__ . '/../models/ValidUser.php';
require_once __DIR__ . '/../repository/RegisterRepository.php';

class RegistrationController extends AppController
{
    private $registerRepository;

    public function __construct()
    {
        parent::__construct();

        $this->registerRepository = new RegisterRepository();
    }

    public function registration()
    {
        if (!$this->isPost()) {
            return $this->render('registration');
        }

        $email = $_SESSION['email'];
        $password = $_POST['password'];
        [$hashed_password, $hashed_salt] = $this->hash_password($password);

        $insert_timestamp =  gmdate("Y/m/d H:i:s");

        $this->registerRepository->registerUser($email, $hashed_password, $hashed_salt, "1", $insert_timestamp);

        return $this->redirect('main_page');
    }

    public function hash_password(string $password){
        $salt = $this->generate_salt();
        $options = [
            'salt' => $salt
        ];
        return [password_hash($password, PASSWORD_BCRYPT, $options), $salt];
    }

    function generate_salt($length = 64): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_-+={}[];:"<>?/.,`~|\'\\';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}