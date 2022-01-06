<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Settings.php';

class SettingsRepository extends Repository
{

    public function getSettings(int $id)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT email, birthday FROM public.users WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return new Settings($result["email"], $result["birthday"]);
    }

    public function updateSettings(int $user_id, $data){
                if($data["birthday"]){
                 $this->updateBirthday($user_id, $data["birthday"]);
                }
                if($data["password"]){
                 $this->updatePassword($user_id, $data["password"]);
                }
                if($data["email_address"]){
                 $this->updateEmail($user_id, $data["email_address"]);
                }
    }

    private function updateBirthday($user_id, $birthday){
        $stmt = $this->database->connect()->prepare('
            UPDATE users SET birthday = :birthday
            WHERE id = :id
        ');
        $stmt->bindParam(':birthday', $birthday, PDO::PARAM_STR);
        $stmt->bindParam(':id', $user_id, PDO::PARAM_STR);
        $stmt->execute();
    }

    private function updateEmail($user_id, $email){
        $stmt = $this->database->connect()->prepare('
            UPDATE users SET email = :email
            WHERE id = :id
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':id', $user_id, PDO::PARAM_STR);
        $stmt->execute();
    }

    private function updatePassword($user_id, $password){
        $stmt = $this->database->connect()->prepare('
            UPDATE users SET password = :password
            WHERE id = :id
        ');
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':id', $user_id, PDO::PARAM_STR);
        $stmt->execute();
    }
}