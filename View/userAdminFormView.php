<?php 

    //Controller class
    include '../Controller/userAdminController.php';

    $id = $_GET['user'];
    
    $oldEmail = userAdminController::getEmail($id);
    
    if(isset($_POST['input_email'])){
        $newEmail = test_input($_POST['input_email']);
        userAdminController::updateEmail($id, $newEmail);
        
        $oldEmail = userAdminController::getEmail($id);
    }
    else if(isset($_POST['input_password'])){
        $password = $_POST['input_password'];
        userAdminController::updatePassword($id, $password);
    }
    else if(isset($_POST['input_status'])){
        $status = $_POST['input_status'];
        userAdminController::updateStatus($id, $status);
    }
    else if(isset($_POST['input_role'])){
        $role = $_POST['input_role'];
        userAdminController::updateRole($id, $role);
    }
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Admin Page - Not Tourist Trap</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <link rel="stylesheet" type="text/css" href="../GeneralStyles.css"/>

    <style>
        html, body{
            height: 100%;
        }
        .jumbotron
        {
            background-image: url("../Images/New-York-City-Night-Cityscape.jpg"); 
            height: 100%;
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
            <a class="navbar-brand" href="./userAdminView.php"><h3 style="color : white;">Not-Tourist-Trap</h3></a>

            <!--nav list-->
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/Not-Tourist-Trap/logout.php" style="color : white">Log Out</a>
                    </li>
                </ul>
            </div>
            
        </nav>
        
        <!--Change Account Settings Form-->
        <div class="accordion" id="accordionForm">
            <!--Email-->
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h1 style="margin : 20px;">Account settings for <?php echo"$oldEmail";?></h1>
                    <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Update Email
                        </button>
                    </h2>
                </div>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionForm">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputFirstName">Input New Email</label>
                            <form id="email_form" action="userAdminFormView.php?user=<?php echo"$id";?>" method="POST" enctype="multipart/form-data">
                                <input name="input_email" type="email" class="form-control" id="email" required>
                                <button type="submit" name="submit_email" class="btn btn-primary" style="margin-top:10px; margin-left:auto; margin-right:auto;">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!--Password--> 
            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h2 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Update Password
                        </button>
                    </h2>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionForm">
                    <div class="card-body">
                        <div class="form-group">
                            <form id="password_form" action="userAdminFormView.php?user=<?php echo"$id";?>" method="POST" enctype="multipart/form-data">
                                <label for="inputPassword">Input New Password</label>
                                <input name="input_password" type="password" class="form-control" id="inputPassword" minlength="8" required>
                                <small id="passwordHelp" class="form-text text-muted">Password must be at least 8 characters in length</small>
                                <button type="submit" name="submit_password" class="btn btn-primary" style="margin-top:10px; margin-left:auto; margin-right:auto;">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!--User Status-->
            <div class="card">
                <div class="card-header" id="headingThree">
                    <h2 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Change User Status
                        </button>
                    </h2>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionForm">
                    <div class="card-body">
                        <div class="form-group">
                            <form id="status_form" action="userAdminFormView.php?user=<?php echo"$id";?>" method="POST" enctype="multipart/form-data">
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="input_status" id="statusRadios1" value="Active" checked>
                                        <label class="form-check-label" for="statusRadios1">Active</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="input_status" id="statusRadios2" value="Inactive">
                                        <label class="form-check-label" for="statusRadios2">Inactive</label>
                                    </div>
                                </div>
                                <button type="submit" name="submit_status" class="btn btn-primary" style="margin-top:10px; margin-left:auto; margin-right:auto;">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!--User Role-->
            <div class="card">
                <div class="card-header" id="headingFour">
                    <h2 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            Change User Role
                        </button>
                    </h2>
                </div>
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionForm">
                    <div class="card-body">
                        <div class="form-group">
                            <form id="status_form" action="userAdminFormView.php?user=<?php echo"$id";?>" method="POST" enctype="multipart/form-data">
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="input_role" id="roleRadios1" value="User" checked>
                                        <label class="form-check-label" for="roleRadios1">User</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="input_role" id="roleRadios2" value="Admin">
                                        <label class="form-check-label" for="roleRadios2">Admin</label>
                                    </div>
                                </div>
                                <button type="submit" name="submit_role" class="btn btn-primary" style="margin-top:10px; margin-left:auto; margin-right:auto;">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </header>
</body>
</html>
