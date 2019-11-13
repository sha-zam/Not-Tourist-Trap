<?php

include '../Model/TourReview.php';

class tourReviewController
{
    public static function submitReview($bookingID, $userID, $comment, $rating)
    {
        $review = new TourReview($bookingID);
        
        $check = $review->submitReview($userID, $comment, $rating);
        
        return $check;
    }
}
