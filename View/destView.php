<?php

//Controller include
include '../Controller/destController.php';
include '../Controller/tourController.php';
include '../Controller/guideController.php';

//Ask the controller for the necessary information
$country = $_GET['country'];
$state = $_GET['state'];

//Start Session
if(!isset($_SESSION))
    session_start();

//Fetch the destination images
$imgArr = destController::fetchImages($country, $state);

//Fetch the descriptions
$descArr = destController::fetchDesc($country, $state);

//Fetch the image titles
$titleArr = destController::fetchTitles($country, $state);

$textColor = destController::fetchtextColor($country, $state);

$imageSrc = array();
$descSrc = array();
$tours = array();

//Assign images to arrays for display
for ($i = 0 ; $i < count($imgArr); $i++)
{
    $imageSrc[$i] = "../Images/".$imgArr[$i];
}

//Ask destController to fetch number of tours available
$tours = destController::fetchTours($country, $state);

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $state.', '.$country?></title>

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

    <link rel="stylesheet" type="text/css" href="../GeneralStyles.css"/>

    <style>

        .jumbotron 
        {
            background-image : url("<?php echo $imageSrc[2]?>");
        }

        * {
        box-sizing: border-box;
        }

        /* Container for flexboxes */
        .row {
            display: flex;
            flex-wrap: wrap;
            flex:100%;`
        }

        /* Create four equal columns */
        .column {
            flex: 50%;
            text-align:center;
            margin-top: auto;
            margin-bottom:auto;
            /* padding: 20px; */
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
    <header class="jumbotron jumbotron-fluid">

        <!--navigation bar-->
        <nav class="navbar fixed-top transparent navbar-expand-lg navbar-light">

            <!--toggler for small windows-->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!--Home hyperlink-->
            <a class="navbar-brand" href="../index.php"><h3 style="color : white;">Not-Tourist-Trap</h3></a>

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
        
        <div class="destTitle" style="
            display: block;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align:center;"
        >
                    
            <h1 class="display-4" style="font-size: 100px; color:<?php echo $textColor ?>"><?php echo $state ?></h1>
            <hr class="my-4" style="border-color:<?php echo $textColor ?>">
            <p class="lead" style="font-size: 50px; color:<?php echo $textColor ?>"><?php echo $country?></p>
            
        </div>
        
        
    </header>


    <div class="row">

        <div class="column">
            <img src="<?php echo $imageSrc[0]?>" alt="" style="width:100%;"/>
        </div>
        <div class="column text-center">
            <h2 class="display-4" style="font-size : 50px;"><?php echo $titleArr[0]?></h2>
            <hr class="my-4">
            <p style="padding:30px;">
                <?php echo $descArr[0]?>
            </p>
        </div>
    
    </div>

    <div class="row">
        
        <div class="column text-center">
            <h2 class="display-4" style="font-size : 50px;"><?php echo $titleArr[1]?></h2>
            <hr class="my-4">
            <p style="padding:30px;">
                <?php echo $descArr[1]?>
            </p>
        </div>
    
        <div class="column">
            <img src="<?php echo $imageSrc[1]?>" alt="" style="width:100%;"/>
        </div>
        
    </div>
    
    <br><br>

    <!-- Tour Guide Displays -->
    <div class="toursAvail">
        <h2 style="margin : 20px;">Tours Available</h2>

        <div class="container-fluid">
            <div class="row flex-row flex-nowrap">
            
                <?php if(count($tours) > 0) : ?>

                    <?php foreach($tours as $x) : ?>
                        <?php if($x['Status'] == 'YTS') :?>
                            <?php 

                                $guideDetails = array();

                                //Ask guideCtr for tourguide name and profileImg
                                $guideDetails= tourController::fetchTourGuideDetails($x['TourGuideID']);
                                //$guideImg = $destCtr->fetchTourGuideImg($x['TourGuideID']);

                                $guideDetails[3] = "../Uploaded_Images/".$guideDetails[3];
                            ?>

                            <div class="col-3">
                                <div class="card card-block text-center">
                                    <img class="card-img-top" src="<?php echo $guideDetails[3] ?>" alt="tourguide" style="width:500px; height:400px">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $x['Name']?></h5>
                                        <p class="card-text">By : <?php echo $guideDetails[1].' '. $guideDetails[2] ?></p>
                                        <a href="./tourView.php?state=Paris&country=France&tourID=<?php echo $x['TourID']?>&tourName=<?php echo $x['Name']?>&tourGuideID=<?php echo $x['TourGuideID']?>&tourGuide=<?php echo $guideDetails[1].' '. $guideDetails[2] ?>&bgImg=<?php echo $imageSrc[2]?>">
                                            <button type="button" class="btn btn-primary">Click Here for More Details</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endif;?>

                    <?php endforeach; ?>

                <?php endif;?>

            </div>
        </div>

    </div>

</body>
</html>