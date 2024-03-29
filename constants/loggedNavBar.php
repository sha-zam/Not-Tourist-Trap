<?php 
if(!isset($_SESSION))
    session_start();
 
function displayLoggedNavBar($uid)
{
    echo <<< NAVBAR
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="http://localhost/Not-Tourist-Trap/host.php" style="color : white">Host a Tour</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color : white">
                    View Tours
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="http://localhost/Not-Tourist-Trap/View/touristView.php">View Bookings as Tourist</a>
                    <a class="dropdown-item" href="http://localhost/Not-Tourist-Trap/View/tourGuideView.php">View Tours You Create</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://localhost/Not-Tourist-Trap/View/profileView.php?user=$uid" style="color : white">View Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://localhost/Not-Tourist-Trap/View/settings.php?" style="color : white">Account</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://localhost/Not-Tourist-Trap/logout.php" style="color : white">Log Out</a>
            </li>
        </ul>
    </div>
NAVBAR;
}
    
?>
