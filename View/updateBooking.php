<?php

include '../Controller/bookingController.php';
include '../Controller/tourController.php';

//Nav Bars
include '../constants/loggedNavBar.php';
include '../constants/generalNavBar.php';

if (!isset($_SESSION))
    session_start();

//get booking ID and tour ID
$bookingID = $_GET['bookingID'];
$tourID = $_GET['tourID'];

//fetch tour details and images
$tourImages = tourController::fetchTourImages($tourID);
$tourDetails = tourController::fetchTourDetails($tourID);

if(isset($_GET['tourSize']))
{
    $tourSize = $_GET['tourSize'];

    //ask controller to update 
    $check = bookingController::updateBooking($bookingID, $tourID, $tourSize);

    if ($check)
    {
        header("Location:./touristView.php?alert=true");
    }

}
else if(isset($_POST['cancelSubmit']))
{
    //get booking and tour ID
    $tourID = $_GET['tourID'];
    $bookingID = $_GET['bookingID'];

    //ask controller to delete booking
    $check = bookingController::cancelBooking($bookingID, $tourID);

    if ($check)
    {
        header("Location:./touristView.php?alert=true");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Booking</title>

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

        function confirmCancel()
        {
            if(confirm("Do You Want to Cancel This Tour?"))
            {
                cancelForm.submit();
            }
            else
            {
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

        .card 
        {
            width : 70rem;
            height : 90rem;
            margin : 0 auto;
            margin-top : 80px;
            margin-bottom : 40px;
        }

        .alert
        {
            width : 70rem;
            margin : 0 auto;
            margin-top : 30px;
            margin-bottom : 30px;
        }
    </style>

    <script type="text/javascript">

        function showInput() 
        {
            document.getElementById('inputSize').style.display = "block";
            document.getElementById('buttonGroup2').style.display = "block";
            document.getElementById('buttonGroup1').style.display = "none";
        }

        function closeInput()
        {
            document.getElementById('inputSize').style.display = "none";
            document.getElementById('buttonGroup2').style.display = "none";
            document.getElementById('buttonGroup1').style.display = "block";
        }



    </script>

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
        <!--end navigation bar-->
        
        <!-- Alert -->
        <?php if(isset($check)) : ?> 

            <?php if(!$check) : ?>

                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Failed to Update Booking</h4>
                </div>

            <?php endif;?>

        <?php endif;?>
        <!-- End Alert -->

        <div class="card">
            <div id="carouselImages" class="carousel slide" data-ride="carousel">

            <div class="carousel-inner">

                <?php for($i=0; $i < count($tourImages); $i++) :?>
                    <?php $src = "../Uploaded_Images/".$tourImages[$i];?>
                    
                    <?php if($i == 0) : $class = "carousel-item active"?>
                        
                    <?php else : $class="carousel-item"?>

                    <?php endif;?>

                    <div class="<?php echo $class ?>">
                        <img src="<?php echo $src?>" class="d-block w-100" alt="..." style="height:700px;width:400px">
                    </div>

                <?php endfor;?>
                
            </div>

            <a class="carousel-control-prev" href="#carouselImages" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselImages" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            </div>

            <!-- replaced with booking update details if user click -->
            <div id="tourHeader" class="card-body text-center">
                <h1 class="card-title"><?php echo $tourDetails[0]['Name']?></h1>
                <br><br>
                <p class="card-text"><?php echo $tourDetails[0]['Description'] ?></p>
            </div>

            <div id="tourBody" class="card-body">
                <h5 class="card-text">Dates : <?php echo date_format(date_create($tourDetails[0]['Start_date']), "d M Y") ?> - <?php echo date_format(date_create($tourDetails[0]['End_date']), "d M Y") ?></h5>
                <h5 class="card-text">Price : $<?php echo $tourDetails[0]['Price'] ?></h5>
                <h5 class="card-text">Max Tour Size : <?php echo $tourDetails[0]['Group_Size'] ?> people</h5>
            </div>
            
            <?php if($tourDetails[0]['Status'] == 'ENDED') :?>
                <div id="tourEndBody" class="card-body text-center">
                    <h4 class="card-text">Your Tour Has Ended! Please Give a Rating for "<?php echo $tourDetails[0]['Name']?>" by Clicking the Button Below!</h4>
                </div>
            <?php endif; ?>
            
            <!-- end div -->

            <div class="card-body" id="inputSize" style="display : none;">
                <label>How Many People Will be Joining You?</label><br>
                            
                <div class="input-group mb-3">
                    <input type="number" id="tourSize" name="tourSize" class="form-control" value="1" min="1" max="<?php echo $tourSize?>" step="1"/>
                </div>
            </div>

            <!-- button groups -->
            <div class="card-body text-center">

                <!-- first group of buttons (update or rate) -->
                <div id="buttonGroup1">
                    <?php if($tourDetails[0]['Status'] == 'ENDED') : //Check whether tour has ended or not to display appropriate buttons ?>

                        <a href="./tourReviewView.php?booking=<?php echo $bookingID?>"><button type="button" name="rate" class="btn btn-dark">Rate Tour</button></a>
                
                    <?php else : ?>

                        <button type="button" name="update" class="btn btn-dark" onclick="showInput()">Update Booking</button><br><br>
                    

                        <form action="updateBooking.php?bookingID=<?php echo $bookingID?>&tourID=<?php echo $tourID?>" method="post" name="cancelForm" onsubmit="return confirm('Do you really want to cancel your booking?');">
                            <button type="submit" name="cancelSubmit" class="btn btn-dark">Cancel Booking</button>
                        </form>

                    <?php endif; ?>
                    
                </div>
                <!-- end group 1 -->
                
                <!--second group of buttons-->
                <div id="buttonGroup2" style="display:none;">
                    <a href='' onclick="this.href='<?php echo $_SERVER['REQUEST_URI']?>&tourSize='+document.getElementById('tourSize').value"><button type="button" name="updateBook" class="btn btn-dark">Confirm</button></a><br><br>
                    <button type="button" class="btn btn-dark" onclick="closeInput()">Cancel</button>
                </div>
                <!-- end group 2 -->

                 <!-- third group of buttons (update) -->
                 <!-- <div id="buttonGroup3" style="display:none;">
                    <button type="button" name="update" class="btn btn-dark" onclick="showInput()">Rate Tour</button><br><br>
                </div> -->
                <!-- end group 1 -->
                
            </div>
            <!-- end button groups -->

        </div>
        <!-- end tour card -->

    </header>
</body>
</html>