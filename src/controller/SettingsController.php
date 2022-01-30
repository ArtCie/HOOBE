<?php
session_start();
require_once('src/models/Settings.php');
require_once('src/repository/SettingsRepository.php');
require_once('src/repository/VehicleRepository.php');

class SettingsController extends AppController
{
    private $settings_repository;
    private $vehicle_repository;

    public function __construct(){
        parent::__construct();
        $this->settings_repository = new SettingsRepository();
        $this->vehicle_repository = new VehicleRepository();
    }

    public function settings(){
        $user_id = $_SESSION["user_id"];
        $vehicles = $this->vehicle_repository->selectUserVehiclesNameAndId($user_id);

        $this->render('settings', [
            'vehicles' => $vehicles
        ]);
    }

    public function get_settings(){
        $user_id = intval($_SESSION["user_id"]);

        $settings = $this->settings_repository->getSettings($user_id);

        http_response_code(200);
        echo json_encode([
            "email"=> $settings->getEmail(),
            "birthday" => $settings->getBirthday()
        ]);
    }

    public function update_settings(){
        $user_id = $_SESSION["user_id"];
        $data = $_POST;
        $this->settings_repository->updateSettings($user_id, $data);

        $this->redirect('main_page');
    }

    public function remove_vehicle(){
        $userId = $_SESSION["user_id"];
        $vehicleId  = json_decode(file_get_contents('php://input'), true)['vehicleId'];
        $this->vehicle_repository->removeVehicle($userId, $vehicleId);
    }

    public function update_vehicle(){
        $vehicleId = json_decode(file_get_contents('php://input'), true)["vehicleId"];
        $data = $this->vehicle_repository->selectVehicleInfo($vehicleId);

        echo json_encode([
            "data"=> $data,
        ]);
    }
}