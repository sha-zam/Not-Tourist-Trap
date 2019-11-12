<?php

//Entity 
include '../Model/TourGuide.php';

class GuideController
{

    //function to check form
    public static function validateTourForm($name, $country, $state, $textDescription, $tourImg, $tourPrice, $tourStartDate, $tourEndDate, $tourSize)
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

    public static function updateTour($tourID, $data, $data2, $toUpdate)
    {
        $user = new TourGuide($_SESSION['userID'], $_SESSION['email'], $_SESSION['pwd'],$_SESSION['ufName'], $_SESSION['ulName'], $_SESSION['profileImg'], $_SESSION['uLangs']);

        if($toUpdate == 'name')
        {
            $check = $user->updateTourName($tourID, $data);

            return $check;
        }
        else if($toUpdate == 'desc')
        {
            $check = $user->updateTourDesc($tourID, $data);

            return $check;
        }
        else if($toUpdate == 'img')
        {
            $check = $user->updateTourImg($tourID, $data);

            return $check;
        }
        else if($toUpdate == 'dates')
        {
            $check = $user->updateTourDates($tourID, $data, $data2);

            return $check;
        }
        else
        {
            $check = $user->updateTourPrice($tourID, $data);

            return $check;
        }
    }

    public static function cancelTour($tourID)
    {
        $user = new TourGuide($_SESSION['userID'], $_SESSION['email'], $_SESSION['pwd'],$_SESSION['ufName'], $_SESSION['ulName'], $_SESSION['profileImg'], $_SESSION['uLangs']);

        $check = $user->cancelTour($tourID);

        return $check;
    }

}

?>
