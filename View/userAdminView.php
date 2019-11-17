<?php //Form process

    //Controller class
    include '../Controller/userAdminController.php';
    
    if(isset($_POST['input_email'])){
        $email = $_POST['input_email'];
        
        $check = userAdminController::validateEmail($email);
        
        if($check)
        {
            header("Location: userAdminFormView.php?user=$check");
        }
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

    <script src="./src/bootstrap-input-spinner.js"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <link rel="stylesheet" type="text/css" href="../GeneralStyles.css"/>

    <style>
        html, body
        {
            height: 100%;   
        }
        
        .jumbotron
        {
            background-image: url("../Images/New-York-City-Night-Cityscape.jpg"); 
            height:100%;
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
        
        <?php if(isset($check)) : ?> 

            <?php if (!$check) : ?>

                <div class="alert alert-danger" role="alert" style="width:40rem; margin : 0 auto; padding-bottom:20px; text-align: center;">
                    <h4 class="alert-heading">User Email not found. Please try again.</h4>
                </div>

            <?php endif; ?>

        <?php endif;?>

        <!--Select Account Form-->
        <!--User Email-->
        <div class="card" style="top: 50%; left:50%; margin-right: -50%; transform: translate(-50%, -50%);">
            <div class="card-header">
                <h1 style="margin : 20px;">User Account Settings</h1>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="inputEmail">Input Email of account you wish to change</label>
                    <form id="email_form" action="userAdminView.php" method="POST" enctype="multipart/form-data">
                        <input name="input_email" type="email" class="form-control" id="inputEmail" placeholder="Email" required>
                        <button type="submit" name="submit_email" class="btn btn-primary" style="margin-top:10px; margin-left:auto; margin-right:auto;">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        
    </header>
</body>
</html>
