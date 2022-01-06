<?php

class Tenant
{
    private $first_name;
    private $last_name;
    private $streetName;
    private $streetNumber;
    private $country;
    private $city;
    private $postal_code;

    public function __construct($first_name, $last_name, $streetName, $streetNumber, $country, $city, $postal_code)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->streetName = $streetName;
        $this->streetNumber = $streetNumber;
        $this->country = $country;
        $this->city = $city;
        $this->postal_code = $postal_code;
    }

    public function getStreetName()
    {
        return $this->streetName;
    }

    public function getStreetNumber()
    {
        return $this->streetNumber;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getPostalCode()
    {
        return $this->postal_code;
    }
}