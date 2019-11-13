<?php

include_once('User.php');
include_once('Tour.php');

class TourGuide extends User
{
    //user ID
    private $userID;

    //ratings as guide
    private $rating;

    //comments from tourists
    private $reviews;

    //tours hosted
    private $tours = array();

    public function __construct($userID, $email, $pwd, $fName, $lName, $profileImg, $langs)
    {
        parent::__construct($email, $pwd, $fName, $lName, $profileImg, $langs);
        $this->userID = $userID;
    }

    public function submitTour($name, $country, $state, $tourDescription, $tourImg, $tourPrice, $tourStartDate, $tourEndDate, $tourSize)
    {
        //generate Tour
        $tour = Tour::dataConstruct($name, $this->userID, $country, $state, $tourDescription, $tourImg, $tourPrice, $tourStartDate, $tourEndDate, $tourSize);
        
        //create connection to database
        $conn = $this->connect();

        //check whether the country exists 
        $countryName = $tour->getCountry();

        $checkCountry = $conn->query("SELECT * FROM country WHERE Name = '$countryName'");
        $result = $checkCountry->num_rows;

        if ($result == 0) //if country doesn't exist
        {
            //insert country first to generate country id
            $countryQ = "INSERT INTO country (Name) VALUES ('$countryName')";
            $insertCountry = $conn->query($countryQ);
            
            //query country id to insert into state and tour table in db
            $countryID = $conn->insert_id;
        }
        else //just query for country id
        {
            while($countryRow = $checkCountry->fetch_assoc())
            {
                $countryData[] = $countryRow;
            }

            foreach($countryData as $x)
            {
                $countryID = $x['CountryID'];
            }
        }

        //again, check whether state exists or not
        $stateName = $tour->getTourState();
        $checkState = $conn->query("SELECT * FROM state WHERE Name = '$stateName'");
        $result2 = $checkState->num_rows;

        if ($result2 == 0) //if state doesn't exist yet
        {
            //insert country id and state name into state table db
            $stateQ = "INSERT INTO state (CountryID, Name) VALUES ('$countryID', '$stateName')";
            $insertState = $conn->query($stateQ);

            //query state id to insert into tour table in db
            $stateID = $conn->insert_id;
        }
        else //just query for state id
        {
            while($stateRow = $checkState->fetch_assoc())
            {
                $stateData[] = $stateRow;
            }

            foreach($stateData as $y)
            {
                $stateID = $y['StateID'];
            }
        }

        //checkpoint checking
        //echo "<script type='text/javascript'>alert('countryID = $countryID, stateID = $stateID')</script>";

        //insert tour name, description, tourguideid, countryID, stateID, startDate, endDate, price, size
        $tourQ = "INSERT INTO tour (Name, Description, TourGuideID, CountryID, StateID, Start_date, End_date, Price, Group_Size) VALUES('$name', '$tourDescription', '$this->userID', '$countryID', '$stateID', '$tourStartDate', '$tourEndDate', '$tourPrice', '$tourSize')";
        $insertTour = $conn->query($tourQ);

        if($insertTour)
        {
            //query for tour id
            $tourID = $conn->insert_id;

            //insert images, userid, and tour id into tourimage table 
            foreach($tourImg as $x)
            {
                $imgQ = "INSERT INTO tourimage (TourID, Image) VALUES ('$tourID', '$x')";
                $insertImage = $conn->query($imgQ);
            } 

            if($insertImage)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
        
    }

    public function getTours()
    {
        //db connection
        $conn = $this->connect();

        //query
        $result = $conn->query("SELECT * FROM tour WHERE TourGuideID = '$this->userID'");

        //check if any tours exists, else return false
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

    public function updateTourName($tourID, $name)
    {
        //db connection
        $conn = $this->connect();

        //query
        $result = $conn->query("UPDATE tour SET Name = '$name' WHERE TourID = '$tourID' ");
    
        if($result)
        {
            return true;
        }
        else
            return false;
    }

    public function updateTourDesc($tourID, $desc)
    {
        //db connection
        $conn = $this->connect();

        //query
        $result = $conn->query("UPDATE tour SET Description = '$desc' WHERE TourID = '$tourID' ");
    
        if($result)
        {
            return true;
        }
        else
            return false;
    }

    public function updateTourImg($tourID, $tourImg)
    {
        //db connection
        $conn = $this->connect();

        //insert images, userid, and tour id into tourimage table 
        foreach($tourImg as $x)
        {
            $imgQ = "UPDATE tourimage SET Image = '$x' WHERE TourID = '$tourID'";
            $updateImage = $conn->query($imgQ);
        } 

        if($updateImage)
        {
            return true;
        }
        else
            return false;
    }

    public function updateTourDates($tourID, $sd, $ed)
    {
        //db connection
        $conn = $this->connect();

        //query
        $result = $conn->query("UPDATE tour SET Start_date = '$sd', End_date = '$ed' WHERE TourID = '$tourID' ");
    
        if($result)
        {
            return true;
        }
        else
            return false;
    }

    public function updateTourPrice($tourID, $price)
    {
        //db connection
        $conn = $this->connect();

        //query
        $result = $conn->query("UPDATE tour SET Price = '$price' WHERE TourID = '$tourID' ");
    
        if($result)
        {
            return true;
        }
        else
            return false;
    }

    public function cancelTour($tourID)
    {
        //db connection
        $conn = $this->connect();

        //query
        $result = $conn->query("DELETE FROM tour WHERE TourID = '$tourID'");
    
        if($result)
        {
            return true;
        }
        else
            return false;
    }

}

?>