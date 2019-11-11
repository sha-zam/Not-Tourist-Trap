<?php

//controller includes
include '../Controller/tourController.php';
include '../Controller/GuideController.php';

//session check 
if(!isset($_SESSION))
    session_start();

//get tour ID
$tourID = $_GET['tourID'];

//fetch tour details and images
$tourImages = tourController::fetchTourImages($tourID);
$tourDetails = tourController::fetchTourDetails($tourID);

//update tour detail
if(isset($_POST['updateNameBtn']))
{
    //get tour ID
    $tourID = $_GET['tourID'];

    //get tour Name
    $tourName = $_POST['tourName'];

    //ask controller to update
    $check = GuideController::updateTour($tourID, $tourName, ' ', 'name');

    if ($check)
    {
        header("Location:./tourGuideView.php?alert=true");
    }

}
else if(isset($_POST['updateDescBtn']))
{
    //get tour ID
    $tourID = $_GET['tourID'];

    //get tour Name
    $tourDesc = $_POST['tourDescription'];

    //ask controller to update
    $check = GuideController::updateTour($tourID, $tourDesc, ' ', 'desc');

    if ($check)
    {
        header("Location:./tourGuideView.php?alert=true");
    }

}
else if(isset($_POST['updateImgBtn']))
{
    //get tour ID
    $tourID = $_GET['tourID'];

    $tourImg = array();
    $target = array();

    chdir('../');
    $x = getCwd();

    for($i = 0; $i < count($_FILES['tourImg']['tmp_name']); $i++)
    {
        //Purpose of time() is to avoid naming conflicts
        $tourImg[$i] = time() . '_' . $_FILES['tourImg']['name'][$i];
        $target[$i] = $x . '/Uploaded_Images/' . $tourImg[$i];
    }

    //move uploaded images
    for($i = 0; $i < count($tourImg); $i++)
    {
        move_uploaded_file($_FILES['tourImg']['tmp_name'][$i], $target[$i]);
    }

    //ask controller to update
    $check = GuideController::updateTour($tourID, $tourImg, ' ', 'img');

    if ($check)
    {
        header("Location:./tourGuideView.php?alert=true");
    }

}
else if(isset($_POST['updateDatesBtn']))
{
    //get tour ID
    $tourID = $_GET['tourID'];

    //get tour Dates
    $tourSD = $_POST['startDate'];
    $tourED = $_POST['endDate'];

    //ask controller to update
    $check = GuideController::updateTour($tourID, $tourSD, $tourED, 'dates');

    if ($check)
    {
        header("Location:./tourGuideView.php?alert=true");
    }

}
else if(isset($_POST['updatePriceBtn']))
{
    //get tour ID
    $tourID = $_GET['tourID'];

    //get Tour Price
    $tourPrice = $_POST['tourPrice'];

    //ask controller to update
    $check = GuideController::updateTour($tourID, $tourPrice, ' ', 'price');

    if ($check)
    {
        header("Location:./tourGuideView.php?alert=true");
    }
}
else if(isset($_POST['cancelSubmit']))
{
    //get tour ID
    $tourID = $_GET['tourID'];

    //ask controller to update
    $check = GuideController::cancelTour($tourID);

    if ($check)
    {
        header("Location:./tourGuideView.php?alert=true");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Tour</title>

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

    <script type="text/javascript">

        function showUpdateButtons() 
        {
            document.getElementById('buttonGroup2').style.display = "block";
            document.getElementById('buttonGroup1').style.display = "none";
        }

        function showUpdate(field)
        {
            document.getElementById('buttonGroup2').style.display = "none";

            if (field === 'name')
            {
                document.getElementById('updateName').style.display = "block";
            }
            else if (field === 'desc')
            {
                document.getElementById('updateDesc').style.display = "block";
            }
            else if (field === 'img')
            {
                document.getElementById('updateImages').style.display = "block";
            }
            else if (field === 'dates')
            {
                document.getElementById('updateDates').style.display = "block";
            }
            else
            {
                document.getElementById('updatePrice').style.display = "block";
            }
        }

        function closeInput()
        {

            document.getElementById('buttonGroup1').style.display = "block";
            document.getElementById('buttonGroup2').style.display = "none";

            document.getElementById('updateName').style.display = "none";
            document.getElementById('updateDesc').style.display = "none";

            document.getElementById('updateImages').style.display = "none";
            document.getElementById('updateDates').style.display = "none";
            document.getElementById('updatePrice').style.display = "none";
        }

    </script>

    <link rel="stylesheet" type="text/css" href="../GeneralStyles.css"/>

    <style>
        .jumbotron 
        {
            background-image : url("../Images/bali.jpg");
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

            <!--nav list-->
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
        <!--end navigation bar-->
        
        <!-- Alert -->
        <?php if(isset($check)) : ?> 

            <?php if(!$check) : ?>

                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Failed to Update Tour</h4>
                </div>

            <?php endif;?>

        <?php endif;?>
        <!-- End Alert -->
        
        <!-- Tour Card -->
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
            
            <!-- replaced with tour update details if user click -->
            <div id="tourHeader" class="card-body text-center">
                <h1 class="card-title"><?php echo $tourDetails[0]['Name']?></h1>
                <br><br>
                <p class="card-text"><?php echo $tourDetails[0]['Description'] ?></p>
            </div>

            <div id="touHeader" class="card-body">
                <h5 class="card-text">Dates : <?php echo date_format(date_create($tourDetails[0]['Start_date']), "d M Y") ?> - <?php echo date_format(date_create($tourDetails[0]['End_date']), "d M Y") ?></h5>
                <h5 class="card-text">Price : $<?php echo $tourDetails[0]['Price'] ?></h5>
                <h5 class="card-text">Max Tour Size : <?php echo $tourDetails[0]['Group_Size'] ?> people</h5>
            </div>
            <!-- end div -->
            
            <!-- name update -->
            <form action="updateTour.php?tourID=<?php echo $tourID?>" method="post">
                <div id="updateName" class="card-body" style="display:none;text-align:center;">
                    <div class="form-group">
                        <label for="inputTourName">Select Tour Name</label>
                        <input name="tourName" id ="updtTourName" type="text" class="form-control" id="inputTourName" placeholder="e.g. Experience the local cuisine of Paris, France!" required>
                        <br>
                        <button type="submit" name="updateNameBtn" class="btn btn-dark">Confirm</button><br><br>
                        <button type="button" class="btn btn-dark" onclick="closeInput()">Cancel</button>
                    </div>
                </div>
            </form>
            
            <!-- desc update -->
            <form action="updateTour.php?tourID=<?php echo $tourID?>" method="post">
                <div id="updateDesc" class="card-body" style="display:none;text-align:center;">
                    <div class="form-group">
                        <label for="tourDesc">Describe your Tour for the Tourists to See</label>
                        <textarea class="form-control" id="updtTourDesc" rows="5" name="tourDescription"></textarea>
                        <br>
                        <button type="submit" name="updateDescBtn" class="btn btn-dark">Confirm</button><br><br>
                        <button type="button" class="btn btn-dark" onclick="closeInput()">Cancel</button>
                    </div>
                </div>
            </form>
            
            <!-- Images update -->
            <form action="updateTour.php?tourID=<?php echo $tourID?>" method="post" enctype="multipart/form-data">
                <div id="updateImages" class="card-body" style="display:none;text-align:center;">
                    <label>Upload Images of Your Tour Destination for the Tourists</label><br>
                                
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="updtTourImg" name="tourImg[]" aria-describedby="inputGroupFileAddon01"  multiple accept=".jpg, .png, .jpeg"/>
                            <label class="custom-file-label" for="tourImg">Choose file</label>
                            
                            <script>
                                $('#tourImg').on('change',function(){
                                    //get the file name
                                    var files = $(this)[0].files;

                                    //display how many files were selected
                                    $(this).next('.custom-file-label').html(this.files.length + " file(s) selected");
                                })
                            </script>
                            
                        </div>
                        <br><br>
                        <button type="submit" name="updateImgBtn" class="btn btn-dark">Confirm</button><br><br>
                        <button type="button" class="btn btn-dark" onclick="closeInput()">Cancel</button>
                    </div>
                </div>
            </form>
            
            <!-- dates update -->
            <form action="updateTour.php?tourID=<?php echo $tourID?>" method="post">
                <div id="updateDates" class="card-body" style="display:none;text-align:center;">
                    <label>Set Your Tour Start Date</label><br>
                                
                    <div class="col-sm-6">
                        <div class="input-group date" data-provide="datepicker">
                            <input type="date" name="startDate" id="updtTourSD" class="form-control" id="datepicker1">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>

                    <label>Set Your Tour End Date</label><br>
                    
                    <div class="col-sm-6">
                        <div class="input-group date" data-provide="datepicker">
                            <input type="date" name="endDate" id="updtTourED" class="form-control" id="datepicker2">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>
                    <br>
                    <button type="submit" name="updateDatesBtn" class="btn btn-dark">Confirm</button><br><br>
                    <button type="button" class="btn btn-dark" onclick="closeInput()">Cancel</button>
                </div>
            </form>
            
            <!-- price update -->
            <form action="updateTour.php?tourID=<?php echo $tourID?>" method="post">
                <div id="updatePrice" class="card-body" style="display:none;text-align:center;">
                    <label>Set Price for your Tour</label><br>
                                
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text" name="tourPrice" id="updtTourPrice" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
                    </div>
                    <br>
                    <button type="submit" name="updatePriceBtn" class="btn btn-dark">Confirm</button></a><br><br>
                    <button type="button" class="btn btn-dark" onclick="closeInput()">Cancel</button>
                </div>
            </form>
            
            <!-- button groups -->
            <div class="card-body text-center">

                <!-- first group of buttons -->
                <div id="buttonGroup1">
                    <button type="button" name="update" class="btn btn-dark" onclick="showUpdateButtons()">Update Tour</button><br><br>
                    
                    <form action="updateTour.php?tourID=<?php echo $tourID?>" method="post" name="cancelForm">
                        <button type="submit" name="cancelSubmit" class="btn btn-dark" onclick="confirmCancel()">Cancel Tour</button>
                    </form>
                </div>
                <!-- end group 1 -->
                
                <!-- 2nd group of buttons (update buttons) -->
                <div id="buttonGroup2" style="display:none;">
                    <button type="button" name = "updateName" class="btn btn-dark" onclick="showUpdate('name')">Update Tour Name</button>
                    <button type="button" name = "updateDesc" class="btn btn-dark" onclick="showUpdate('desc')">Update Description</button>
                    <button type="button" name = "updateDesc" class="btn btn-dark" onclick="showUpdate('img')">Update Tour Images</button>
                    <button type="button" name = "updateDesc" class="btn btn-dark" onclick="showUpdate('dates')">Update Tour Dates</button>
                    <button type="button" name = "updateDesc" class="btn btn-dark" onclick="showUpdate('price')">Update Tour Price</button><br><br>
                    <button type="button" name = "cancel" class="btn btn-dark" onclick="closeInput()">Cancel</button>
                </div>
                <!-- end group 2 -->
                
                <!-- 3rd group of buttons -->
                <!-- <div id="buttonGroup3" style="display:none;">
                    <a href='' onclick="this.href='<?php echo $_SERVER['REQUEST_URI']?>&tourSize='+document.getElementById('tourSize').value"><button type="button" name="book" class="btn btn-dark">Confirm Cancellation</button></a><br><br>
                    <button type="button" class="btn btn-dark" onclick="closeInput()">Cancel</button>
                </div> -->
                <!-- end group 3 -->

            </div>
            <!-- end button groups -->

        </div>
        <!-- End Tour Card -->

    </header>

</body>
</html>