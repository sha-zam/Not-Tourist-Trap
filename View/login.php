<?php 

include '../Controller/loginController.php';

if (isset($_POST['submit']))
{
    //get necessary data
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];

    echo "<script type='text/javascript'>alert('Checking $email and $pwd')</script>";

    //Pass to Controller
    $loginCtr = new loginController($email, $pwd);

    //Controller validate data 
    $check = $loginCtr->validateData();

    if ($check)
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
        $_SESSION['profileImg'] = $check->getProfileImg();

        $temp = $_SESSION['profileImg'];

        //to be changed later, testing only
        //echo "<script type='text/javascript'>alert('$temp')</script>";
        header("location:../index.php");
    }
}

?>

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

            <!-- nav list -->
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
        <!-- end nav bar -->

        <!-- Fail Alert -->
        <?php if(isset($check)) : ?> 

            <?php if (!$check) : ?>

                <div class="alert alert-danger" role="alert" style="width:40rem; margin : 0 auto; padding-bottom:20px;">
                    <h4 class="alert-heading">Invalid Information!</h4>
                    <hr>
                    <p>Please Enter the Correct Email or Password!</p>
                </div>

            <?php endif; ?>

        <?php endif;?>
        <!-- End Alert -->
        
        <!-- login form -->
        <div class="card" style="width:40rem; margin : 0 auto;">
       
            <div class="card-body">
                
                <h1 style="margin-top : 10px;">Log In</h1>
                
                <form action="login.php" method="POST" name="login" class="px-4 py-3">
                    <div class="form-group">
                        <label for="inputEmail">Email address</label>
                        <input name="email" type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>

                    <div class="form-group">
                        <label for="inputPassword">Password</label>
                        <input name="pwd" type="password" class="form-control" id="inputPassword" placeholder="Password">
                    </div>

                    <button type="submit" name="submit" class="btn btn-dark" style="margin-top : 10px;">Log In</button>
                </form>

                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="./signup.php">New around here? Sign up</a>
                <a class="dropdown-item" href="#">Forgot password?</a>
                
            </div>

        </div>

    </header>

</body>
</html>


