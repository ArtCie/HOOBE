<?php

require_once 'Repository.php';

class PrivateVehiclesRepository extends Repository
{
    public function selectPrivateVehicles()
    {
        $stmt = $this->database->connect()->prepare("
            select 
                r.rent_from, 
                r.rent_to, 
                r.price, 
                r.is_negotiable, 
                concat(td.first_name, ' ' , td.last_name) as full_name, 
                concat(td.street_name,' ', td.address_number, ' ', cpc.postal_code , ' ', c2.name,' ', c.name) as address, 
                v.name, 
                v.production_year, 
                v.last_technical_review_date 
            from 
                rentals r 
            inner join 
                tenant_details td 
            on 
                r.tenant_id = td.id 
            inner join 
                vehicles v 
            on 
                v.id = r.vehicle_id
            inner join 
                city_postal_code cpc 
            on 
                cpc.id = td.postal_code_id 
            inner join 
                country c 
            on 
                c.id = td.country_id 
            inner join 
                city c2 
            on 
                c2.id = cpc.city_id
            where 
                r.is_available = true;
            ");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}