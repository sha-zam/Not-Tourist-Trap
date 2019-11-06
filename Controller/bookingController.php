<?php

include '../Model/Tourist.php';

class bookingController
{
    public static function submitBook($tourID, $userID, $email, $pwd, $fName, $lName, $profileImg, $lang)
    {
        $tourist = new Tourist($email, $pwd, $fName, $lName, $profileImg, $lang);
        
        $checkBook = $tourist->insertBooking($tourID, $userID);

        return $checkBook;
    }
}

?>