<?php

require_once 'src/models/Scooters/Scooter.php';

class Tier extends Scooter
{
    private $max_speed;
    private $battery_level;

    public function __construct($latitude, $longitude, $max_speed, $battery_level)
    {
        parent::__construct($latitude, $longitude);
        $this->max_speed = $max_speed;
        $this->battery_level = $battery_level;
    }

    public function get_max_speed()
    {
        return $this->max_speed;
    }

    public function get_battery_level()
    {
        return $this->battery_level;
    }
}