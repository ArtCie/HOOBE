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
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/app/public/img/uploads/';


    private $tenantRepository;
    private $vehicleRepository;
    private $rentalRepository;
    private $message = [];

    public function __construct(){
        parent::__construct();
        $this->tenantRepository = new TenantRepository();
        $this->vehicleRepository = new VehicleRepository();
        $this->rentalRepository = new RentalRepository();
    }


    public function save_vehicle(){
        if(!empty($_POST["vehicle_id"])){
            $this->updateVehicle(intval($_POST["vehicle_id"]));
            $this->redirect('settings');
        }
        else {
            $tenantId = $this->insertTenantInfo($_POST);

            $vehicleId = $this->insertVehicleInfo($_POST, $tenantId);

            $id = $this->insertRentalInfo($_POST, $tenantId, $vehicleId);

            $this->moveFiles($id);

            $this->render('main_page');
        }
        }

    private function updateVehicle($vehicle_id)
    {
        $tenantId = $this->updateTenantInfo($_POST, $vehicle_id);
        $this->updateVehicleInfo($_POST, $tenantId, $vehicle_id);
        $rentalId = $this->updateRentalInfo($_POST,  $tenantId, $vehicle_id);

        $this->deleteOldPhotos($rentalId);
        $this->moveFiles($rentalId);
    }

    private function moveFiles($id){
        $file_count = count($_FILES['file']['name']);

        for( $i=0 ; $i < $file_count ; $i++ ) {
            $tmpFilePath = $_FILES['file']['tmp_name'][$i];

            if ($tmpFilePath != "") {
                $newFilePath = self::UPLOAD_DIRECTORY.$_FILES['file']['name'][$i];
                $this->rentalRepository->insertVehiclePhoto($id, $newFilePath);
                move_uploaded_file($tmpFilePath, $newFilePath);
            }

        }
    }
    private function insertTenantInfo($data){
        $tenant = $this->getTenant($data);

        $city_id = $this->get_city_id($tenant->getCity());
        $postal_code_id = $this->get_postal_code_id($city_id, $tenant->getPostalCode());
        $country_id = $this->get_country_id($tenant->getCountry());

        return $this->getTenantId($postal_code_id, $country_id, $tenant);
    }

    private function insertVehicleInfo($data, $tenant_id){
        $vehicle = $this->getVehicle($data);

        $vehicleTypeId = $this->getVehicleTypeId($vehicle->getVehicleType());
        return $this->getVehicleId($tenant_id, $vehicleTypeId, $vehicle);
    }


    private function insertRentalInfo($data, $tenantId, $vehicleId)
    {
        $rental = $this->getRental($data);

        $data = [
            "tenantId" => $tenantId,
            "vehicleId" => $vehicleId,
            "rentFrom" => $rental->getRentFrom(),
            "rentTo" => $rental->getRentUntil(),
            "price" => $rental->getPrice(),
            "isNegotiable" => $rental->getIsNegotiable()
        ];

        return $this->rentalRepository->insertRental($data);


    }

    private function getTenant($rentalDetails): Tenant
    {
        return new Tenant(
            $rentalDetails["first_name"],
            $rentalDetails["last_name"],
            $rentalDetails["address"],
            $rentalDetails["address_number"],
            $rentalDetails["country"],
            $rentalDetails["city"],
            $rentalDetails["postal_code"]
        );
    }

    private function getVehicle($vehicleDetails): Vehicle
    {
        return new Vehicle(
          $vehicleDetails["vehicle_type"],
          $vehicleDetails["vehicle_name"],
          $vehicleDetails["production_year"],
          date('Y-m-d', strtotime($vehicleDetails["last_technical_review_date"]))
        );
    }

    private function getRental($rentalDetails): RentalDetails
    {
        if($rentalDetails["is_negotiable"]){
           $is_negotiable = false;
        }
        else{
            $is_negotiable = true;
        }
        return new RentalDetails(
            date('Y-m-d', strtotime($rentalDetails["rent_from"])),
            date('Y-m-d', strtotime($rentalDetails["rent_to"])),
            $rentalDetails["price"],
            $is_negotiable
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

    private function updateTenantInfo(array $data, $vehicle_id)
    {
        $tenantId = $this->vehicleRepository->getTenantByVehicleId($vehicle_id);

        $tenant = $this->getTenant($data);

        $city_id = $this->get_city_id($tenant->getCity());
        $postalCodeId = $this->get_postal_code_id($city_id, $tenant->getPostalCode());
        $countryId = $this->get_country_id($tenant->getCountry());

        $data = [
            "first_name" => $tenant->getFirstName(),
            "last_name" => $tenant->getLastName(),
            "street_name" => $tenant->getStreetName(),
            "address_number" => $tenant->getStreetNumber(),
            "postal_code_id" => $postalCodeId,
            "country_id" => $countryId
        ];

        $this->vehicleRepository->updateTenant($data, $tenantId);

        return $tenantId;
    }

    private function updateVehicleInfo(array $data, $tenantId, $vehicle_id)
    {
        $vehicle = $this->getVehicle($data);

        $vehicleTypeId = $this->getVehicleTypeId($vehicle->getVehicleType());

        $data = [
            "tenant_id" => $tenantId,
            "vehicle_type_id" => $vehicleTypeId,
            "name" => $vehicle->getVehicleName(),
            "production_year" => $vehicle->getProductionYear(),
            "last_technical_review_date" => $vehicle->getLastTechnicalReviewDate(),
        ];

        $this->vehicleRepository->updateVehicle($data, $vehicle_id);

    }

    private function updateRentalInfo(array $data, $tenantId, $vehicle_id)
    {
        $rental = $this->getRental($data);

        $data = [
            "tenant_id" => $tenantId,
            "vehicle_id" => $vehicle_id,
            "rent_from" => $rental->getRentFrom(),
            "rent_to" => $rental->getRentUntil(),
            "price" => $rental->getPrice(),
            "is_negotiable" => $rental->getIsNegotiable()
        ];

        return $this->rentalRepository->updateRental($data);
    }

    private function deleteOldPhotos($rentalId)
    {
        $data = [
            "rental_id" => $rentalId
        ];
        $this->rentalRepository->deletePhotos($data);
    }
}