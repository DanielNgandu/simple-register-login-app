<?php
session_start(); //to ensure you are using same session
//destroy session
session_destroy();

//then return login page
header("location:login.php"); //to redirect back to "login.php" after logging out
exit();
