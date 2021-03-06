<?php

require_once 'Repository.php';

class RegisterRepository extends Repository
{
    public function registerUser(string $email, string $password, string $password_salt, string $timezone, $insert_timestamp)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO
                users 
                (
                    email, 
                    password, 
                    password_salt,
                    timezone,
                    is_activated,
                    insert_timestamp
                )
                values
                (
                 :email,
                 :password,
                 :password_salt,
                 :timezone,
                 FALSE,
                 :insert_timestamp
                )
            RETURNING
                id;
            
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':password_salt', $password_salt, PDO::PARAM_STR);
        $stmt->bindParam(':timezone', $timezone, PDO::PARAM_STR);
        $stmt->bindParam(':insert_timestamp', $insert_timestamp, PDO::PARAM_STR);


        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)["id"];

    }

    public function registerPreferences(int $id)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO
                user_preferences 
                (
                    user_id,
                    bolt,
                    lime,
                    tier,
                    panek,
                    private_vehicles
                )
                values
                (
                 :user_id,
                 True,
                 True,
                 True,
                 True,
                 True
                )
        ');
        $stmt->bindParam(':user_id', $id, PDO::PARAM_STR);

        $stmt->execute();

        $stmt->fetch(PDO::FETCH_ASSOC);

    }
}