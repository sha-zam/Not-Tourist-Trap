<?php

//Controllers
include '../Controller/GuideController.php';
include '../Controller/tourController.php';
include '../Controller/destController.php';
include '../Controller/tourReviewController.php';

//Nav Bars
include '../constants/loggedNavBar.php';
include '../constants/generalNavBar.php';

if(!isset($_SESSION))
    session_start();

//fetch tours using user ID
$tours = GuideController::fetchTours();

$activeTours = array();
$pastTours = array();

if($tours != false)
{
    foreach($tours as $tourData)
    {
        //retrieve booking for tours
        $bookingDetails = GuideController::retrieveBooking($tourData['TourID']);

        //check if a review exists for the tour
        //check if booking is already reviewed using bookingID
        $checkReview = tourReviewController::retrieveReview($bookingDetails[3]);

        if(is_bool($checkReview) && (!$checkReview)) //if its an active tour
        {
            array_push($activeTours, $tourData);
        }
        else
        {
            array_push($pastTours, $tourData);
        }

    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tours</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="./src/bootstrap-input-spinner.js"></script>

    <link rel="stylesheet" type="text/css" href="../GeneralStyles.css"/>
    
    <style>

    body
    {
        background-image:url("../Images/bali.jpg");
        background-size: cover;
        background-position: center;
        margin-bottom: 0;
        background-attachment: fixed;
        background-repeat: no-repeat;
    }

    .container-fluid 
    {
        overflow-x : auto;
    }

    .container-fluid::-webkit-scrollbar 
    { 
        display: none; 
    } 

    .card-img-top 
    {
        max-width: 100%;
        max-height : 100%;
        object-fit: cover;
    }

    </style>

</head>
<body>

    <!--navigation bar-->
    <nav class="navbar fixed-top transparent navbar-expand-lg navbar-light">

        <!--toggler for small windows-->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!--Home hyperlink-->
        <a class="navbar-brand" href="../index.php"><h3 style="color : white;">Not-Tourist-Trap</h3></a>

        <!-- nav list -->
        <?php
            if (isset($_SESSION['ufName'])) //display nav bar according to whether the user has been logged in
            {
                echo displayLoggedNavBar($_SESSION['userID']);
            }
            else
            {
                echo displayGeneralNavBar();
            }
        ?>

    </nav>
    <!--end navigation bar-->
    
    <!-- alert section -->
    <?php if (isset($_GET['alert'])) :?>

        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Tour Successfully Updated!</h4>
            <hr>
            <p>Your Tour has been Successfully Updated!</p>
        </div>

    <?php endif; ?>
    <!-- end alert section -->
    
    <!-- Active Tours Section -->
    <div class="container-fluid">

        <h1 class="display-4" style="color:white;margin-left:20px;margin-top:5%;"><b>Your Ongoing Tours</b></h1>
    
        <div class="row flex-row flex-nowrap">

            <?php if(count($activeTours) == 0) :?>

                <p class="lead" style="color:white; margin-left:30px;"><b>No Ongoing Tour Available</b></p>
            
            <?php else :?>

                <?php foreach($activeTours as $data) :?>

                    <?php     
                        $tourName = $data['Name'];
                        $tourID = $data['TourID'];

                        //query for state and country name
                        $country = destController::fetchCountryDetails($data['CountryID']);
                        $state = destController::fetchStateDetails($data['StateID']);       
                        
                        //query for tour images
                        $images = tourController::fetchTourImages($tourID);
                    ?>

                    <div class="col-3">
                        <div class="card card-block">
                            <img class="card-img-top" src="../Uploaded_Images/<?php echo $images[0]?>" alt="tour image" style="width:500px; height:400px">
                            <a href="./updateTour.php?tourID=<?php echo $tourID?>">
                                <div class="card-body text-center">
                                    <h4 class="card-title"><?php echo $state[0]['Name'].', '.$country[0]['Name'] ?></h4>
                                    <h5 class="card-title"><?php echo $tourName ?></h5>
                                </div>
                            </a>
                            
                        </div>
                    </div>

                <?php endforeach; ?>

            <?php endif; ?>

        </div>
    </div>
    <!-- End Active Tours Section -->

    <!-- Past Tours Section -->
    <div class="container-fluid">

        <h1 class="display-4" style="color:white;margin-left:20px;margin-top:5%;"><b>Past Tours</b></h1>
    
        <div class="row flex-row flex-nowrap">

            <?php if(count($pastTours) == 0) :?>

                <p class="lead" style="color:white; margin-left:30px;"><b>No Past Tours Yet</b></p>
            
            <?php else :?>

                <?php foreach($pastTours as $data2) :?>

                    <?php     
                        $tourName2 = $data2['Name'];
                        $tourID2 = $data2['TourID'];

                        //query for state and country name
                        $country2 = destController::fetchCountryDetails($data2['CountryID']);
                        $state2 = destController::fetchStateDetails($data2['StateID']);       
                        
                        //query for tour images
                        $images2 = tourController::fetchTourImages($tourID2);
                    ?>

                    <div class="col-3">
                        <div class="card card-block">
                            <img class="card-img-top" src="../Uploaded_Images/<?php echo $images2[0]?>" alt="tour image" style="width:500px; height:400px">
                            <a href="./pastTour.php?tourID=<?php echo $tourID2?>">
                                <div class="card-body text-center">
                                    <h4 class="card-title"><?php echo $state2[0]['Name'].', '.$country2[0]['Name'] ?></h4>
                                    <h5 class="card-title"><?php echo $tourName2 ?></h5>
                                </div>
                            </a>
                            
                        </div>
                    </div>

                <?php endforeach; ?>

            <?php endif; ?>

        </div>
    </div>
    <!-- End Past Tours Section -->

</body>
</html>