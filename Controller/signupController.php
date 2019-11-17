<?php

    include '../Model/User.php';

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
                return 'Password';
            }
            else if ($this->email == '') //check other things
            {
                return 'Email';
            } 
            else if ($this->fName == '' || $this->lName == '')
            {
                return 'Name';
            }
            else if ($this->profileImg == '')
            {
                return 'Profile Image';
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