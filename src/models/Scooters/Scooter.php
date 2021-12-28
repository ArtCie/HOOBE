<?php

class Scooter
{
    private $latitude;
    private $longitude;

    public function __construct(float $latitude, float $longitude){
        $this->longitude = $longitude;
        $this->latitude = $latitude;
    }

    protected function get_coordinates(): array
    {
        return [
            "longitude" => $this->longitude,
            "latitude" => $this->latitude,
        ];
    }
}