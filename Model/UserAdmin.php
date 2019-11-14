<?php

class UserAdmin
{
    private $email;
    
    public function __construct()
    {
        
    }
    
    private function connect()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "csit3142";

        $conn = new mysqli($servername, $username, $password, $dbname);

        return $conn;
    }
    
    public function validateEmail($email)
    {
        $conn = $this->connect();
        
        $query = "SELECT UserID FROM user WHERE email = '$email'";
        
        $check = $conn->query($query);
        $count_row = $check->num_rows;
        
        if($count_row > 0) //user exists
        {
            while($row = $check->fetch_assoc())
            {
                $userID = $row["UserID"];
            }
            
            return $userID;
        }
        else
        {
            return false;
        }
    }
    
    public function getEmail($id)
    {
        $conn = $this->connect();
        
        $query = "SELECT Email FROM user WHERE UserID = '$id'";
        
        $check = $conn->query($query);
        $count_row = $check->num_rows;
        
        if($count_row > 0)
        {
            while($row = $check->fetch_assoc())
            {
                $email = $row["Email"];
            }
            
            return $email;
        }
        else
        {
            return false;
        }
    }
    
    public function updateEmail($id, $email)
    {
        $conn = $this->connect();
        
        $query = "UPDATE User SET Email = '$email' WHERE UserID = '$id'";
        
        $conn->query($query);
    }
    
    public function updatePassword($id, $password)
    {
        $conn = $this->connect();
        
        $query = "UPDATE User SET Password = '$password' WHERE UserID = '$id'";
        
        $conn->query($query);
    }
    
    public function updateStatus($id, $status)
    {
        $conn = $this->connect();
        
        $query = "UPDATE User SET Status = '$status' WHERE UserID = '$id'";
        
        $conn->query($query);
    }
    
    public function updateRole($id, $role)
    {
        $conn = $this->connect();
        
        $query = "UPDATE User SET Role = '$role' WHERE UserID = '$id'";
        
        $conn->query($query);
    }
}

?>