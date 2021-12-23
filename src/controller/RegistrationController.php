<?php
session_start();
require_once 'AppController.php';
require_once __DIR__ . '/../models/RegistrationUser.php';
require_once __DIR__ . '/../repository/RegisterRepository.php';

class RegistrationController extends AppController
{
    private $registerRepository;

    public function __construct()
    {
        parent::__construct();

        session_start();
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
        $salt = random_bytes(64);
        $hashed_salt = password_hash($salt, PASSWORD_BCRYPT);
        return [password_hash($password . $hashed_salt, PASSWORD_BCRYPT), $hashed_salt];
    }
}