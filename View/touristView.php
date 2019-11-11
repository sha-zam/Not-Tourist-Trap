<?php

//include controller
include '../Controller/bookingController.php';
include '../Controller/tourController.php';
include '../Controller/destController.php';

//session start 
if (!isset($_SESSION))
    session_start();

//ask controller to fetch bookings to display in cards
$bookings = bookingController::retrieveBooking('tourist', $_SESSION['userID'], $_SESSION['email'], $_SESSION['pwd'], $_SESSION['ufName'], $_SESSION['ulName'], $_SESSION['profileImg'], $_SESSION['uLangs']);

//data to be displayed : country, state, tour name, tour guide

//check if any bookings exist
if($bookings != false)
{
    if ($bookings->num_rows > 0)
    {
        //populate tour details
        while($row = $bookings->fetch_assoc())
        {
            $bookingData[]=$row;
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
    <title>Bookings</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="./src/bootstrap-input-spinner.js"></script>

    <link rel="stylesheet" type="text/css" href="../GeneralStyles.css"/>
    
    <style>

    .jumbotron
    {
        background-image:url("../Images/hk_night.jpg");
        height:100vh;
    }

    .container-fluid 
    {
        overflow-x : auto;
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
    
    <!-- jumbotron header -->
    <header class="jumbotron jumbotron-fluid">

        <!--navigation bar-->
        <nav class="navbar fixed-top transparent navbar-expand-lg navbar-light">

            <!--toggler for small windows-->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!--Home hyperlink-->
            <a class="navbar-brand" href="../index.php"><h3 style="color : white;">Not-Tourist-Trap</h3></a>

            <!--nav list-->
            <?php
                if (isset($_SESSION['ufName'])) //display nav bar according to whether the user has been logged in
                {
                    include_once("../constants/loggedNavBar.php");
                }
                else
                {
                    include_once("../constants/generalNavBar.php");
                }
            ?>

        </nav>
        <!--end navigation bar-->

        <div class="container-fluid">

            <h1 class="display-4" style="color:white;"><b>Your Bookings</b></h1>

            <div class="row flex-row flex-nowrap">

                <?php if(!$bookings) :?>

                    <p class="lead" style="color:white; margin-left:20px;"><b>No Bookings Available</b></p>
                
                <?php else :?>

                    <?php foreach($bookingData as $data) :?>

                        <?php 
                            $tourDetails = tourController::fetchTourDetails($data['TourID']);

                            foreach($tourDetails as $data2)
                            {
                                $tourName = $data2['Name'];

                                //query for tour guide name
                                $guideDetails = tourController::fetchTourGuideDetails($data2['TourGuideID']);

                                //query for state and country name
                                $country = destController::fetchCountryDetails($data2['CountryID']);
                                $state = destController::fetchStateDetails($data2['StateID']);
                            }
                            
                        ?>

                        <div class="col-3">
                            <a href="./updateTour.php?tourID=<?php echo $data['TourID']?>">
                                <div class="card card-block">
                                    <img class="card-img-top" src="../Images/<?php echo $state?>.jpg" alt="tour" style="width:500px; height:400px">
                                    <div class="card-body text-center">
                                        <h4 class="card-title"><?php echo $state[0]['Name'].', '.$country[0]['Name'] ?></h4>
                                        <h5 class="card-title"><?php echo $tourName ?></h5>
                                        <p class="card-text">By : <?php echo $guideDetails[1].' '.$guideDetails[2]?></p>
                                    </div>
                                </div>
                            </a>
                        </div>

                    <?php endforeach; ?>

                <?php endif; ?>

            </div>
       </div>

    </header>
    <!-- end jumbotron header -->

</body>
</html>