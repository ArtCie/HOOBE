<?php

require_once 'src/models/ScootersRepositories/BoltRepository.php';
require_once 'src/models/ScootersRepositories/TierRepository.php';
require_once 'src/models/ScootersRepositories/LimeRepository.php';

class ScootersRepository
{
    private $scooter_repository;
    private $latitude;
    private $longitude;

    public function __construct(float $latitude, float $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->scooter_repository = [
            "Tier" => new TierRepository(),
            "Bolt" => new BoltRepository(),
            "Lime"=>new LimeRepository()
        ];
    }

    protected function get_coordinates(): array
    {
        return [
            "longitude" => $this->longitude,
            "latitude" => $this->latitude,
        ];
    }

    public function get_all_scooters(): array
    {
        $data = [];
        foreach ($this->scooter_repository as $key => $value) {
            $url = $value->prepare_url($this->get_coordinates());
            $value->send_request($url);
            $data[$key] = $value->get_data();
        }
        return $data;
    }
}