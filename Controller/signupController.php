<?php

    include '../Model/Tourist.php';

    class signupController 
    {
        private $user;
        private $email;
        private $fName;
        private $lName;
        private $pwd;
        private $profileImg;
        private $lang = array();

        public function __construct($email, $fName, $lName, $pwd, $profileImg, $primeLang, $secondLang, $thirdLang)
        {
            $this->email = $email;
            $this->pwd = $pwd;
            $this->profileImg = $profileImg;

            $this->fName = $fName;
            $this->lName = $lName;

            $this->lang[0] = $primeLang;
            $this->lang[1] = $secondLang;
            $this->lang[2] = $thirdLang;
        }

        public function validateData()
        {   
            //check password length
            if (strlen($this->pwd) < 8)
            {
                return false;
            }
            else
            {
                $this->user = new User($this->email, $this->pwd, $this->fName, $this->lName, $this->profileImg, $this->lang);
                $checkRegist = $this->user->Regist();

                return ($checkRegist);
            }         
        }
    }

?>