<?php 

include '../Controller/destController.php';
include '../Controller/tourController.php';

//Nav Bars
include '../constants/loggedNavBar.php';
include '../constants/generalNavBar.php';

if(!isset($_SESSION))
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Search Results - Not Tourist Trap</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../GeneralStyles.css"/>
    <style>
        html
        {
            scroll-behavior: smooth;
        }
        
        .jumbotron 
        {
            background-image : url("../Images/bridge_night.jpg");
            background-size : cover;
            background-position : center center; 
            height : 100%;
            margin-bottom:0;
        }

        .navbar
        {
            position : fixed;
        }
        
        .container-fluid
        {
            overflow-x: auto;
        }
       
        .card-img-top 
        {
            max-width: 100%;
            max-height : 100%;
            object-fit: cover;
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

        <?php 
            $method = $_SERVER["REQUEST_METHOD"];
            if($method === "GET")
            {
                $search_entry = $_GET['search_country'];
                search($search_entry);
            }
        ?>        
    </header>
</body>
</html>

<?php
function search($searchEntry)
{
    $tours = destController::searchCountry($searchEntry);
    
    if(!$tours)
    {
        echo <<<NORESULTSFOUND
        <div class="card" style="top:30%; width:40rem; margin: 0 auto;">
                <div class="card-body">
                     <h1 style="margin-top : 10px; text-align:center">No search results found for '$searchEntry'</h1>
                </div>
        </div>
        <div class="card" style="top:30%; width:40rem; margin : 0 auto;">
            <div class="card-body">
                <h1 style="margin-top : 10px;">Where to next?</h1>
                <form id="search_form" action="searchView.php" method="GET" enctype="multipart/form-data">
                    <div class="input-group mb-3">
                        <input type="text" name="search_country" class="form-control" placeholder="Search for tours by country" aria-describedby="button-addon2">
                        <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
NORESULTSFOUND;
    }
    else
    {
        ?>
        <h2 style="margin:20px; color:white;">Search results for '<?php echo $searchEntry?>': </h2>
        <div class="container-fluid">
            <div class="row flex-row flex-nowrap">
        <?php
        //echo "<div class='row' style='top:50%'>";
        foreach($tours as $data)
        {
            $tourName = $data['Name'];
            
            $tourImages = array();
            $tourImages = tourController::fetchTourImages($data['TourID']);
            $src = "../Uploaded_Images/".$tourImages[0]; //get first image of tour images
            
            $guideDetails = array();
            $guideDetails = tourController::fetchTourGuideDetails($data['TourGuideID']);
            
            $country = destController::fetchCountryDetails($data['CountryID']);
            $state = destController::fetchStateDetails($data['StateID']);
?>          
            <div class="col-3">
                <div class="card card-block text-center">
                    <img class="card-img-top" src="<?php echo $src?>" style="width:500px; height:400px">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $tourName ?></h4>
                        <h5 class="card-title"><?php echo $state[0]['Name'].', '.$country[0]['Name'] ?></h5>
                        <p class="card-text">By: <?php echo $guideDetails[1].' '.$guideDetails[2]?></p>
                        <a href="./tourView.php?state=<?php echo $state[0]['Name']?>&country=<?php echo $country[0]['Name']?>&tourID=<?php echo $data['TourID']?>&tourName=<?php echo $data['Name']?>&tourGuideID=<?php echo $data['TourGuideID']?>&tourGuide=<?php echo $guideDetails[1].' '. $guideDetails[2] ?>">
                            <button type="button" class="btn btn-primary">Click Here for More Details</button>
                        </a>
                    </div>
                </div>
            </div>
 <?php
        }
        echo "</div></div>";
    }
}

?>
