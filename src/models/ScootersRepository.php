<?php

require_once 'src/models/ScootersRepositories/BoltRepository.php';
require_once 'src/models/ScootersRepositories/TierRepository.php';
require_once 'src/models/ScootersRepositories/LimeRepository.php';
require_once 'src/repository/PrivateVehiclesRepository.php';

class ScootersRepository
{
    private $scooter_repository;
    private $privateVehiclesRepository;
    private $latitude;
    private $longitude;

    public function __construct(float $latitude, float $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->scooter_repository = [
            "Tier" => new TierRepository(),
            "Bolt" => new BoltRepository(),
            "Lime"=>new LimeRepository(),
        ];
        $this->privateVehiclesRepository = new PrivateVehiclesRepository();
    }

    protected function get_coordinates(): array
    {
        return [
            "longitude" => $this->longitude,
            "latitude" => $this->latitude,
        ];
    }

    public function get_all_vehicles($user_filters): array
    {
        $data = [];
        foreach ($this->scooter_repository as $key => $value) {
            if($user_filters[strtolower($key)] === true) {
                $url = $value->prepare_url($this->get_coordinates());
                $value->send_request($url);
                $data["scooters"][$key] = $value->get_data();
            }
            if($user_filters["private_vehicles"] === true){
                $data["private_vehicles"] = $this->privateVehiclesRepository->selectPrivateVehicles();
            }
        }
        return $data;
    }
}