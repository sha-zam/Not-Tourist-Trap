<?php

//Entity 
include '../Model/TourGuide.php';

class GuideController
{

    //function to check form
    public static function validateTourForm($name, $country, $state, $textDescription, $tourImg, $tourPrice, $tourStartDate, $tourEndDate, $tourSize)
    {
        //Check if any form is left empty
        if($name == '' || $country == '' || $state =='' || count($tourImg) == 0 || $textDescription == '' || $tourPrice =='' || $tourSize == '' || $tourStartDate == '' || $tourEndDate == '')
        {
            return 'empty';
        }
        else if((int)$tourPrice < 0)
        {
            return 'price';
        }
        else if((int)$tourSize < 1)
        {
            return 'size';
        }
        else
        {
            //$now = new DateTime();
            //$SD = date_format($tourStartDate, 'm/d/Y');
            //$SD = $SD->format('m/d/Y');

            //$ED = date_format($tourStartDate, 'm/d/Y');
            //$SD = $SD->format('m/d/Y');

            if($tourStartDate > $tourEndDate)
            {
                return 'date';
            }
            else //pass to tourist entity
            {
                $user = new TourGuide($_SESSION['userID'], $_SESSION['email'], $_SESSION['pwd'],$_SESSION['ufName'], $_SESSION['ulName'], $_SESSION['profileImg'], $_SESSION['uLangs']);

                //generate tour
                $check = $user->submitTour($name, $country, $state, $textDescription, $tourImg, $tourPrice, $tourStartDate, $tourEndDate, $tourSize);
                
                return $check;
            }   
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
            if($data == '')
            {
                return false;
            }

            $check = $user->updateTourName($tourID, $data);

            return $check;
        }
        else if($toUpdate == 'desc')
        {
            if($data == '')
            {
                return false;
            }

            $check = $user->updateTourDesc($tourID, $data);

            return $check;
        }
        else if($toUpdate == 'img')
        {
            if($data == '')
            {
                return false;
            }

            $check = $user->updateTourImg($tourID, $data);

            return $check;
        }
        else if($toUpdate == 'dates')
        {
            if($data == '' || $data2 == '')
            {
                return false;
            }

            $check = $user->updateTourDates($tourID, $data, $data2);

            return $check;
        }
        else
        {
            if($data == '')
            {
                return false;
            }
            
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

    public static function retrieveBooking($tourID)
    {
        $user = new TourGuide($_SESSION['userID'], $_SESSION['email'], $_SESSION['pwd'],$_SESSION['ufName'], $_SESSION['ulName'], $_SESSION['profileImg'], $_SESSION['uLangs']);

        $check = $user->getBooking($tourID);

        return $check;
    }

}

?>
