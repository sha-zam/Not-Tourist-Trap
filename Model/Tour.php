<?php

class Tour
{
    //Tour Name
    private $tourName;

    //Destination
    private $country;
    private $state;

    //Tour Details
    private $tourDescription;
    private $tourImg = array();
    private $tourPrice;
    private $tourStartDate;
    private $tourEndDate;

    //Tour guide
    private $tourGuideID;

    public function __construct($tourName, $tourGuideID, $country, $state, $tourDescription, $tourImg, $tourPrice, $tourStartDate, $tourEndDate)
    {
        $this->tourName = $tourName;
        $this->tourGuideID = $tourGuideID;
        $this->country = $country;
        $this->state = $state;
        $this->tourDescription = $tourDescription;
        $this->tourImg = $tourImg;
        $this->tourPrice = $tourPrice;
        $this->tourStartDate = $tourStartDate;
        $this->tourEndDate = $tourEndDate;
    }

    //mutators
    public function setName($tourName)
    {
        $this->tourName = $tourName;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function setTourState($state)
    {
        $this->state = $state;
    }

    public function setTourDescription($tD)
    {
        $this->tourDescription = $tD;
    }

    public function setTourImg($tourImg)
    {
        $this->tourImg = $tourImg;
    }

    public function setTourPrice($tourPrice)
    {
        $this->tourPrice = $tourPrice;
    }

    public function setTourStartDate($sD)
    {
        $this->tourStartDate = $sD;
    }

    public function setTourEndDate($eD)
    {
        $this->tourEndDate = $eD;
    }

    //Accessors
    public function getTourID()
    {
        return ($this->tourID);
    }

    public function getCountry()
    {
        return ($this->country);
    }

    public function getTourState()
    {
        return ($this->state);
    }

    public function getTourDescription()
    {
        return ($this->tourDescription);
    }

    public function getTourPrice()
    {
        return ($this->tourPrice);
    }

    public function getTourStartDate()
    {
        return ($this->tourStartDate);
    }

    public function getTourEndDate()
    {
        return ($this->tourEndDate);
    }
}

?>