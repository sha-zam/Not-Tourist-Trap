<?php //Form process

//Controller class
include '../Controller/GuideController.php';

//Nav Bars
include '../constants/loggedNavBar.php';
include '../constants/generalNavBar.php';

//Start session
if(!isset($_SESSION))
    session_start();

// $loggedNavBar = file_get_contents('../constants/loggedNavBar.php');

if (isset($_POST['submit']))
{
    // $loggedNavBar = file_get_contents('../constants/loggedNavBar.php');

    $name1 = $_POST['tourName'];
    $name = addslashes($name1);
    $country = $_POST["country"];
    $state = ucwords($_POST["state"]);
    $state = addslashes($state);
    $textDescription = addslashes($_POST["tourDescription"]);
    
    $tourStartDate = $_POST["startDate"];
    $tourEndDate = $_POST["endDate"];
    $tourPrice = $_POST["tourPrice"];
    $tourSize = $_POST["tourSize"];

    //Array for uploaded images
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

    //checking
    // echo "<script type='text/javascript'>alert('$name, $country, $state, $textDescription, $tourStartDate, $tourEndDate,$tourPrice')</script>";
    // echo "<script type='text/javascript'>alert('$x')</script>";

    //move uploaded images
    for($i = 0; $i < count($tourImg); $i++)
    {
        move_uploaded_file($_FILES['tourImg']['tmp_name'][$i], $target[$i]);
    }

    //Pass to Controller
    $check = GuideController::validateTourForm($name, $country, $state, $textDescription, $tourImg, $tourPrice, $tourStartDate, $tourEndDate, $tourSize);

    if(is_bool($check) && ($check))
    {
        header("Location:../host.php?tourName=".$name1);
    }
    
    //$check = $guideCtr->validateData();
}

//End Form Process
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Host a Tour</title>
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
    
    <!-- <script>
        $( function() 
        {
            $( "#datepicker1, #datepicker2" ).datepicker();
        });
    </script> -->

    <script>
        $("input[type='number']").inputSpinner();
    </script>

    <link rel="stylesheet" type="text/css" href="../GeneralStyles.css"/>

    <style>

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

        <!-- Fail Alert -->
        <?php if(isset($check)) : ?> 

            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Failed to Create Tour</h4>
                <hr>

                <?php if ($check == 'date') :  ?>
                    
                    <p>Invalid Tour Dates Provided! Please Enter the Correct Informations</p>
                
                <?php elseif ($check == 'price') : ?>

                    <p>Invalid Tour Price Provided! Please Enter the Correct Informations</p>
                
                <?php elseif ($check == 'size') : ?>

                    <p>Invalid Tour Size Provided! Please Enter the Correct Informations</p>
                
                <?php else : ?>
                    
                    <p>Please Complete the Form Before Submitting!</p>

                <?php endif;?>
            
            </div>

        <?php endif;?>
        <!-- End Alert -->
        
        <!--Tour Guide Form-->
        <div class="accordion" id="accordionForm">
            
            <form action="createTour.php" method="POST" name="tourForm" enctype="multipart/form-data">
                
                <!--Tour Name-->
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h1 style="margin : 20px;">Enter Tour Details</h1>
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Select Tour Name
                            </button>
                        </h2>
                    </div>
                    
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionForm">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputTourName">Select Tour Name</label>
                                <input name="tourName" type="text" class="form-control" id="inputTourName" placeholder="e.g. Experience the local cuisine of Paris, France!" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Country and State-->
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                Select Country and State 
                            </button>
                        </h2>
                    </div>
                    
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionForm">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputCountry">Country</label>
                                <select name="country" class="custom-select" id="inputCountry" required></select>

                                <script>
                                    $("#inputCountry").load("../constants/countries.html");
                                </script>

                            </div>

                            <div class="form-group">
                                <label for="inputState">State</label>
                                <input name="state" type="text" class="form-control" id="inputState" placeholder="Select State" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Tour Description-->
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Tour Description
                            </button>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionForm">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="tourDesc">Describe your Tour for the Tourists to See</label>
                                <textarea class="form-control" id="tourDesc" rows="5" name="tourDescription"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tour Image -->
                <div class="card">
                    <div class="card-header" id="headingFour">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Upload Tour Image
                            </button>
                        </h2>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionForm">
                        <div class="card-body">
                            <label>Upload Images of Your Tour Destination for the Tourists</label><br>
                            
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="tourImg" name="tourImg[]" aria-describedby="inputGroupFileAddon01"  multiple accept=".jpg, .png, .jpeg"/>
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
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Tour Dates -->
                <div class="card">
                    <div class="card-header" id="headingFive">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                Set Tour Date 
                            </button>
                        </h2>
                    </div>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionForm">
                        <div class="card-body">
                            <label>Set Your Tour Start Date</label><br>
                            
                            <div class="col-sm-6">
                                <div class="input-group date" data-provide="datepicker">
                                    <input type="date" name="startDate" class="form-control" id="datepicker1">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>
                            </div>

                            <label>Set Your Tour End Date</label><br>
                            
                            <div class="col-sm-6">
                                <div class="input-group date" data-provide="datepicker">
                                    <input type="date" name="endDate" class="form-control" id="datepicker2">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                
                <!-- Tour Price -->
                <div class="card">
                    <div class="card-header" id="headingSix">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                Set Tour Price
                            </button>
                        </h2>
                    </div>
                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionForm">
                        <div class="card-body">
                            <label>Set Price for your Tour</label><br>
                            
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="text" name="tourPrice" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Group Size -->
                <div class="card">
                    <div class="card-header" id="headingSeven">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                Tour Group Size
                            </button>
                        </h2>
                    </div>
                    <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionForm">
                        <div class="card-body">
                            <label>Set Maximum Size of Tour Group</label><br>
                            
                            <div class="input-group mb-3">
                                <input type="number" name="tourSize" class="form-control" value="1" min="1" max="50" step="1"/>
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
