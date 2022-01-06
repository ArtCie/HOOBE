<?php

class Vehicle
{
    private $vehicleType;
    private $vehicleName;
    private $productionYear;
    private $lastTechnicalReviewDate;

    public function __construct($vehicleType, $vehicleName, $productionYear, $lastTechnicalReviewDate)
    {
        $this->vehicleType = $vehicleType;
        $this->vehicleName = $vehicleName;
        $this->productionYear = $productionYear;
        $this->lastTechnicalReviewDate = $lastTechnicalReviewDate;
    }

    public function getLastTechnicalReviewDate()
    {
        return $this->lastTechnicalReviewDate;
    }

    public function getVehicleType()
    {
        return $this->vehicleType;
    }

    public function getVehicleName()
    {
        return $this->vehicleName;
    }

    public function getProductionYear()
    {
        return $this->productionYear;
    }

}