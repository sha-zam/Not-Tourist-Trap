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

    //Database Variables
    private $servername;
    private $username;
    private $password;
    private $dbname;

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

    //Database connection (private)
    private function connect()
    {
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->dbname = "csit314";
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        return $conn;
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
        //query for Tour ID
        //create connection to DB
        $conn = $this->connect();

        //query
        $query = "SELECT * FROM tour WHERE Name = '$this->tourName'";
        $result = $conn->query($query);

        $conn->close();

        if($result->num_rows > 0)
        {
            //return userID, fName, lName
            while($row = $result->fetch_assoc())
            {
                $data[] = $row;
            }

            foreach($data as $x)
            {
                return $x['TourID'];
            }
        }
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

    public function getImages($tourID, $tourGuideID)
    {
        //query for Tour ID
        //create connection to DB
        $conn = $this->connect();

        //query
        $query = "SELECT * FROM tourimage WHERE TourID = '$tourID' AND AddedByUser='$tourGuideID'";
        $result = $conn->query($query);

        $conn->close();

        $images = array();

        if($result->num_rows > 0)
        {
            //return userID, fName, lName
            while($row = $result->fetch_assoc())
            {
                $data[] = $row;
            }

            $i = 0;

            foreach($data as $x)
            {

                $images[] = $x['Image'];
                //$i++;
            }

            return $images;
        }
        else
        {
            return false;
        }
    }
}

?>