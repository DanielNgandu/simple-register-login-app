<?php

//include the connection file here
// As the name suggests, the file will be included just once.
require_once 'connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
//declare variables
    $email = "";
    $password = "";

//throw our users input to a function that will clean the input then reassign it back
    $username = sanitize_input($_POST["username"]);
    $password = sanitize_input($_POST["password"]);
    // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
    if ($stmt = $conn->prepare("SELECT id,username,password FROM users WHERE username =:username")) {
        // Bind parameters
        $stmt->bindParam(":username", $username, PDO::PARAM_STR); // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            //when we find it, then we get that password and then compare with the one inputed
            if ($stmt->rowCount() == 1) {
                //check if passwords match then login user
                while ($row = $stmt->fetch()) {
                    //setting the userId session
                    $_SESSION["userId"] = $row['id'];
                    $db_password = $row['password'];
                }
                //check if passwords match,basically compare the inputed password vs the one on  the db
                if ($db_password == $password) {
                    echo "login successful!";

                    header("location:index.php");
                } else {
                    echo "Passwords do not match. Please try again!";
                }

                //then show index page
            } else {
//                echo "Oops! Something went wrong. Please try again later.";
            } // Store the result so we can check if the account exists in the database.
        } else {
            echo "Login error";
        }

    }

} else {
    echo "Form not submitted correctly.";
}

function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h2>User Login Form</h2>
        </div>
    </div>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="username" placeholder="Enter email" name="username">
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
        </div>
        <div class="form-group form-check">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="remember"> Remember me
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>

</body>
</html>
