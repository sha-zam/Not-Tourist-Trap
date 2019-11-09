<?php

include '../Model/TourGuide.php';

class GuideController
{

    //function to check form
    public static function submitTourForm($name, $country, $state, $textDescription, $tourImg, $tourPrice, $tourStartDate, $tourEndDate, $tourSize)
    {
        //Check if any form is left empty
        if($name == '' || $country == '' || $state =='' || count($tourImg) == 0 || $textDescription == '' || $tourPrice =='' || $tourSize == '')
        {
            return false;
        }
        else //pass to tourist entity
        {
            $user = new TourGuide($_SESSION['userID'], $_SESSION['email'], $_SESSION['pwd'],$_SESSION['ufName'], $_SESSION['ulName'], $_SESSION['profileImg'], $_SESSION['uLangs']);

            //generate tour
            $check = $user->submitTour($name, $country, $state, $textDescription, $tourImg, $tourPrice, $tourStartDate, $tourEndDate, $tourSize);
            
            return $check;
        }   
    }

    public static function fetchTours()
    {
        $user = new TourGuide($_SESSION['userID'], $_SESSION['email'], $_SESSION['pwd'],$_SESSION['ufName'], $_SESSION['ulName'], $_SESSION['profileImg'], $_SESSION['uLangs']);

        $tours = $user->getTours();

        return $tours;
    }

}

?>
