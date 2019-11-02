<?php

include_once('User.php');

class Tourist extends User
{
    public function __construct($email, $pwd, $fName, $lName, $lang)
    {
        parent :: __construct($email, $pwd, $fName, $lName, $lang);
    }

    public function touristLogin()
    {
        return ($this->checkLogin());
    }

    public function touristSignUp()
    {
        return ($this->Regist());
    }

    public function insertBooking()
    {

    }

    public function viewBookings()
    {

    }

    public function bookTour()
    {

    }
}

?>