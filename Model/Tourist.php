<?php

include_once('User.php');

session_start();

class Tourist extends User
{
    private $userID;

    public function __construct ($userID, $email, $pwd, $fName, $lName, $profileImg, $lang)
    {
        //$instance = new self();
        parent :: __construct($email, $pwd, $fName, $lName, $profileImg, $lang);
        $this->userID = $userID;
    }

    public function insertBooking($tourID, $tourSize)
    {
        //DB connection
        $conn = $this->connect();

        //check first if booking already exists
        $checkQ = "SELECT * From booking WHERE TourID = '$tourID' AND UserID = '$this->userID' ";
        $check = $conn->query($checkQ);

        if(!empty($check) && $check->num_rows > 0)
        {
            return false;
        }
        else
        {
            //query insert booking
            $query = "INSERT INTO booking (TourID, UserID, Group_Size) VALUES ('$tourID', '$this->userID', '$tourSize')";
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
        
    }

    public function viewBookings()
    {
        //DB connection
        $conn = $this->connect();

        //query to retrieve bookings
        $query = "SELECT * FROM booking WHERE UserID = '$this->userID'";
        $result = $conn->query($query);

        if(!empty($result) && $result->num_rows > 0)
        {
            return $result;
        }
        else
        {
            return false;
        }
 
    }

    public function updateBooking($bookingID, $tourID, $tourSize)
    {
        //db connection
        $conn = $this->connect();

        //query
        $result = $conn->query("UPDATE booking SET Group_Size = '$tourSize' WHERE BookingID = '$bookingID' AND TourID = '$tourID' ");
    
        if($result)
        {
            return true;
        }
        else
            return false;
    }

    public function cancelBooking($bookingID, $tourID)
    {
        //db connection
        $conn = $this->connect();

        //query
        $result = $conn->query("DELETE FROM booking WHERE BookingID = '$bookingID'");
    
        if($result)
        {
            return true;
        }
        else
            return false;
    
    }
}

?>