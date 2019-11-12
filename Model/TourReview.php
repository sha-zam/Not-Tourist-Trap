<?php
    
class TourReview
{
    private $bookingID;
    private $tourID;
    
    private $comment;
    private $rating;
    private $tourName;
    private $reviewerName;
    private $reviewerID;
    
    public function __construct($bookingID) {
        $this->bookingID = $bookingID;
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
    
    //assessors
    public function getComment(){
        return $this->comment;
    }
    
    public function getRating(){
        return $this->rating;
    }
    
    public function getTourName(){
        return $this->tourName;
    }
    
    public function getReviewerName(){
        return $this->reviewerName;
    }
    
    public function getReviewerID(){
        return $this->reviewerID;
    }
    
    
    public function getTourReview()
    {
        $conn = $this->connect();
        
        $query = "select * from TOURREVIEW where BookingID = $this->bookingID";
        $count = $conn -> query($query);
        
        if(!empty($count) && $count -> num_rows > 0)
        {
            //query tour ID
            $tourID_Q = "SELECT * FROM booking WHERE BookingID = '$this->bookingID' ";
            $tourQResult = $conn->query($tourID_Q);

            if(empty($tourQResult) && $tourQResult -> num_rows > 0)
            {
                //tourreview table 
                while($row = $count->fetch_assoc())
                {
                    $this->reviewerID = $row["ReviewByUser"];
                    $this->comment = $row["Comment"];
                    $this->rating = $row["Rating"];
                }

                //tour table
                while($row2 = $tourQResult->fetch_assoc())
                {
                    $this->tourID = $row2['TourID'];
                }
                
                $tourdetailsQ = "select Name from TOUR where TourID = $this->tourID";
                $tourdetailsQ_result = $conn->query($tourdetailsQ);
                
                if($tourdetailsQ_result->num_rows > 0)
                {
                    while($tourRow = $tourdetailsQ_result->fetch_assoc())
                    {
                        $this->tourName = $tourRow["Name"];
                    }
                }
                
                $reviewerQ = "select * from USER where UserID = $this->reviewerID";
                $reviewerQ_result = $conn->query($reviewerQ);
                
                if($reviewerQ_result->num_rows > 0)
                {
                    while($reviewerRow = $reviewerQ_result->fetch_assoc())
                    {
                        $this->reviewerName = $reviewerRow["FirstName"]." ".$reviewerRow["LastName"];
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
        else{
            
            $conn->close();
            return false;
        }
    }
}
    
?>

