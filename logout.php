<?php

//Initialize current session
session_start();

//Unset and destroy session
session_unset();
session_destroy();

header("location:./index.php");

?>