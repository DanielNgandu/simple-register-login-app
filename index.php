<!-- our home page, will only appear when user is logged in -->

<?php

//include the connection file here
// As the name suggests, the file will be included just once.
include_once 'connection.php';
// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if (isset($_SESSION["userId"])) {
    // Could not get the data that should have been sent.
//    echo "Welcome!";
}else{
	echo('Please login to access this page.');
	//if user not logged in,throw them back to login page
    header("Location:login.php");
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
<div class="alert alert-success" role="alert">
    <h4 class="alert-heading">Welcome Home</h4>
    <p>Aww yeah, you successfully logged in!</p>
    <hr>
    <a href="logout.php" type="button" class="btn btn-danger btn-lg">Logout</a>
</div>
</div>
</body>
</html>

