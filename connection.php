<!--//PHP 5 and later can work with a MySQL database using:
//
//MySQLi extension (the "i" stands for improved)
//PDO (PHP Data Objects)
//Should I Use MySQLi or PDO?
//Both MySQLi and PDO have their advantages:
//
//PDO will work on 12 different database systems, whereas MySQLi will only work with MySQL databases.

//So, if you have to switch your project to use another database, PDO makes the process easy.
// You only have to change the connection string and a few queries.
// With MySQLi, you will need to rewrite the entire code - queries included.

//Tip: A great benefit of PDO is that it has an exception class to handle any problems that may occur in our database queries.
// If an exception is thrown within the try{ } block,
// the script stops executing and flows directly to the first catch(){ } block.



-->
<?php
//step 1: declare your lgoin credentials
$servername = "localhost";
$username = "root";
$password = "";


//try to connect to db
try {
    $conn = new PDO("mysql:host=$servername;dbname=ucs_user_system", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
}
//catch exceptions if any and dump message
catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


