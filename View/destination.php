<?php

//Controller include
include '../Controller/destController.php';

//Ask the controller for the necessary information
$country = $_GET['country'];
$state = $_GET['state'];

//Start Session
session_start();

$destCtr = new destController($country, $state);

//Fetch the destination images
$imgArr = $destCtr->fetchImages();

//Fetch the descriptions
$descArr = $destCtr->fetchDesc();

//Fetch the image titles
$titleArr = $destCtr->fetchTitles();

$imageSrc = array();
$descSrc = array();

//Assign them to arrays for display
for ($i = 0 ; $i < count($imgArr); $i++)
{
    $imageSrc[$i] = "../Images/".$imgArr[$i];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
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
                                    <a class="nav-link" href="./host.php" style="color : white">Host a Tour</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="" style="color : white">View Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="./logout.php" style="color : white">Log Out</a>
                                </li>
                            </ul>

LOGGEDNAV;
                    }
                    else
                    {
                        echo <<< GENERALNAV

                        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="./host.php" style="color : white">Host a Tour</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./View/login.php" style="color : white">Log In</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./View/signup.php" style="color : white">Sign Up</a>
                            </li>
                        </ul>

GENERALNAV;
                    }
                ?>
                

            </div>

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
                    
            <h1 class="display-4" style="font-size: 100px;"><?php echo $state ?></h1>
            <hr class="my-4">
            <p class="lead" style="font-size: 50px;"><?php echo $country?></p>
            
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


</body>
</html>