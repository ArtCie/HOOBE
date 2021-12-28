<?php

class Bolt extends Scooter
{
    private $charge;
    private $distance_on_charge;

    public function __construct($latitude, $longitude, $charge, $distance_on_charge)
    {
        parent::__construct($latitude, $longitude);
        $this->charge = $charge;
        $this->distance_on_charge = $distance_on_charge;
    }

    public function get_charge()
    {
        return $this->charge;
    }

    public function get_distance_on_charge()
    {
        return $this->distance_on_charge;
    }
}