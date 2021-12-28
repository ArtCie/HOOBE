<?php

require_once 'src/models/ScootersRepositories/RepositoryInterface.php';
require_once 'API_config/LimeConfig.php';

class LimeRepository implements RepositoryInterface
{

    private $LimeVehicles;

    public function __construct(){
        $this->LimeVehicles = [];
    }

    public function prepare_url($coordinates)
    {
        $global_url = LimeConfig::get_url();
        $replace_from = array('LATITUDE', 'LONGITUDE');
        $replace_to = array(strval(round($coordinates["latitude"], 2)), strval(round($coordinates["longitude"], 2)));
        return str_replace($replace_from, $replace_to, $global_url);
    }

    public function get_data(): array
    {
        return $this->LimeVehicles;
    }

    public function send_request($URL)
    {
        $context = stream_context_create(LimeConfig::get_headers());
        $data = file_get_contents($URL, false, $context);
        $this->parse_data($data);
    }

    private function parse_data($data){
        $json_data = json_decode($data, true);
        foreach($json_data["data"]["attributes"]["bike_pins"] as $scooter){
            array_push($this->LimeVehicles,
                [
                    "lat" => $scooter["location"]["latitude"],
                    "lng" => $scooter["location"]["longitude"]
                ]
            );
        }
    }
}