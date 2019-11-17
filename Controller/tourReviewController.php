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

    public static function retrieveReview($bookingID)
    {
        $review = new TourReview($bookingID);
        
        $check = $review->getTourReview();

        return $check;
    }
}
