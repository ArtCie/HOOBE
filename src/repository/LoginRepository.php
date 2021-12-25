<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class LoginRepository extends Repository
{

    public function select_password_data(string $email)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT 
                password, 
                password_salt 
            FROM 
                public.users 
            WHERE 
                email = :email
        ');

        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}