<?php //Form process

    //Controller class
    include '../Controller/settingsController.php';

    //Nav Bars
    include '../constants/loggedNavBar.php';
    include '../constants/generalNavBar.php';

    if(!isset($_SESSION))
        session_start();

    $id = $_SESSION['userID'];
    $settingsCtr = new settingsController($id);
    
    //if (!empty($_POST)) {
    if(isset($_POST['input_fName'])){
        $firstName = $_POST['input_fName'];
        $settingsCtr -> updateFName($firstName);
    }
    else if(isset($_POST['input_lName'])){
        $lastName = $_POST['input_lName'];
        $settingsCtr -> updateLName($lastName);
    }
    else if(isset($_POST['input_email'])){
        $email = $_POST['input_email'];
        $settingsCtr -> updateEmail($email);
    }
    else if(isset($_POST['input_password'])){
        $password = $_POST['input_password'];
        $settingsCtr -> updatePassword($password);
    }
    else if(isset($_FILES['input_profilePic'])){
        //Get profile image
        chdir('../');
        $x = getcwd();

        $profilePic = time() . '_' . $_FILES['input_profilePic']['name'];
        $target=  $x . '/Uploaded_Images/' . $profilePic;

        move_uploaded_file($_FILES['input_profilePic']['tmp_name'], $target);
        
        $settingsCtr -> updateProfilePic($profilePic);
        chdir("View");
    }
    else if((isset($_POST['primeLang'])) || (isset($_POST['secondLang'])) || (isset($_POST['thirdLang']))){
        $lang = array();
        
        $lang[0] = $_POST['primeLang'];
        $lang[1] = $_POST['secondLang'];
        $lang[2] = $_POST['thirdLang'];
        
        $settingsCtr -> updateLanguages($lang);
    }

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Account Settings - Not Tourist Trap</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="./src/bootstrap-input-spinner.js"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <link rel="stylesheet" type="text/css" href="../GeneralStyles.css"/>

    <style>

        .jumbotron
        {
            background-image: url("../Images/New-York-City-Night-Cityscape.jpg"); 
            height:100%;
        }

        .accordion, .alert
        {
            width:40rem; 
            margin:0 auto;
            margin-bottom:20px;
        }

        .card 
        {
            width : 40rem;
            margin : 0px;
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
            <?php
                if (isset($_SESSION['ufName'])) //display nav bar according to whether the user has been logged in
                {
                    echo displayLoggedNavBar($_SESSION['userID']);
                }
                else
                {
                    echo displayGeneralNavBar();
                }
            ?>

        </nav>

        <!--Change Account Form-->
        <div class="accordion" id="accordionForm">
                <!--First Name-->
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h1 style="margin : 20px;">Account Settings</h1>
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                Change First Name
                            </button>
                        </h2>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionForm">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputFirstName">Input New First Name</label>
                                <form id="firstName_form" action="settings.php" method="POST" enctype="multipart/form-data">
                                    <input name="input_fName" type="text" class="form-control" id="firstName" required pattern="[A-Za-z]{1,}">
                                    <button type="submit" name="submit_fName" class="btn btn-primary" style="margin-top:10px; margin-left:auto; margin-right:auto;">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Last Name-->
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Change Last Name
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionForm">
                        <div class="card-body">
                            <div class="form-group">
                                <form id="lastName_form" action="settings.php" method="POST" enctype="multipart/form-data">
                                    <label for="inputLastName">Input New Last Name</label>
                                    <input name="input_lName" type="text" class="form-control" id="inputLastName" required pattern="[A-Za-z]{1,}">
                                    <button type="submit" name="submit_lName" class="btn btn-primary" style="margin-top:10px; margin-left:auto; margin-right:auto;">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--Email-->
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Change Email
                            </button>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionForm">
                        <div class="card-body">
                            <div class="form-group">
                                <form id="email_form" action="settings.php" method="POST" enctype="multipart/form-data">
                                    <label for="inputEmail">Input New Email</label>
                                    <input name="input_email" type="email" class="form-control" id="inputEmail" required>
                                    <button type="submit" name="submit_email" class="btn btn-primary" style="margin-top:10px; margin-left:auto; margin-right:auto;">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Password -->
                <div class="card">
                    <div class="card-header" id="headingFour">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Change Password
                            </button>
                        </h2>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionForm">
                        <div class="card-body">
                            <div class="form-group">
                                <form id="password_form" action="settings.php" method="POST" enctype="multipart/form-data">
                                    <label for="inputPassword">Input New Password</label>
                                    <input name="input_password" type="password" class="form-control" id="inputPassword" minlength="8" required>
                                    <small id="passwordHelp" class="form-text text-muted">Password must be at least 8 characters in length</small>
                                    <button type="submit" name="submit_password" class="btn btn-primary" style="margin-top:10px; margin-left:auto; margin-right:auto;">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile Picture -->
                <div class="card">
                    <div class="card-header" id="headingFive">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                Change Profile Picture
                            </button>
                        </h2>
                    </div>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionForm">
                        <div class="card-body">
                            <form id="profilePic_form" action="settings.php" method="POST" enctype="multipart/form-data">
                                <label>Select Your New Profile Picture</label><br>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="profilePic" name="input_profilePic" aria-describedby="inputGroupFileAddon01" accept=".jpg, .png, .jpeg" required/>
                                        <label class="custom-file-label" for="profilePic">Choose file</label>
                                        <script>
                                            $('#profilePic').on('change',function(){
                                                //get the file name
                                                var files = $(this)[0].files;

                                                //display file selected
                                                $(this).next('.custom-file-label').html(this.value + " selected");
                                            })
                                        </script>
                                    </div>
                                </div>
                                <button type="submit" name="submit_profilePic" class="btn btn-primary" style="margin-top:10px; margin-left:auto; margin-right:auto;">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
               
                <!-- Spoken Languages -->
                <div class="card">
                    <div class="card-header" id="headingSix">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                Set Languages
                            </button>
                        </h2>
                    </div>
                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionForm">
                        <div class="card-body">
                            <form id="languages_form" action="settings.php" method="POST" enctype="multipart/form-data">
                                <label>Set Languages (For Hosting a Tour)</label><br>

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
                                <button type="submit" name="submit_languages" class="btn btn-primary" style="margin-top:10px; margin-left:auto; margin-right:auto;">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
        </div>

    </header>
</body>
</html>
