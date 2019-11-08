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
 
    public static function fetchTourImages($tourID, $tourName, $tourGuideID, $country, $state, $tourDescription, $tourPrice, $tourStartDate, $tourEndDate, $tourSize)
    {
        $temp = Tour::dataConstruct($tourName, $tourGuideID, $country, $state, $tourDescription, ' ', $tourPrice, $tourStartDate, $tourEndDate, $tourSize);
        $tourImg = $temp->getImages($tourID, $tourGuideID);

        return $tourImg;
    }

    public static function fetchTourDetails($tourID)
    {
        //create tour entity and set tour id
        $tour = new Tour();
        $tour->setTourID($tourID);

        $tourDetails = $tour->getTourDetails();
        return $tourDetails;
    }

    public static function fetchTourGuideDetails($guideID)
    {
        $tour = new Tour();
        $tour->setTourGuideID($guideID);

        $guideDetails = $tour->getTourGuideDetails();
        return $guideDetails;

    }
}

?>