<?php

//Entity Class
include '../Model/Destination.php';

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

    public function fetchTitles($country, $state)
    {
        $destination = Destination::NameConstruct($country, $state);

        $titles = array();

        $titles[0] = $destination->getTitle1();
        $titles[1] = $destination->getTitle2();

        return $titles;
    }

    public function fetchTours($country, $state)
    {
        $destination = Destination::NameConstruct($country, $state);

        $tours = $destination->getTours();
        return $tours;
    }
}

?>