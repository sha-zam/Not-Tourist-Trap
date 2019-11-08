<?php

include '../Model/Tourist.php';

class bookingController
{
    public static function submitBook($tourID, $tourSize, $userID, $email, $pwd, $fName, $lName, $profileImg, $lang)
    {
        $tourist = new Tourist($userID, $email, $pwd, $fName, $lName, $profileImg, $lang);
        
        $checkBook = $tourist->insertBooking($tourID, $tourSize);

        return $checkBook;
    }

    public static function retrieveBooking($role ,$userID, $email, $pwd, $fName, $lName, $profileImg, $lang)
    {
        if ($role == 'tourist')
        {
            $tourist = new Tourist($userID, $email, $pwd, $fName, $lName, $profileImg, $lang);

            $bookings = $tourist->viewBookings();
            
            return $bookings;
        }

    }
}

?>