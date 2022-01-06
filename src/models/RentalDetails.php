<?php

class RentalDetails
{
    private $rent_from;
    private $rent_until;
    private $price;
    private $is_negotiable;

    public function __construct($rent_from, $rent_until, $price, $is_negotiable)
    {
        $this->rent_from = $rent_from;
        $this->rent_until = $rent_until;
        $this->price = $price;
        $this->is_negotiable = $is_negotiable;
    }

    public function getRentFrom()
    {
        return $this->rent_from;
    }

    public function getRentUntil()
    {
        return $this->rent_until;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getIsNegotiable()
    {
        return $this->is_negotiable;
    }
}