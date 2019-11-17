<?php
    include '../Model/User.php';

    class settingsController
    {
        private $user;
        
        public function __construct($id) {
           $this->user = User::withID($id);
        }
        
        public function updateFName($fName)
        {
            $this->user->updateFName($fName);
        }
        
        public function updateLName($lName)
        {
            $this->user->updateLName($lName);
        }
        
        public function updateEmail($email)
        {
            $this->user->updateEmail($email);
        }
        
        public function updatePassword($password)
        {
            $this->user->updatePassword($password);
        }
        
        public function updateProfilePic($profilePic)
        {
            $this->user->updateProfilePic($profilePic);
        }
        
        public function updateLanguages($lang)
        {
            $this->user->updateLanguages($lang);
        }
    }   
