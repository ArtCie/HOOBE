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
}