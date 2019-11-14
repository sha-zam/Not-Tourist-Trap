<?php
    include '../Model/UserAdmin.php';

    class userAdminController
    {
        public static function validateEmail($email)
        {
            $userAdmin = new UserAdmin();
            $result = $userAdmin->validateEmail($email);
            
            return $result;
        }
        
        public static function getEmail($id)
        {
            $userAdmin = new UserAdmin();
            $email = $userAdmin->getEmail($id);
            
            return $email;        
        }
        
        public static function updateEmail($id, $email)
        {
            $userAdmin = new UserAdmin();
            $userAdmin->updateEmail($id, $email);
        }
        
        public static function updatePassword($id, $password)
        {
            $userAdmin = new UserAdmin();
            $userAdmin->updatePassword($id, $password);
        }
        
        public static function updateStatus($id, $status)
        {
            $userAdmin = new UserAdmin();
            $userAdmin->updateStatus($id, $status);
        }
        
        public static function updateRole($id, $role)
        {
            $userAdmin = new UserAdmin();
            $userAdmin->updateRole($id, $role);
        }
    }   
