<?php

class Destination
{
    private $country;
    private $state;

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

    //Mutators
    public function setCountry()
    {

    }

    public function setState()
    {

    }

}

?>