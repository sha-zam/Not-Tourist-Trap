<?php

class Destination
{
    private $country;
    private $state;

    private $countryID;
    private $stateID;

    private $tours = array();


    //Database Variables
    private $servername;
    private $username;
    private $password;
    private $dbname;

    //Constructor
    public function __construct($country, $state)
    {
        $this->country = $country;
        $this->state = $state;

        //set country and state ID
        //create connection to DB
        $conn = $this->connect();

        //query country ID
        $query = "SELECT * FROM state WHERE Name='$this->state'";
        $result = $conn->query($query);

        if($result->num_rows > 0) //if state exists
        {
            while($row = $result->fetch_assoc())
            {
                $data[] = $row;
            }

            foreach($data as $x)
            {
                $this->countryID = $x['CountryID'];
                $this->stateID = $x['StateID'];
            }
            
        }

        $conn->close();
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

    //Accessors
    public function getCountry()
    {
        return $this->country;
    }

    public function getState()
    {
        return $this->state;
    }

    public function getCountryID()
    {
        return $this->countryID;
    }

    public function getStateID()
    {
        return $this->stateID;
    }


    public function getImage1()
    {
        //create connection to DB
        $conn = $this->connect();

        //query
        $query = "SELECT * FROM state WHERE Name = '$this->state'";
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
                return $x['Image_1'];
            }
        }

    }

    public function getImage2()
    {
        //create connection to DB
        $conn = $this->connect();

        //query
        $query = "SELECT * FROM state WHERE Name = '$this->state'";
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
                return $x['Image_2'];
            }
        }
    }

    public function getImage3()
    {
        //create connection to DB
        $conn = $this->connect();

        //query
        $query = "SELECT * FROM state WHERE Name = '$this->state'";
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
                return $x['Image_3'];
            }
        }
    }

    public function getDesc1()
    {
        //create connection to DB
        $conn = $this->connect();

        //query
        $query = "SELECT * FROM state WHERE Name = '$this->state'";
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
                return $x['Description_1'];
            }
        }
    }

    public function getDesc2()
    {
        //create connection to DB
        $conn = $this->connect();

        //query
        $query = "SELECT * FROM state WHERE Name = '$this->state'";
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
                return $x['Description_2'];
            }
        }
    }

    public function getTitle1()
    {
        //create connection to DB
        $conn = $this->connect();

        //query
        $query = "SELECT * FROM state WHERE Name = '$this->state'";
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
                return $x['Title_1'];
            }
        }
    }

    public function getTitle2()
    {
        //create connection to DB
        $conn = $this->connect();

        //query
        $query = "SELECT * FROM state WHERE Name = '$this->state'";
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
                return $x['Title_2'];
            }
        }
    }

    public function getTours()
    {
        //create connection to DB
        $conn = $this->connect();

        //query for all tours with current country and state ID
        $query = "SELECT * FROM tour WHERE CountryID = '$this->countryID' AND StateID = '$this->stateID'";
        $result = $conn->query($query);

        $conn->close();

        //return query result
        return $result;
    }

    public function getTourGuideDetails($guideID)
    {
        //create connection to DB
        $conn = $this->connect();

        //query profileImage, fname, and lname from user table
        $query = "SELECT * FROM user WHERE UserID = '$guideID'";
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
                $resultArr[0] = $x['FirstName'];
                $resultArr[1] = $x['LastName'];
                $resultArr[2] = $x['Profile_Image'];
            }

            return $resultArr;
        }
    }


    //Mutators
    public function setCountry()
    {

    }

    public function setState()
    {

    }

}

?>