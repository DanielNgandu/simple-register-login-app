<?php
//start user session if it is set
session_start();
//includ the connection file here
// As the name suggests, the file will be included just once.
include_once 'connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
//declare variables
    $email = "";
    $password = "";

//throw our users input to a function that will clean the input then reassign it back
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);
// echo $email;
    // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
    if ($stmt = $conn->prepare('SELECT id,username,password FROM users WHERE username =:username')) {
        // Bind parameters
        $stmt->bindParam(":username", $username, PDO::PARAM_STR); // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            if ($stmt->rowCount() == 1) {
                //check if passwords match then login user
                while ($row = $stmt->fetch()) {
                    $_SESSION["userId"] = $row['id'];
                    $db_password = $row['password'];
                }
                //check if passwords match
                if ($db_password == $password) {
                    echo "login successful!";

                    header("location:index.php");
                } else {
                    echo "Passwords do not match. Please try again!";
                }

                //then show index page
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            } // Store the result so we can check if the account exists in the database.
        } else {
            echo "Login error";
        }

    }

} else {
    echo "Form not submitted correctly.";
}

function test_input($data)
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
  <h2>User Login Form</h2>
  <form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
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
