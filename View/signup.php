<?php

include '../Controller/signupController.php';

$navBar= file_get_contents("../constants/generalNavBar.php");

if (isset($_POST['submit']))
{
    $navBar= file_get_contents("../constants/generalNavBar.php");

    //Get user details
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $fName = $_POST["fName"];
    $lName = $_POST["lName"];
    $primeLang = $_POST["primeLang"];
    $secondLang = $_POST["secondLang"];
    $thirdLang = $_POST["thirdLang"];

    //Get profile image
    chdir('../');
    $x = getCwd();

    $profileImg = time() . '_' . $_FILES['profileImage']['name'];
    $target=  $x . '/Uploaded_Images/' . $profileImg;

    move_uploaded_file($_FILES['profileImage']['tmp_name'], $target);

    //Pass to Controller
    $signUpCtr = new signupController($email, $fName, $lName, $pwd, $profileImg, $primeLang, $secondLang, $thirdLang);

    $check = $signUpCtr -> validateData();

    if(is_bool($check) && ($check))
    {
        header("Location:./login.php?regist=true");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign Up</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="./src/bootstrap-input-spinner.js"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

    <script>

        function triggerClick()
        {
            document.querySelector('#profileImage').click();
        }

        function displayImage(e)
        {
            if(e.files[0])
            {
                var reader = new FileReader();

                reader.onload = function(e)
                {
                    document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
                }

                reader.readAsDataURL(e.files[0]);
            }
        }

        function validateForm() 
        {
            var profileImage = document.forms["signup"]["profileImage"].value;

            if (profileImage == "") 
            {
                alert("Please set a Profile Image!");
                return false;
            }
            
            if( document.getElementById("termCheck").checked == false)
            {
                alert("Please Agree to the Terms of Privacy!");
                return false;
            }

        }

    </script>

    <link rel="stylesheet" type="text/css" href="../GeneralStyles.css"/>

    <style>

        .jumbotron 
        {
            background-image : url("../Images/hk_night.jpg");
            height : 100%;
        }

        #profileDisplay
        {
            display : block;
            height : 500px;
            width : 80%;
            margin : 10px auto;
            border-radius : 60%;
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
            <a class="navbar-brand" href="../index.php"><h3 style="color : white;">Not-Tourist-Trap</h3></a>

            <!-- nav list -->
            <?php echo $navBar; ?>

        </nav>
        <!-- end nav bar -->

        <!-- Success or Fail Alert -->
        <?php if(isset($check)) : ?> 

            <?php if(is_bool($check) && (!$check)) : ?>

                <div class="alert alert-danger" role="alert" style="width:40rem; margin : 0 auto; padding-bottom:20px;">
                    <h4 class="alert-heading">Failed to Create Account</h4>
                    <hr>
                    <p>User already Exists!</p>
                </div>

            <?php else : ?>

                <div class="alert alert-danger" role="alert" style="width:40rem; margin : 0 auto; padding-bottom:20px;">
                    <h4 class="alert-heading">Failed to Create Account</h4>
                    <hr>
                    <p>Invalid <?php echo $check ?> Provided! Please Enter the Correct Informations</p>
                </div>

            <?php endif;?>
                
        <?php endif;?>
        <!-- End Alert -->


        <!--sign up form-->
        <div class="card" style="width:40rem !important; margin : 0 auto;">

            <div class="card-body">

                <h1 style="margin-top : 10px;">Sign Up</h1>

                    <form action="signup.php" method="POST" name="signup" enctype="multipart/form-data" onsubmit="return validateForm()">
                        <div class="form-group text-center">
                            <img src="../Images/placeholder.jpg" onclick="triggerClick()" id="profileDisplay"/>
                            <label for="profileImage">Profile Image</label>
                            <input name="profileImage" type="file" onchange="displayImage(this)" class="form-control" id="profileImage" style="display:none;">
                        </div>

                        <div class="form-group">
                            <label for="inputEmail">Email address</label>
                            <input name="email" type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Enter email" required>
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword">Password</label>
                            <input name="pwd" type="password" class="form-control" id="inputPassword" placeholder="Password" required>
                            <small id="emailHelp" class="form-text text-muted">Password must be at least 8 characters in length</small>
                        </div>

                        <div class="form-group">
                            <label for="inputFName">First Name</label>
                            <input name="fName" type="text" class="form-control" id="inputfName" placeholder="Enter Your First Name" required>
                        </div>

                        <div class="form-group">
                            <label for="inputLName">Last Name</label>
                            <input name="lName" type="text" class="form-control" id="inputlName" placeholder="Enter Your Last Name" required>
                        </div>

                        <label>Enter Your Languages (For Hosting a Tour)</label>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupLang1">Primary Language</label>
                            </div>
                            <select name="primeLang" class="custom-select" id="inputGroupLang1"></select>
                                <script>
                                    $("#inputGroupLang1").load("../constants/languages.html");
                                </script>
                        </div>
                        
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupLang2">Secondary Language</label>
                            </div>
                            <select name="secondLang" class="custom-select" id="inputGroupLang2"></select>
                            <script>
                                $("#inputGroupLang2").load("../constants/languages.html");
                            </script>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupLang3">Other Language</label>
                            </div>
                            <select name="thirdLang" class="custom-select" id="inputGroupLang3"></select>
                            <script>
                                $("#inputGroupLang3").load("../constants/languages.html");
                            </script>
                        </div>

                        <div class="form-check">
                            <input name="termsCheckbox" type="checkbox" class="form-check-input" id="termsCheck">
                            <label class="form-check-label" for="termsCheck">I hereby agree to the terms of privacy and agreement</label>
                        </div>

                        <button type="submit" name="submit" class="btn btn-dark" style="margin-top : 10px;">Sign Up</button>
                    </form>
                    
            </div>
        </div>
        <!--end sign up form-->

    </header>

</body>
</html>