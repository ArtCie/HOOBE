<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Settings.php';

class VehicleRepository extends Repository
{
    public function insertVehicle($data)
    {
        var_dump($data);
        $stmt = $this->database->connect()->prepare('
            INSERT INTO
                vehicles
                (tenant_id, vehicle_type_id, name, production_year, last_technical_review_date)
            VALUES
                (:tenant_id, :vehicle_type_id, :name, :production_year, :last_technical_review_date)
            RETURNING 
                id;
        ');
        $stmt->bindParam(':tenant_id', $data["tenantId"], PDO::PARAM_STR);
        $stmt->bindParam(':vehicle_type_id', $data["vehicleTypeId"], PDO::PARAM_STR);
        $stmt->bindParam(':name', $data["name"], PDO::PARAM_STR);
        $stmt->bindParam(':production_year', $data["productionYear"], PDO::PARAM_STR);
        $stmt->bindParam(':last_technical_review_date', $data["lastTechnicalReviewDate"], PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)["id"];
    }

    public function selectVehicleTypeByName($name)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT
                id
            FROM
                vehicles_types
            WHERE
                name = :name;
        ');
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)["id"];
    }


    public function updateVehicle(int $user_id, $data)
    {
        $stmt = $this->database->connect()->prepare('
            UPDATE
                vehicles
            SET
                vehicle_type_id = :vehicle_type_id,
                name = :name,
                production_year = :production_year,
                last_technical_review_date
            WHERE
                id = :id
            ');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->bindParam(':vehicle_type_id', $data["vehicle_type_id"], PDO::PARAM_STR);
        $stmt->bindParam(':name', $data["name"], PDO::PARAM_STR);
        $stmt->bindParam(':production_year', $data["production_year"], PDO::PARAM_STR);
        $stmt->bindParam(':last_technical_review_date', $data["last_technical_review_date"], PDO::PARAM_STR);

        $stmt->execute();

    }

    public function selectUserVehiclesName(int $user_id){
        $stmt = $this->database->connect()->prepare('
            SELECT 
                name
            FROM
                vehicles
            WHERE
                user_id = :user_id;
        ');
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);

        $stmt->execute();


    }

    public function insertVehicleType($vehicleTypeName)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO
                vehicles_types
                (name)
            VALUES
                (:name)
            RETURNING
                id;
        ');
        $stmt->bindParam(':name', $vehicleTypeName, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)["id"];
    }

    public function selectVehicleId(array $data)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT 
                id
            FROM
                vehicles
            WHERE
                tenant_id = :tenantId
            AND 
                vehicle_type_id = :vehicleTypeId
            AND 
                name = :name 
            AND 
                production_year = :productionYear
            AND 
                last_technical_review_date = :lastTechnicalReviewDate
        ');

        $stmt->bindParam(':tenantId', $data["tenantId"], PDO::PARAM_STR);
        $stmt->bindParam(':vehicleTypeId', $data["vehicleTypeId"], PDO::PARAM_STR);
        $stmt->bindParam(':name', $data["name"], PDO::PARAM_STR);
        $stmt->bindParam(':productionYear', $data["productionYear"], PDO::PARAM_STR);
        $stmt->bindParam(':lastTechnicalReviewDate', $data["lastTechnicalReviewDate"], PDO::PARAM_STR);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)["id"];
    }

}