<?php

//include controllers
include '../Controller/tourController.php';
include '../Controller/destController.php';

//start session
session_start();

//get params
$country = $_GET['country'];
$state = $_GET['state'];
$tourID = $_GET['tourID'];
$tourName = str_replace("%20", " ", $_GET['tourName']);
$tourGuide = str_replace("%20", " ", $_GET['tourGuide']);
$bgImg = $_GET['bgImg'];
$tourGuideID = $_GET['tourGuideID'];

//Ask destController to fetch tour details
$destCtr = new destController($country, $state);
$result = $destCtr->fetchTours();

if($result->num_rows > 0)
{
    while($row = $result->fetch_assoc())
    {
        $tours[] = $row; //tour rows
    }

    //get specific tour details matching tour ID
    foreach($tours as $x)
    {
        if($x['TourID'] == $tourID)
        {
            $tourDesc = $x['Description'];
            $tourSD = date_create($x['Start_date']);
            $tourED = date_create($x['End_date']);
            $tourPrice = $x['Price'];
        }
    }
}

//fetch tour Images (necessary info : TourID and TourGuideID)
$tourImg = tourController::fetchTourImages($tourID, $tourName, $tourGuideID, $country, $state, $tourDesc, $tourPrice, $tourSD, $tourED);

function submitBooking()
{
    echo "<script type='text/javascript'>alert('$email'); alert('x')</script>";
}
// if(!$tourImg)
// {
//     echo 'not found';
// }
// else
// {
//     echo $tourImg[0].'<br>';
//     echo $tourImg[1].'<br>';
//     echo $tourImg[2].'<br>';
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $tourName ?></title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="./src/bootstrap-input-spinner.js"></script>

    <script>
        // scroll functions
        $(window).scroll(function(e) {

        // add/remove class to navbar when scrolling to hide/show
        var scroll = $(window).scrollTop();
        if (scroll >= 150) {
            $('.navbar').addClass("navbar-hide");
        } else {
            $('.navbar').removeClass("navbar-hide");
        }

        });
    </script>

    <script type="text/javascript">
        function clicked() {
        if (confirm('Do you want to submit?')) {
            <?php submitBooking() ?>;
        } else {
            return false;
        }
        }

    </script>

    <link rel="stylesheet" type="text/css" href="../GeneralStyles.css"/>

    <style>
        .jumbotron 
        {
            background-image : url("<?php echo $bgImg?>");
            height : 100%;
        }

        .card 
        {
            width : 70rem;
            height : 80rem;
            margin : 0 auto;
            margin-top : 80px;
            margin-bottom : 40px;
        }
    </style>

</head>
<body>

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
            <div class="collapse navbar-collapse">

                <?php
                    if (isset($_SESSION['ufName'])) //display nav bar according to whether the user has been logged in
                    {
                        echo <<< LOGGEDNAV

                            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link" href="../host.php" style="color : white">Host a Tour</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="" style="color : white">View Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="../logout.php" style="color : white">Log Out</a>
                                </li>
                            </ul>

LOGGEDNAV;
                    }
                    else
                    {
                        echo <<< GENERALNAV

                        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="../host.php" style="color : white">Host a Tour</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./login.php" style="color : white">Log In</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./signup.php" style="color : white">Sign Up</a>
                            </li>
                        </ul>

GENERALNAV;
                    }
                ?>
                

            </div>

        </nav>
        <!--end navigation bar-->

        <div class="card">
            <div id="carouselImages" class="carousel slide" data-ride="carousel">

                <div class="carousel-inner">

                    <?php for($i=0; $i < count($tourImg); $i++) :?>
                        <?php $src = "../Uploaded_Images/".$tourImg[$i];?>
                        
                        <?php if($i == 0) : $class = "carousel-item active"?>
                            
                        <?php else : $class="carousel-item"?>

                        <?php endif;?>

                        <div class="<?php echo $class ?>">
                            <img src="<?php echo $src?>" class="d-block w-100" alt="..." style="height:700px;width:400px">
                        </div>

                    <?php endfor;?>
                    
                </div>

                <a class="carousel-control-prev" href="#carouselImages" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselImages" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <div class="card-body text-center">
                <h1 class="card-title"><?php echo $tourName?></h1>
                <h4 class="card-text">By : <?php echo $tourGuide ?></h4>
                <br><br>
                <p class="card-text"><?php echo $tourDesc ?></p>
            </div>

            <div class="card-body">
                <p class="card-text">Dates : <?php echo date_format($tourSD, "d M Y") ?> - <?php echo date_format($tourED, "d M Y") ?></p>
                <p class="card-text">Price : $<?php echo $tourPrice ?></p>
            </div>
            
            <div class="card-body text-center">
                <button type="button" name="book" class="btn btn-primary" onclick="return clicked()">Book Tour</button><br><br>
                <p class="card-text">OR</p>
                <button type="button" class="btn btn-primary">Contact Tour Guide for More Information</button>
            </div>

        </div>

    </header>
    
    

</body>
</html>