<?php 

include '../Model/Tour.php';

class tourController
{
    // private $tourID;
    // private $tourGuideID;
    // private $tourName;
    // private $country;
    // private $state;
    // private $tourDesc;
    // private $tourPrice;
    // private $tourSD;
    // private $tourED;
 
    public static function fetchTourImages($tourID, $tourName, $tourGuideID, $country, $state, $tourDescription, $tourPrice, $tourStartDate, $tourEndDate)
    {
        $temp = new Tour($tourName, $tourGuideID, $country, $state, $tourDescription, ' ', $tourPrice, $tourStartDate, $tourEndDate);
        $tourImg = $temp->getImages($tourID, $tourGuideID);

        return $tourImg;
    }

    public static function fetchTourGuideDetails($tourGuideID)
    {

    }
}

?>