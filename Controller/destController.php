<?php

//Entity Class
include '../Model/Destination.php';

class destController
{
    private $destination;

    public function __construct($country, $state)
    {   
        $this->destination = new Destination($country, $state);
    }

    public function fetchImages()
    {
        $img = array();

        $img[0] = $this->destination->getImage1();
        $img[1] = $this->destination->getImage2();
        $img[2] = $this->destination->getImage3();

        return $img;
    }

    public function fetchDesc()
    {
        $desc = array();

        $desc[0] = $this->destination->getDesc1();
        $desc[1] = $this->destination->getDesc2();

        return $desc;
    }

    public function fetchTitles()
    {
        $titles = array();

        $titles[0] = $this->destination->getTitle1();
        $titles[1] = $this->destination->getTitle2();

        return $titles;
    }

    public function fetchTourGuides()
    {
        
    }
}

?>