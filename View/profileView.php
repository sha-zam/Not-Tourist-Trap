<?php 
//Start session
include '../Controller/profileController.php';

//Nav Bars
include '../constants/loggedNavBar.php';
include '../constants/generalNavBar.php';

if(!isset($_SESSION))
    session_start();
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profile - Not Tourist Trap</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <style>
        html
        {
            scroll-behavior: smooth;
        }
        
        body{
            background-color: #080808;
        }
        
        .jumbotron 
        {
            background-image : url("../Images/hk_night.jpg");
            background-size : cover;
            background-position : center center; 
            height : 100vh;
            margin-bottom:0;
        }

        .navbar
        {
            position : fixed;
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
            <!--end navigation bar-->
            
        </nav>
        <?php 
            $method = $_SERVER["REQUEST_METHOD"];
            if($method === "GET")
            {
                $id = $_GET['user'];
                createProfile($id);
            }
        ?>        
    </header>
</body>
</html>

<?php
function connectDatabase()
{
    $conn = new mysqli("localhost", "root", "", "csit314");
    
    if (mysqli_connect_errno())
    {
        $problem = mysqli_connect_error();
        badinput ($problem);
        exit;
    }
    return $conn;
}

function createProfile($id)
{
    //Pass to Controller
    $profile = new profileController("$id");
    $check = $profile->validateUser();
    
    if($check)
    {
        $ufName = ucfirst($check->getfName());
        $ulName = ucfirst($check->getlName());
        $uEmail = $check->getEmail();
        $uLang = $check->getLang();
        $tourReview = $check->getTourReview();
        
        echo <<<PARTICULARS
        <div class="card border-info mb-3" style="width:40rem; margin : 0 auto;">
                <div class="card-body">
                    <h1 style="margin-top : 10px;">Hi, I'm $ufName $ulName</h1>
                    <div>
                        <label for="email">Contact me at: </label>
                        <a href = "mailto: $uEmail">$uEmail</a>
                     </div>
PARTICULARS;
                    if(sizeOf($uLang) > 0)
                    {
                        echo<<<LANGUAGES
                        <div class = "card">
                            <div class = "card-header">
                            Languages I Speak
                            </div>
                            <ul class="list-group list-group-flush">
LANGUAGES;
                            for($i = 0; $i < sizeOf($uLang); $i++)
                            {
                                echo "<li class='list-group-item'>".$uLang[$i]."</li>";
                            }
                      echo "</ul></div>";
                    }
                echo "</div>";
        echo "</div>";
        echo "<br>";
        
        if(!is_bool($tourReview))
        {
            $noReview = sizeOf($tourReview);
            if($noReview > 0)
            {
                echo "<div class = 'card border-info mb-3' style='width:40rem; margin : 0 auto;'>";
                        echo"<div class='card-header'>";
                        if ($noReview == 1) {
                            echo "$noReview Review";
                        }else
                            echo "$noReview Reviews";
                echo "</div>";
                
                for($i = 0; $i < $noReview; $i++)
                {
                    $comment = $tourReview[$i]->getComment();
                    $rating = $tourReview[$i]->getRating();
                    $tourName = $tourReview[$i]->getTourName();
                    $reviewerName = $tourReview[$i]->getReviewerName();
                    $reviewerID = $tourReview[$i]->getReviewerID();
                    
                    echo "<div class='card-body'>";
                        echo "<h5 class='card-title'>$tourName</h5>";
                        echo "<p class='card-text'>\"$comment\"</p>";
                        
                        echo "<p class='card-text'>Rating: ";
                        echo str_repeat("⭐",$rating);
                        echo "</p>";
                        
                        echo "<div class='card-footer bg-transparent border-success'>"
                            . "<a href ='profileView.php?user=$reviewerID'>$reviewerName</a></div>";
                        echo "</div>";
                }
            }
        }
        
    }
    else    //user not found
    {
        echo <<<NOSUCHUSER
        <div class="card" style="top:50%; width:40rem; margin: 0 auto;">
                <div class="card-body">
                     <h1 style="margin-top : 10px; text-align:center">USER NOT FOUND</h1>
                </div>
        </div>
NOSUCHUSER;
    }   
}

?>
