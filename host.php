<?php //Start session

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Host a Tour</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="./src/bootstrap-input-spinner.js"></script>

    <link rel="stylesheet" type="text/css" href="GeneralStyles.css"/>

    <style>

        .jumbotron
        {
            background-image: url("Images/bali.jpg");
            height:100vh;
        }

        .welcome
        {
            position: absolute;
            top: 25%;
            left: 2%;
            /* transform: translate(-50%); */
            color : white;
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

            <!-- nav bar -->
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">

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
        
        <!--Welcome text-->
        <?php
            if (isset($_SESSION['ufName']))
            {
                $ufName = $_SESSION['ufName'];

                echo <<< GENERALWELCOME

                    <div class="welcome">
                        <h1 class="display-4"><b>Welcome to Not-Tourist-Trap <br> Experiences</b>, $ufName</h1>
                        <p class="lead"><b>Start a personalised tour of your own and <br> earn money</b></p>
                        <hr class="my-4">
                        <a class="btn btn-primary btn-light" id="startBtn" href="./View/hostForm.php" role="button">Let's Start!</a>
                    </div>

GENERALWELCOME;
            }
            else
            {
                echo <<< GENERALWELCOME

                    <div class="welcome">
                        <h1 class="display-4"><b>Welcome to Not-Tourist-Trap <br> Experiences</b></h1>
                        <p class="lead"><b>Here, you can host a personalised tour of your own and <br> earn money</b></p>
                        <hr class="my-4">
                        <a class="btn btn-primary btn-light" id="startBtn" href="./View/login.php" role="button">Let's Start!</a>
                    </div>

GENERALWELCOME;
            }
        ?>
        

    </header>

</body>
</html>