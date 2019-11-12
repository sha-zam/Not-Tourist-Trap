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

    //Default Constructor
    public function __construct()
    {
        
    }

    //Constructor with Name
    public static function NameConstruct($country, $state)
    {
        $instance = new self();

        $instance->country = $country;
        $instance->state = $state;

        //set country and state ID
        //create connection to DB
        $conn = $instance->connect();

        //query country ID
        $query = "SELECT * FROM state WHERE Name = '$state'";
        $result = $conn->query($query);

        if($result->num_rows > 0) //if state exists
        {
            while($row = $result->fetch_assoc())
            {
                $data[] = $row;
            }

            foreach($data as $x)
            {
                $instance->countryID = $x['CountryID'];
                $instance->stateID = $x['StateID'];
            }
            
        }

        $conn->close();

        return $instance;
    }

    //Constructor with ID
    public static function IDConstruct($countryID, $stateID)
    {
        $instance = new self();

        $instance->countryID = $country;
        $instance->stateID = $state;

        //set country and state names
        //1. create connection to DB
        $conn = $instance->connect();

        //2. query state name
        $stateQuery = "SELECT * FROM state WHERE StateID = '$stateID'";
        $result = $conn->query($stateQuery);

        if(!(empty($result)) && ($result->num_rows > 0))//if state exists
        {
            while($row = $result->fetch_assoc())
            {
                $data[] = $row;
            }

            foreach($data as $x)
            {
                //3. set state name
                $instance->state = $x['Name'];
            }
            
        }

        //2. query country name
        $countryQuery = "SELECT * FROM country WHERE CountryID = '$countryID'";
        $result1 = $conn->query($countryQuery);

        if(!(empty($result)) && $result1->num_rows > 0) //if country exists
        {
            while($row1 = $result1->fetch_assoc())
            {
                $data1[] = $row1;
            }

            foreach($data1 as $y)
            {
                //3. set country name
                $instance->country = $y['Name'];
            }
            
        }

        $conn->close();

        return $instance;
    }

    //Database connection (private)
    private function connect()
    {
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->dbname = "csit3142";
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        return $conn;
    }

    //Accessors
    public function getCountryDetails($id)
    {
        if(isset($country))
            return $this->country;
        else
        {
            //query country name by ID
            $conn = $this->connect();
            $result = $conn->query("SELECT * FROM country WHERE CountryID = '$id' ");

            if(!empty($result) && $result->num_rows > 0)
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
    }

    public function getStateDetails($id)
    {
        if(isset($state))
            return $this->state;
        else
        {
            //query state name by id
            $conn = $this->connect();
            $result = $conn->query("SELECT * FROM state WHERE StateID = '$id' ");

            if(!empty($result) && $result->num_rows > 0)
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

    public function getTextColor()
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
                return $x['BG_Text_Color'];
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

        //if any tours exist
        if(!empty($result) && $result->num_rows > 0)
        {
            //return userID, fName, lName
            while($row = $result->fetch_assoc())
            {
                $tours[] = $row;
            }

            //return query result
            return $tours;
        }
    }
    
    public function searchCountry($searchEntry)
    {
        $conn = $this->connect();
        
        //query for all tours with country name similar to search entry
        $query = "SELECT * FROM tour WHERE CountryID IN (SELECT CountryID FROM country WHERE Name LIKE '%$searchEntry%')";
        $result = $conn->query($query);

        $conn->close();

        //if any tours exist
        if(!empty($result) && $result->num_rows > 0)
        {
            //return userID, fName, lName
            while($row = $result->fetch_assoc())
            {
                $tours[] = $row;
            }

            //return query result
            return $tours;
        }
        else
        {
            return false;
        }
    }

    //Mutators
    public function setCountryName($country)
    {
        $this->country = $country;
    }

    public function setStateName($state)
    {
        $this->state = $state;
    }
    
}

?>