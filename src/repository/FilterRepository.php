<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class FilterRepository extends Repository
{

    public function getFilters(string $user_id)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT bolt, lime, tier, panek, private_vehicles FROM public.user_preferences WHERE user_id = :user_id
        ');
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateFilters(string $user_id, &$data){
        $bolt_bool = ($data["bolt"] === true ? strval($data["bolt"]) : '0');
        $tier_bool = ($data["tier"] === true ? strval($data["tier"]) : '0');
        $lime_bool = ($data["lime"] === true ? strval($data["lime"]) : '0');
        $panek_bool = ($data["panek"] === true ? strval($data["panek"]) : '0');
        $private_vehicles_bool = ($data["private_vehicles"] === true ? strval($data["private_vehicles"]) : '0');

        $stmt = $this->database->connect()->prepare('
            UPDATE
                user_preferences
            SET
                bolt = :bolt,
                lime = :lime,
                tier = :tier,
                panek = :panek,
                private_vehicles = :private_vehicles
            WHERE
                user_id = :user_id
        ');
        $stmt->bindParam(':bolt', $bolt_bool, PDO::PARAM_STR);
        $stmt->bindParam(':lime', $lime_bool, PDO::PARAM_STR);
        $stmt->bindParam(':tier', $tier_bool, PDO::PARAM_STR);
        $stmt->bindParam(':panek', $panek_bool, PDO::PARAM_STR);
        $stmt->bindParam(':private_vehicles', $private_vehicles_bool, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);

        $stmt->execute();
    }
}