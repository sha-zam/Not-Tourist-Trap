<?php 

include '../Controller/loginController.php';

function displayForm()
{
    $phpself = $_SERVER["PHP_SELF"];

    echo <<< LOGINFORM
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <title>Log In</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

            <script src="./src/bootstrap-input-spinner.js"></script>

            <style>

                .jumbotron 
                {
                    background-image : url("../Images/hk_night.jpg");
                }
                
            </style>

            <link rel="stylesheet" type="text/css" href="../GeneralStyles.css"/>
            
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
                    <a class="navbar-brand" href="../index.php"><h3 style="color : white;">Not-Tourist-Trap</h3></a>

                    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">

                        <!--nav list-->
                        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="#" style="color : white">Host a Tour</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="login.php" style="color : white">Log In</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="signup.php" style="color : white">Sign Up</a>
                            </li>
                        </ul>

                    </div>

                </nav>
                <!--end nav bar-->

                <div class="card" style="width:40rem; margin : 0 auto;">

                    <div class="card-body">

                        <h1 style="margin-top : 10px;">Log In</h1>

                        <form action="$phpself" method="POST" name="login">
                            <div class="form-group">
                                <label for="inputEmail">Email address</label>
                                <input name="email" type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>

                            <div class="form-group">
                                <label for="inputPassword">Password</label>
                                <input name="pwd" type="password" class="form-control" id="inputPassword" placeholder="Password">
                            </div>

                            <button type="submit" class="btn btn-primary" style="margin-top : 10px;">Log In</button>
                        </form>
                        
                    </div>
                </div>

            </header>

        </body>
        </html>
LOGINFORM;
}

$method = $_SERVER ["REQUEST_METHOD"];

if ($method == "POST")
{
    //get necessary data
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];

    //Pass to Controller
    $loginCtr = new loginController($email, $pwd);

    //Controller validate data 
    $check = $loginCtr->validateData();

    if (!$check)
    {
        //to be changed later, testing only
        echo "<script type='text/javascript'>alert('Invalid Email or Password')</script>";
        header("location:../View/login.php");
    }
    else
    {
        session_start();

        $ufName = $check->getfName();
        $ulName = $check->getlName();
        $uLangs = $check->getLangs();

        $_SESSION['userID'] = $check->getUserID();
        $_SESSION['pwd'] = $check->getPwd();
        $_SESSION['email'] = $check->getEmail();
        $_SESSION['ufName'] = $check->getfName();
        $_SESSION['ulName'] = $check->getlName();
        $_SESSION['uLangs'] = $check->getLangs();

        //$langs = count($x3);

        //to be changed later, testing only
        //echo "<script type='text/javascript'>alert('$x1, $x2, $x3[0], $x3[1], $x3[2]')</script>";
        header("location:../index.php");
    }
}
else
{
    displayForm();
}

?>


