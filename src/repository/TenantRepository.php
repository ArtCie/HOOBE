<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Settings.php';

class TenantRepository extends Repository
{
    public function insertTenantDetails(int $userId, $data)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO
                tenant_details
            (user_id, first_name, last_name, street_name, address_number, postal_code_id, country_id)
            VALUES
            (:user_id, :first_name, :last_name, :street_name, :address_number, :postal_code_id, :country_id)
            RETURNING
                id;
        ');
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':first_name', $data["firstName"], PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $data["lastName"], PDO::PARAM_STR);
        $stmt->bindParam(':street_name', $data["streetName"], PDO::PARAM_STR);
        $stmt->bindParam(':address_number', $data["addressNumber"], PDO::PARAM_STR);
        $stmt->bindParam(':postal_code_id', $data["postalCodeId"], PDO::PARAM_INT);
        $stmt->bindParam(':country_id', $data["countryId"], PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)["id"];
    }


    public function get_city_id_by_city_name($name)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT 
                id
            FROM
                city
            WHERE
                name = :name;
        ');
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);

        $stmt->execute();

        return (int)$stmt->fetch(PDO::FETCH_ASSOC)["id"];
    }

    public function insert_city($city): int
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO
                city (name) VALUES (:name)
            RETURNING id;
        ');
        $stmt->bindParam(':name', $city, PDO::PARAM_STR);

        $stmt->execute();

        return (int)$stmt->fetch(PDO::FETCH_ASSOC)["id"];
    }

    public function get_postal_code_id(int $cityId, string $postalCode): int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT 
                id
            FROM
                city_postal_code
            WHERE
                postal_code = :postalCode
            AND 
                city_id = :cityId;
        ');
        $stmt->bindParam(':postalCode', $postalCode, PDO::PARAM_STR);
        $stmt->bindParam(':cityId', $cityId, PDO::PARAM_INT);

        $stmt->execute();

        return (int)$stmt->fetch(PDO::FETCH_ASSOC)["id"];
    }

    public function insert_postal_code($cityId, $postalCode): int
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO
                city_postal_code (postal_code, city_id) VALUES (:postal_code, :city_id)
            RETURNING id;
        ');
        $stmt->bindParam(':postal_code', $postalCode, PDO::PARAM_STR);
        $stmt->bindParam(':city_id', $cityId, PDO::PARAM_STR);

        $stmt->execute();

        return (int)$stmt->fetch(PDO::FETCH_ASSOC)["id"];
    }

    public function getCountryId($country)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT 
                id
            FROM
                country
            WHERE
                name = :name
           ');
        $stmt->bindParam(':name', $country, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)["id"];
    }

    public function insertCountry($country)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO
                country (name) VALUES (:country)
            RETURNING id;
        ');
        $stmt->bindParam(':country', $country, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)["id"];
    }

    public function selectTenantId($userId, $data)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT
                id
            FROM
                tenant_details
            WHERE
                user_id = :user_id
            AND 
                first_name = :first_name            
            AND 
                last_name = :last_name            
            AND 
                street_name = :street_name
            AND 
                address_number = :address_number            
            AND 
                postal_code_id = :postal_code_id
            AND 
                country_id = :country_id
        ');
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_STR);
        $stmt->bindParam(':first_name', $data["firstName"], PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $data["lastName"], PDO::PARAM_STR);
        $stmt->bindParam(':street_name', $data["streetName"], PDO::PARAM_STR);
        $stmt->bindParam(':address_number', $data["addressNumber"], PDO::PARAM_STR);
        $stmt->bindParam(':postal_code_id', $data["postalCodeId"], PDO::PARAM_STR);
        $stmt->bindParam(':country_id', $data["countryId"], PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)["id"];
    }



}