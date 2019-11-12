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

    public static function cancelBooking($bookingID, $tourID)
    {
        $user = new Tourist($_SESSION['userID'], $_SESSION['email'], $_SESSION['pwd'],$_SESSION['ufName'], $_SESSION['ulName'], $_SESSION['profileImg'], $_SESSION['uLangs']);

        $check = $user->cancelBooking($bookingID, $tourID);

        return $check;
    }

    public static function updateBooking($bookingID, $tourID, $tourSize)
    {
        $user = new Tourist($_SESSION['userID'], $_SESSION['email'], $_SESSION['pwd'],$_SESSION['ufName'], $_SESSION['ulName'], $_SESSION['profileImg'], $_SESSION['uLangs']);

        $check = $user->updateBooking($bookingID, $tourID, $tourSize);

        return $check;
    }
}

?>