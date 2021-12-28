<?php

require_once 'src/models/ScootersRepositories/RepositoryInterface.php';
require_once 'API_config/BoltConfig.php';

class BoltRepository implements RepositoryInterface
{

    private $BoltVehicles;

    public function __construct(){
        $this->BoltVehicles = [];
    }

    public function prepare_url($coordinates)
    {
        $global_url = BoltConfig::get_url();
        $replace_from = array('LATITUDE', 'LONGITUDE');
        $replace_to = array(strval(round($coordinates["latitude"], 2)), strval(round($coordinates["longitude"], 2)));
        return str_replace($replace_from, $replace_to, $global_url);
    }

    public function get_data(): array
    {
        return $this->BoltVehicles;
    }

    public function send_request($URL)
    {
        $context = stream_context_create(BoltConfig::get_headers());
        $data = file_get_contents($URL, false, $context);
        $this->parse_data($data);
    }

    private function parse_data($data){
        $json_data = json_decode($data, true);
        foreach($json_data["data"]["categories"][0]["vehicles"] as $scooter){
            array_push($this->BoltVehicles,
                [
                    "lat" => $scooter["lat"],
                    "lng" => $scooter["lng"],
                    "distance_on_charge" => $scooter["distance_on_charge"],
                    "charge" => $scooter["charge"]
                ]
            );
        }
    }
}