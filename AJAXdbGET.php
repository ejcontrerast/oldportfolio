<?php
$servername = "69.172.204.200";
$username = "ejcontrerast_ejcontrerast";
$password = "zyIFFTr6YQ";
$dbname = "ejcontrerast_myDB";

//session_start();
//include 'login-info.php';

$mysqli = mysqli_connect($address, $username, $password, $dbname);

if(mysqli_connect_errno()) {
    printf("Database connection failed: %s\n", mysqli_connect_error());
    exit();
}
else {
    // filter variables before entering into database to prevent SQL injection
    $email = filter_input(INPUT_GET,'emailGet');

    // create database insert query and insert it into database
    $retrieve = "SELECT * FROM AjaxDemo WHERE Email='$email';";
    $retrieveResult = mysqli_query($mysqli, $retrieve) or die(mysqli_error($mysqli));

    // define a response for AJAX
    $response = "The entered email is empty or is not in the database!";
    while($row = mysqli_fetch_array($retrieveResult)) {
        if ($row['Email']!=""){
            $response = "The entered email ". $row['Email'] ." was retrieved from the database.";
        }
    }
    echo $response;
}
$conn->close();
?>