<?php

include 'TourReview.php';

class Profile
{
    private $userID;
    private $fName;
    private $lName;
    private $email;
    private $profileImg;
    private $lang = array();
    
    private $bookingID = array();
    private $tourReview = array();
    
    public function __construct($userID)
    {
        $this->userID = $userID;
    }
    
    //Accessors
    public function getUserID()
    {   
        return ($this->userID);
    }
    
    public function getfName()
    {
        return ($this->fName);
    }
    
    public function getlName()
    {
        return ($this->lName);
    }
    
    public function getEmail()
    {
        return ($this->email);
    }
    
    public function getProfileImg()
    {
        return $this->profileImg;
    }
    
    public function getLang()
    {
        return ($this->lang);
    }
    
    public function getTourReview()
    {
        return ($this->tourReview);
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
    
    public function getProfile()
    {
        $conn = $this->connect();
        
        $query = "select * from USER where UserID = $this->userID";
        
        $count = $conn -> query($query);
        
        if(!empty($count) && $count -> num_rows > 0)
        {
            while($row = $count -> fetch_assoc())
            {
                $this->fName = $row["FirstName"];
                $this->lName = $row["LastName"];
                $this->email = $row["Email"];
                $this->profileImg = $row["Profile_Image"];
            }
           
            //get language ID
            $langQ = "select LanguageID from SPOKENLANGUAGE where UserID = $this->userID";
            $langQ_result = $conn->query($langQ);
            
            if($langQ_result->num_rows > 0)
            {
                while($lang_row = $langQ_result->fetch_assoc())
                {
                    $langData[] = $lang_row['LanguageID'];
                }
                
                for($i = 0; $i < sizeof($langData); $i++)
                {
                    $langID = $langData[$i];
                    
                    $langQ2 = "select Name from LANGUAGE where LanguageID = $langID";
                    $langQ2_result = $conn->query($langQ2);
                    
                    while($lang_row2 = $langQ2_result->fetch_assoc())
                    {
                        $this->lang[$i] = $lang_row2['Name'];
                    }
                }
            }
            
            //reviews for your tour 
            $bookingQ = "select BookingID from BOOKING where TourID in (SELECT TourID from TOUR where TourGuideID = $this->userID)";
            $bookingQ_result = $conn->query($bookingQ);
            
            if(!empty($bookingQ_result) && $bookingQ_result->num_rows > 0)
            {
                while($booking_row = $bookingQ_result->fetch_assoc())
                {
                    $this->bookingID[] = $booking_row["BookingID"];
                }

                foreach($this->bookingID as $key => $value)
                {
                    $tourReview = new TourReview($value);
                    $check = $tourReview->getTourReview();
                    if(!is_bool($check))
                        $this->tourReview[$key] = $check;
                }
            }
            
            $conn->close();
            return $this;
        }
        else
        {
            $conn->close();
            return false;
        }
    }   
}
?>