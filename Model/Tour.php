<?php

class Tour
{
    //Tour Name
    private $tourName;

    //Destination
    private $country;
    private $state;

    //Tour Details
    private $tourID;
    private $tourDescription;
    private $tourImg = array();
    private $tourPrice;
    private $tourStartDate;
    private $tourEndDate;
    private $tourSize;

    //Tour guide
    private $tourGuideID;

    //Database Variables
    private $servername;
    private $username;
    private $password;
    private $dbname;

    public function __construct()
    {

    }

    public static function dataConstruct($tourName, $tourGuideID, $country, $state, $tourDescription, $tourImg, $tourPrice, $tourStartDate, $tourEndDate, $tourSize)
    {
        $instance = new self();

        $instance->tourName = $tourName;
        $instance->tourGuideID = $tourGuideID;
        $instance->country = $country;
        $instance->state = $state;
        $instance->tourDescription = $tourDescription;
        $instance->tourImg = $tourImg;
        $instance->tourPrice = $tourPrice;
        $instance->tourStartDate = $tourStartDate;
        $instance->tourEndDate = $tourEndDate;
        $instance->tourSize = $tourSize;

        return $instance;
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
    public function setTourID($tourID)
    {
        $this->tourID = $tourID;
    }

    public function setTourGuideID($guideID)
    {
        $this->tourGuideID = $guideID;
    }

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

    public function getImages()
    {
        //query for Tour ID
        //create connection to DB
        $conn = $this->connect();

        //query
        $query = "SELECT * FROM tourimage WHERE TourID = '$this->tourID'";
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

    //by ID
    public function getTourDetails()
    {
        //db connection
        $conn = $this->connect();

        //query to fetch tourDetails
        $query = "SELECT * FROM tour WHERE TourID = '$this->tourID'";
        $result = $conn->query($query);

        //check if any exists
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $data[] = $row;
            }

            return $data;
        }
        else
        {
            return false;
        }

    }

    //by ID
    public function getTourGuideDetails()
    {
        //create connection to DB
        $conn = $this->connect();

        //query profileImage, fname, and lname from user table
        $query = "SELECT * FROM user WHERE UserID = '$this->tourGuideID'";
        $result = $conn->query($query);

        $conn->close();

        $resultArr = array();

        if($result->num_rows > 0)
        {
            //return userID, fName, lName
            while($row = $result->fetch_assoc())
            {
                $data[] = $row;
            }

            foreach($data as $x)
            {
                $resultArr[0] = $x['Email'];
                $resultArr[1] = $x['FirstName'];
                $resultArr[2] = $x['LastName'];
                $resultArr[3] = $x['Profile_Image'];
            }

            return $resultArr;
        }
    }
}

?>