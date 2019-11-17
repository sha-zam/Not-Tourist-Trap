<?php

    include '../Model/User.php';

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

        public function checkUserValidity($check)
        {
            if(!is_bool($check))
            {
                //check whether user is suspended or not
                $status = $check->getStatus();

                if($status == 'Active')
                {
                    return $check;
                }
                else
                {
                    return 'inactive';
                }
            }
            else
            {
                return $check;
            }
        }

        public function validateData()
        {
            $this->user = new User($this->email, $this->pwd, '', '', '', $this->lang); 

            $checkData = $this->user->checkLogin();

            return $checkData;
        }

        
    }

?>