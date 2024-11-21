<!DOCTYPE html>
<html>
<style>
table, th, td {
  border:1px solid black;
}
</style>
<body>
<?php

    $mysqlDB = mysqli_connect('69.172.204.200', 'ejcontrerast_ejcontrerast', 'zyIFFTr6YQ','ejcontrerast_myDB');

    if ($mysqlDB->connect_error) {
        die("Connection failed: " . $mysqlDB->connect_error);
      }

    // get the post records
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    
    // database insert SQL code
    $sql = "INSERT INTO `DataReport` (`FirstName`, `LastName`, `Email`, `Telephone`) 
            VALUES ('$fname', '$lname', '$email', '$telephone')";
    
    // insert in database 
    $resoult = mysqli_query($mysqlDB, $sql);
    $resultstr = "<pre><table>";
    $resultstr .="<tr><th>FirstName</th><th>Lastname</th><th>E-mail</th><th>Telephone</th></tr>";
    if ($resoult) {
        $resultstr .=sprintf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>",$fname,$lname,$email,$telephone);
        $resultstr .= "<table></pre>";
        $resultstr .= "<h3>New record created successfully!<h3>";
      } else {
        $resultstr = "Error: " . $sql . "<br>" . $mysqlDB->error;
      }
      echo $resultstr;
      $mysqlDB->close();
?>
</body>
</html>