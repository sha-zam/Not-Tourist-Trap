<?php

//Entity Class
include_once('../Model/Destination.php');

class destController
{
    public static function fetchImages($country, $state)
    {
        $destination = Destination::NameConstruct($country, $state);

        $img = array();

        $img[0] = $destination->getImage1();
        $img[1] = $destination->getImage2();
        $img[2] = $destination->getImage3();

        return $img;
    }

    public static function fetchDesc($country, $state)
    {
        $destination = Destination::NameConstruct($country, $state);

        $desc = array();

        $desc[0] = $destination->getDesc1();
        $desc[1] = $destination->getDesc2();

        return $desc;
    }

    public static function fetchTitles($country, $state)
    {
        $destination = Destination::NameConstruct($country, $state);

        $titles = array();

        $titles[0] = $destination->getTitle1();
        $titles[1] = $destination->getTitle2();

        return $titles;
    }

    public static function fetchTours($country, $state)
    {
        $destination = Destination::NameConstruct($country, $state);

        $tours = $destination->getTours();
        return $tours;
    }

    public static function fetchCountryDetails($countryID)
    {
        $destination = new Destination();

        $country = $destination->getCountryDetails($countryID);

        return $country;
    }

    public static function fetchtextColor($country, $state)
    {
        $destination = Destination::NameConstruct($country, $state);

        $color = $destination->getTextColor();

        return $color;
    }

    public static function fetchStateDetails($stateID)
    {
        $destination = new Destination();

        $state = $destination->getStateDetails($stateID);

        return $state;
    }
    
    public static function searchCountry($searchEntry)
    {
        $destination = new Destination();
        
        $tours = $destination->searchCountry($searchEntry);
        
        return $tours;
    }
}

?>