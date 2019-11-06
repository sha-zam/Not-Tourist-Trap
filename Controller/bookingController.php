<?php

include '../Model/Tourist.php';

class bookingController
{
    public static function submitBook($tourID, $userID, $email, $pwd, $fName, $lName, $profileImg, $lang)
    {
        if($tourID == '' || $userID == '')
        {
            return false;
        }
        else
        {
            //ask tourist entity to submit booking
            $tourist = new Tourist($userID, $email, $pwd, $fName, $lName, $profileImg, $lang);
            $insertCheck = $tourist->insertBooking($tourID);

            return $insertCheck;
        }
    }

    public static function retrieveBookings($role, $userID)
    {
        if($role == 'tourist')
        {
            
        }
        else
        {

        }
    }
}

// if(isset($_POST['bookForm']))
// {
//     $tourID = $_GET['tourID'];
//     $userID = $_GET['userID'];

//     echo "<script type='text/javascript'>alert('$userID, $tourID')</script>";

//     $insertBooking = bookingController::submitBook($tourID, $userID);

//     if($insertBooking)
//     {
//         echo '<script language="javascript">';
//         echo 'alert("success")';
//         echo '</script>';
//     }
//     else
//     {
//         echo '<script language="javascript">';
//         echo 'alert("fail")';
//         echo '</script>';
//     }
// }
?>