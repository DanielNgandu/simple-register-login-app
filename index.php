<!-- our home page, will only appear when user is logged in -->

<?php
//start user session if it is set
session_start();
//includ the connection file here
// As the name suggests, the file will be included just once.
include_once 'connection.php';
// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if (isset($_SESSION["userId"])) {
    // Could not get the data that should have been sent.
    echo "Welcome!";
}else{
	exit('Please login to access this page.');
}





?>


