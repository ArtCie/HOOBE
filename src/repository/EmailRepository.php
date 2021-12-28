<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class EmailRepository extends Repository
{

    public function checkIfUserExist(string $email): ?int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT id as user_id FROM public.users WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result["user_id"];
    }
}