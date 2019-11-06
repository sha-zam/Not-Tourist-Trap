<?php

include_once('User.php');

class Tourist extends User
{
    private $userID;

    // public function __contruct()
    // {

    // }

    // public static function idConstruct($userID)
    // {
    //     $instance = new self();
    //     $instance->setUserID($userID);

    //     echo "<script type='text/javascript'>alert('$userID')</script>";

    //     return $instance;
    // }

    public function __construct ($userID, $email, $pwd, $fName, $lName, $profileImg, $lang)
    {
        //$instance = new self();
        parent :: __construct($email, $pwd, $fName, $lName, $profileImg, $lang);
        $this->userID = $userID;

        // return $instance;
    }

    public function setUserID($userID)
    {
        $this->userID = $userID;
    }

    public function insertBooking($tourID)
    {
        //database connection
        $conn = parent::connect();

        //query insert booking to booking table
        $query = "INSERT INTO booking (TourID, UserID) VALUES ('$tourID', '$this->userID')";
        $result = $conn->query($query);

        if ($result)
        {
            return true;
        }
        else
        {
            return false;
        }

    }

    public function viewBookings()
    {

    }

    public function bookTour()
    {

    }
}

?>