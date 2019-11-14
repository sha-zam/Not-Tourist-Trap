<?php 
include '../Controller/tourReviewController.php';

//Nav Bars
include '../constants/loggedNavBar.php';
include '../constants/generalNavBar.php';

//Start session
if(!isset($_SESSION))
    session_start();

$bookingID = $_GET['booking'];
$userID = $_SESSION['userID'];

if(isset($_POST['submit']))
{
    $inputComment = $_POST['input_tourComment'];
    $comment = addslashes($inputComment);
    $rating = $_POST["input_rating"];

    //checking
    echo "<script type='text/javascript'>alert('$bookingID . $userID')</script>"; 
    echo "<script type='text/javascript'>alert('$comment . $rating')</script>";

    //Pass to Controller
    $check = tourReviewController::submitReview($bookingID, $userID, $comment, $rating);
}
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tour Review - Not-Tourist-Trap</title>
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
        html,body{
            height:100%;
        }

        .jumbotron
        {
            background-image: url("../Images/bali.jpg");
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
        <!-- end nav bar -->
        
         <?php if(isset($check)) : ?> 

            <?php if ($check) : ?>

                <div class="alert alert-success" role="alert" style="width:40rem; margin : 0 auto; padding-bottom:20px;">
                    <h4 class="alert-heading">Review submitted successfully!</h4>
                </div>

            <?php endif; ?>

        <?php endif;?>
        
        <!--Tour Review Form-->
        <div class="accordion" id="accordionForm">
            
            <form action="tourReviewView.php<?php echo "?booking=$bookingID";?>" method="POST" name="tourReviewForm" enctype="multipart/form-data">
                    
                <!--Tour Comment-->
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h1 style="margin : 20px;">Write a review</h1>
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Comment on the tour experience
                            </button>
                        </h2>
                    </div>
                    
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionForm">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputTourComment">Comment</label>
                                <textarea class="form-control" id="tourComment" rows="5" name="input_tourComment" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Country and State-->
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                Give a rating for the tour
                            </button>
                        </h2>
                    </div>
                    
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionForm">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputRating">Rating (Between 1 and 5)</label>
                                <input type="number" name="input_rating" min="1" max="5" required>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" name="submit" class="btn btn-primary" style="margin-top:10px; margin-left:auto; margin-right:auto;">Submit</button>
            </form>
        </div>
        <!-- End Form -->
    </header>
</body>
</html>
