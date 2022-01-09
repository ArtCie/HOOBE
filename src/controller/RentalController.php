<?php
session_start();
require_once('src/models/Settings.php');
require_once('src/repository/TenantRepository.php');
require_once('src/repository/VehicleRepository.php');
require_once('src/repository/RentalRepository.php');
require_once('src/models/Tenant.php');
require_once('src/models/Vehicle.php');
require_once('src/models/RentalDetails.php');

class RentalController extends AppController
{
    private $tenantRepository;
    private $vehicleRepository;
    private $rentalRepository;

    public function __construct(){
        parent::__construct();
        $this->tenantRepository = new TenantRepository();
        $this->vehicleRepository = new VehicleRepository();
        $this->rentalRepository = new RentalRepository();
    }


    public function save_vehicle(){
        $content = trim(file_get_contents("php://input"));
        $data = json_decode($content, true);

        $tenantId = $this->insertTenantInfo($data);

        $vehicleId = $this->insertVehicleInfo($data, $tenantId);

        $this->insertRentalInfo($data, $tenantId, $vehicleId);

    }

    private function insertTenantInfo($data){
        $tenant = $this->getTenant($data["rentingDetails"]);

        $city_id = $this->get_city_id($tenant->getCity());
        $postal_code_id = $this->get_postal_code_id($city_id, $tenant->getPostalCode());
        $country_id = $this->get_country_id($tenant->getCountry());

        return $this->getTenantId($postal_code_id, $country_id, $tenant);
    }

    private function insertVehicleInfo($data, $tenant_id){
        $vehicle = $this->getVehicle($data["vehicleDetails"]);

        $vehicleTypeId = $this->getVehicleTypeId($vehicle->getVehicleType());
        return $this->getVehicleId($tenant_id, $vehicleTypeId, $vehicle);
    }


    private function insertRentalInfo($data, $tenantId, $vehicleId)
    {
        $rental = $this->getRental($data["rentalDetails"]);

        $data = [
            "tenantId" => $tenantId,
            "vehicleId" => $vehicleId,
            "rentFrom" => $rental->getRentFrom(),
            "rentTo" => $rental->getRentUntil(),
            "price" => $rental->getPrice(),
            "isNegotiable" => $rental->getIsNegotiable()
        ];

        $this->rentalRepository->insertRental($data);


    }

    private function getTenant($rentalDetails): Tenant
    {
        return new Tenant(
            $rentalDetails["firstName"],
            $rentalDetails["lastName"],
            $rentalDetails["address"],
            $rentalDetails["addressNumber"],
            $rentalDetails["country"],
            $rentalDetails["city"],
            $rentalDetails["postalCode"]
        );
    }

    private function getVehicle($vehicleDetails): Vehicle
    {
        return new Vehicle(
          $vehicleDetails["vehicleType"],
          $vehicleDetails["vehicleName"],
          $vehicleDetails["productionYear"],
          gmdate('r', (int)$vehicleDetails["lastTechnicalReviewDate"] / 1000)
        );
    }

    private function getRental($rentalDetails): RentalDetails
    {
        return new RentalDetails(
            gmdate('r', (int)$rentalDetails["rentFrom"] / 1000),
            gmdate('r', (int)$rentalDetails["rentTo"] / 1000),
            $rentalDetails["price"],
            $rentalDetails["isNegotiable"]
        );
    }

    private function get_city_id($city)
    {
        $city_id = $this->tenantRepository->get_city_id_by_city_name($city);

        if(!$city_id){
            $city_id = $this->tenantRepository->insert_city($city);
        }
        return $city_id;
    }

    private function get_postal_code_id(int $cityId, string $postalCode): int
    {
        $postalCodeId = $this->tenantRepository->get_postal_code_id($cityId, $postalCode);

        if(!$postalCodeId){
            $postalCodeId = $this->tenantRepository->insert_postal_code($cityId, $postalCode);
        }
        return $postalCodeId;
    }

    private function get_country_id($country)
    {
        $countryId = $this->tenantRepository->getCountryId($country);

        if(!$countryId){
            $countryId = $this->tenantRepository->insertCountry($country);
        }
        return $countryId;
    }

    private function getTenantId($postalCodeId, $countryId, Tenant $tenant)
    {
        $userId = $_SESSION["user_id"];
        $data = [
            "firstName" => $tenant->getFirstName(),
            "lastName" => $tenant->getLastName(),
            "streetName" => $tenant->getStreetName(),
            "addressNumber" => $tenant->getStreetNumber(),
            "postalCodeId" => $postalCodeId,
            "countryId" => $countryId,
        ];
        $tenant_id = $this->tenantRepository->selectTenantId($userId, $data);

        if(!$tenant_id){
            $tenant_id = $this->tenantRepository->insertTenantDetails($userId, $data);
        }

        return $tenant_id;
    }

    private function getVehicleTypeId($vehicleTypeName)
    {
        $vehicleTypeId = $this->vehicleRepository->selectVehicleTypeByName($vehicleTypeName);
        if(!$vehicleTypeId){
            $vehicleTypeId = $this->vehicleRepository->insertVehicleType($vehicleTypeName);
        }

        return $vehicleTypeId;
    }

    private function getVehicleId($tenantId, $vehicleTypeId, Vehicle $vehicle)
    {
        $data = [
            "tenantId" => $tenantId,
            "vehicleTypeId" => $vehicleTypeId,
            "name" => $vehicle->getVehicleName(),
            "productionYear" => $vehicle->getProductionYear(),
            "lastTechnicalReviewDate" => $vehicle->getLastTechnicalReviewDate(),
            ];
        $vehicleId = $this->vehicleRepository->selectVehicleId($data);

        if(!$vehicleId){
            $vehicleId = $this->vehicleRepository->insertVehicle($data);
        }

        return $vehicleId;
    }
}