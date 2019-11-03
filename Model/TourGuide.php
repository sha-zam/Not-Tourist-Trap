<?php

include_once('User.php');
include 'Tour.php';

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

    public function submitTour($name, $country, $state, $tourDescription, $tourImg, $tourPrice, $tourStartDate, $tourEndDate)
    {
        //generate Tour
        $tour = new Tour($name, $this->userID, $country, $state, $tourDescription, $tourImg, $tourPrice, $tourStartDate, $tourEndDate);
        
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

        //insert tour name, description, tourguideid, countryID, stateID, startDate, endDate, price
        $tourQ = "INSERT INTO tour (Name, Description, TourGuideID, CountryID, StateID, Start_date, End_date, Price) VALUES('$name', '$tourDescription', '$this->userID', '$countryID', '$stateID', '$tourStartDate', '$tourEndDate', '$tourPrice')";
        $insertTour = $conn->query($tourQ);

        //query for tour id
        $tourID = $conn->insert_id;

        //checkpoint checking
        //echo "<script type='text/javascript'>alert('$name, $tourDescription, $this->userID, $countryID, $stateID, $tourStartDate, $tourEndDate, $tourPrice')</script>";
        //echo "<script type='text/javascript'>alert('tourID = $tourID')</script>";


        //insert images, userid, and tour id into tourimage table 
        for($i = 0; $i < count($tourImg); $i++)
        {
            $imgQ = "INSERT INTO tourimage (TourID, AddedByUser, Image) VALUES ('$tourID', '$this->userID', '$tourImg[$i]')";
            $insertImage = $conn->query($imgQ);
        }

        //checkpoint
        //echo "<script type='text/javascript'>alert('tourimageID = $conn->insert_id')</script>";

        //image display attempt
        // $testQ = "SELECT * FROM tourimage WHERE TourImgID = '$conn->insert_id'";
        // $testResult = $conn->query($testQ);

        // if ($testResult->num_rows > 0)
        // {
        //     while($testRow = $testResult->fetch_assoc())
        //     {
        //         $testData[] = $testRow;
        //     }

        //     foreach($testData as $z)
        //     {
        //         $img = $z['Image'];
        //         echo '<img src="../Uploaded_Images/'.$img.'"/>';
        //     }

            
        // }
        

        return true;
    }

}

?>