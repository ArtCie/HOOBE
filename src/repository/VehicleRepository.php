<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Settings.php';

class VehicleRepository extends Repository
{
    public function insertVehicle($data)
    {
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


    public function updateVehicle($data, $vehicle_id)
    {
        $stmt = $this->database->connect()->prepare('
            UPDATE 
                vehicles
            set
                tenant_id = :tenant_id,
                vehicle_type_id = :vehicle_type_id,
                name = :name,
                production_year = :production_year,
                last_technical_review_date = :last_technical_review_date
            where
                id = :id;
        ');

        $stmt->bindParam(':vehicle_type_id', $data["vehicle_type_id"], PDO::PARAM_STR);
        $stmt->bindParam(':name', $data["name"], PDO::PARAM_STR);
        $stmt->bindParam(':production_year', $data["production_year"], PDO::PARAM_STR);
        $stmt->bindParam(':last_technical_review_date', $data["last_technical_review_date"], PDO::PARAM_STR);
        $stmt->bindParam(':tenant_id', $data["tenant_id"], PDO::PARAM_INT);
        $stmt->bindParam(':id', $vehicle_id, PDO::PARAM_INT);

        $stmt->execute();

    }

    public function selectUserVehiclesNameAndId(int $user_id){
        $stmt = $this->database->connect()->prepare('
            SELECT 
                v.id, v.name
            FROM
                vehicles v
            INNER JOIN
                tenant_details td
            ON 
                td.id = v.tenant_id
            WHERE
                td.user_id = :user_id;
        ');
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    public function removeVehicle($userId, $vehicleId)
    {
        $stmt = $this->database->connect()->prepare('
            DELETE FROM
                rent_photos rp
            USING
                rentals r
            WHERE 
                r.id = rp.rental_id
            AND
                r.vehicle_id = :id
            ');

        $stmt->bindParam(':id', $vehicleId, PDO::PARAM_INT);
        $stmt->execute();

        $stmt = $this->database->connect()->prepare('
            DELETE FROM
                rentals
            WHERE
                vehicle_id = :id
            ');

        $stmt->bindParam(':id', $vehicleId, PDO::PARAM_INT);
        $stmt->execute();


        $stmt = $this->database->connect()->prepare('
            DELETE FROM
                vehicles
            WHERE
                id = :id
            RETURNING
                tenant_id;
        ');

        $stmt->bindParam(':id', $vehicleId, PDO::PARAM_INT);
        $stmt->execute();

        $tenant_id = $stmt->fetch(PDO::FETCH_ASSOC)["tenant_id"];

        $stmt = $this->database->connect()->prepare('
            DELETE FROM
                tenant_details
            WHERE
                id = :id
        ');

        $stmt->bindParam(':id', $tenant_id, PDO::PARAM_INT);
        $stmt->execute();

    }

    public function selectVehicleInfo($vehicleId)
    {
        $stmt = $this->database->connect()->prepare('
            select * from vehicleinfo2 where vehicle_id = :id;
            ');

        $stmt->bindParam(':id', $vehicleId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTenantByVehicleId($vehicle_id)
    {
        $stmt = $this->database->connect()->prepare('
            select tenant_id from vehicles where id = :vehicle_id
            ');

        $stmt->bindParam(':vehicle_id', $vehicle_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)["tenant_id"];
    }

    public function updateTenant(array $data, $tenantId)
    {
        $stmt = $this->database->connect()->prepare('
            update tenant_details 
            set
                first_name = :first_name,
                last_name = :last_name,
                street_name = :street_name,
                address_number = :address_number,
                postal_code_id = :postal_code_id,
                country_id = :country_id
            where
                id = :tenant_id
            ');

        $stmt->bindParam(':first_name', $data["first_name"], PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $data["last_name"], PDO::PARAM_STR);
        $stmt->bindParam(':street_name', $data["street_name"], PDO::PARAM_STR);
        $stmt->bindParam(':address_number', $data["address_number"], PDO::PARAM_INT);
        $stmt->bindParam(':postal_code_id', $data["postal_code_id"], PDO::PARAM_INT);
        $stmt->bindParam(':country_id', $data["country_id"], PDO::PARAM_INT);
        $stmt->bindParam(':tenant_id', $tenantId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)["tenant_id"];


    }

}