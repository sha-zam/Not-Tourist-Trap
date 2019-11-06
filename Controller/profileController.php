<?php

include '../Model/Profile.php';

class profileController
{
    private $userID;
    private $profile;
    
    public function __construct($userID)
    {
        $this->userID = $userID;
    }
    
    public function validateUser()
    {
        $this->profile = new Profile($this->userID);
        $checkUser = $this->profile->getProfile();
        
        return ($checkUser);
    }
}

?>
