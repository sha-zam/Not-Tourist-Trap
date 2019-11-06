<?php

include_once('User.php');

class Tourist extends User
{
    public function __construct($email, $pwd, $fName, $lName, $profileImg, $lang)
    {
        parent :: __construct($email, $pwd, $fName, $lName, $profileImg, $lang);
    }

    public function insertBooking($tourID, $userID)
    {
        //DB connection
        $conn = $this->connect();

        //query insert booking
        $query = "INSERT INTO booking (TourID, UserID) VALUES ('$tourID', '$userID')";
        $result = $conn->query($query);

        if($result)
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