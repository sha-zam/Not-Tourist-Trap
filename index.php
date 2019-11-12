<?php //Start session

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Not Tourist Trap</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="./src/bootstrap-input-spinner.js"></script>

    <script>
        $("input[type='number']").inputSpinner();
    </script>

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
    
    <link rel="stylesheet" type="text/css" href="GeneralStyles.css"/>
    
    <style>
        .jumbotron
        {
            background-image: url("Images/hk_night.jpg");
            height : 100vh;
        }

        .welcome
        {
            position: absolute;
            top: 25%;
            left: 2%;
            /* transform: translate(-50%); */
            color : white;
        }

        .whereToForm
        {
            margin : 0 auto;
            z-index : 0;
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

        .suggestions a 
        {
            text-decoration:none; color:black;
        }

    </style>
</head>
<body>

    <!--jumbotron header-->
    <header class="jumbotron jumbotron-fluid">

        <!--navigation bar-->
        <nav class="navbar fixed-top transparent navbar-expand-lg navbar-light">

            <!--toggler for small windows-->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!--Home hyperlink-->
            <a class="navbar-brand" href="./index.php"><h3 style="color : white;">Not-Tourist-Trap</h3></a>

            <!--nav list-->
            <?php
                if (isset($_SESSION['ufName'])) //display nav bar according to whether the user has been logged in
                {
                    include_once("./constants/loggedNavBar.php");
                }
                else
                {
                    include_once("./constants/generalNavBar.php");
                }
            ?>

        </nav>
        <!--end navigation bar-->
        
        <!--Welcome text--> 
        <?php
            
            //Check whether user is logged in to display appropriate welcome text
            if(isset($_SESSION['ufName']))
            {
                $ufName = $_SESSION['ufName'];

                echo <<< LOGGEDIN

                <div class="welcome">
                    <h1 class="display-4"><b>Welcome, $ufName</b></h1>
                    <p class="lead"><b>Book a tour that is hosted by experienced tour guides, or host a tour of your own</b></p>
                    <hr class="my-4">
                    <a class="btn btn-primary btn-light" id="startBtn" href="#whereTo" role="button">Let's Start!</a>
                </div>

LOGGEDIN;
            }
            else
            {
                echo <<< GENERAL

                <div class="welcome">
                    <h1 class="display-4"><b>Welcome to Not-Tourist-Trap</b></h1>
                    <p class="lead"><b>Here, you can book a tour that is hosted by experienced tour guides, or host a tour of your own</b></p>
                    <hr class="my-4">
                    <a class="btn btn-primary btn-light" id="startBtn" href="#whereTo" role="button">Let's Start!</a>
                </div>

GENERAL;
            }
        ?>

    </header>
    <!--end jumbotron-->

    <br><br>

    <!--where-to form-->
    <div class="whereToForm" id="whereTo">
        <div class="card" style="width:40rem; margin : 0 auto;">
            <div class="card-body">
                <h1 style="margin-top : 10px;">Where to next?</h1>
                <form id="search_form" action="View/searchView.php" method="GET" enctype="multipart/form-data">
                    <div class="input-group mb-3">
                        <input type="text" name="search_country" class="form-control" placeholder="Search for tours by country" aria-describedby="button-addon2">
                        <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Where To Form -->

    <!--Cards of suggestions-->
    <div class="suggestions">
        <h2 style="margin : 20px;">Suggestions for you </h2>

        <div class="container-fluid">
            <div class="row flex-row flex-nowrap">
                <div class="col-3">
                    <div class="card card-block">
                        <img class="card-img-top" src="Images/paris.jpg" alt="paris cap" style="width:500px; height:400px">
                        <a href="View/destView.php?country=France&state=Paris">
                            <div class="card-body">
                                <h5 class="card-title">Paris, France</h5>
                                <p class="card-text">Home to Leonardo da Vinci's Mona Lisa, the Louvre is considered the world's greatest art museum, with an unparalleled collection of items covering the full spectrum of art through the ages</p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-3">
                    <div class="card card-block">
                        <img class="card-img-top" src="Images/labuan_bajo.jpg" alt="labuan bajo cap" style="width:500px; height:400px">
                        <a href="View/destView.php?country=Indonesia&state=Flores">
                            <div class="card-body">
                                <h5 class="card-title">Flores, Indonesia</h5>
                                <p class="card-text">Love the beach? Love nature? Love being in unspoilt territory? Then Labuan Bajo is next on your list. If you’ve never heard of this Asian paradise in Flores, Indonesia, it’s not too late to book a tour there now</p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-3">
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
                        <a href="View/destView.php?country=USA&state=New York City">
                            <div class="card-body">
                                <h5 class="card-title">New York City, USA</h5>
                                <p class="card-text">Discover why so many people love New York City. There's plenty of events, attractions and restaurants to experience. Let the experienced tour guides help you plan your NYC adventure</p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-3">
                    <div class="card card-block">
                        <img class="card-img-top" src="Images/seoul.jpeg" alt="seoul cap" style="width:500px; height:400px">
                        <a href="View/destView.php?country=South Korea&state=Seoul">
                            <div class="card-body">
                                <h5 class="card-title">Seoul, South Korea</h5>
                                <p class="card-text">Fashion- and technology-forward but also deeply traditional, this dynamic city mashes up palaces, temples, cutting-edge design and mountain trails, all to a nonstop K-Pop beat</p>
                            </div>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Cards of Suggestions -->

</body>
</html>