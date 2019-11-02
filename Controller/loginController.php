<?php

    include '../Model/Tourist.php';

    class loginController 
    {
        private $user;
        private $email;
        private $pwd;
        private $lang = array();

        public function __construct($email, $pwd)
        {
            $this->email = $email;
            $this->pwd = $pwd;

            //insert empty strings as languages (login does not need languages)
            for($i = 0; $i < 3; $i++)
            {
                $this->lang[$i] = '';
            }
        }

        public function validateData()
        {
            $this->user = new Tourist($this->email, $this->pwd, '', '', $this->lang); 

            $checkData = $this->user->touristLogin();
            return $checkData;
        }
    }

?>