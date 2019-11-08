<?php

//include controller
include '../Controller/bookingController.php';
include '../Controller/tourController.php';
include '../Controller/destController.php'

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
                                //query for tour guide name
                                $guideDetails = tourController::fetchTourGuideDetails($data2['TourGuideID']);

                                //query for state name
                                $stateDetails = destController::
                            }
                            
                        ?>

                        <div class="col-3">
                            <div class="card card-block">
                                <img class="card-img-top" src="../Uploaded_Images/<?php echo $guideDetails[3] ?>" alt="labuan bajo cap" style="width:500px; height:400px">
                                <div class="card-body">
                                    <h5 class="card-title">Flores, Indonesia</h5>
                                    <p class="card-text">Love the beach? Love nature? Love being in unspoilt territory? Then Labuan Bajo is next on your list. If you’ve never heard of this Asian paradise in Flores, Indonesia, it’s not too late to book a tour there now</p>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>

                <?php endif; ?>


                <!-- <div class="col-3">
                    <div class="card card-block">
                        <img class="card-img-top" src="Images/prague.jpg" alt="prague cap" style="width:500px; height:400px">
                        <a href="View/destView.php?country=Czech Republic&state=Prague">
                            <div class="card-body">
                                <h5 class="card-title">Prague, Czech Republic</h5>
                                <p class="card-text">Prague is one of those places that seems like it was pulled straight from a fairy tale. Head to Prague Castle, specifically, and you'll see what we mean. The complex of castles have been around since the 9th century, and they've got the charm to prove it</p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-3">
                    <div class="card card-block">
                        <img class="card-img-top" src="Images/nyc.jpeg" alt="new york city cap" style="width:500px; height:400px">
                            <div class="card-body">
                                <h5 class="card-title">New York City, USA</h5>
                                <p class="card-text">Discover why so many people love New York City. There's plenty of events, attractions and restaurants to experience. Let the experienced tour guides help you plan your NYC adventure</p>
                            </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="card card-block">
                        <img class="card-img-top" src="Images/seoul.jpeg" alt="seoul cap" style="width:500px; height:400px">
                            <div class="card-body">
                                <h5 class="card-title">Seoul, South Korea</h5>
                                <p class="card-text">Fashion- and technology-forward but also deeply traditional, this dynamic city mashes up palaces, temples, cutting-edge design and mountain trails, all to a nonstop K-Pop beat</p>
                            </div>
                    </div>
                </div> -->

            </div>
       </div>

    </header>
    <!-- end jumbotron header -->

</body>
</html>