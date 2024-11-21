<!DOCTYPE html>
<html>

<head>
  <title>Ernesto's Form Report</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <header>
    <div class="main">
      <div class="logo">
        <a href="index.html"><img src="Logo.jpeg"></a>
      </div>
      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="form_validation.html">Form Validation</a></li>
        <li class="active"><a href="form_report.html">Form Report</a></li>
        <li><a href="ajax.html">AJAX</a></li>
        <li><a href="resume.html">Resume</a></li>
        <li><a href="linkedin.html">LinkedIn</a></li>
        <li><a href="wordpress.html">WordPress</a></li>
        <li><a href="jquery.html">JQuery</a></li>
        <li><a href="projects.php">Other Projects</a></li>
      </ul>
    </div>




    <?php
    $mysqlDB = mysqli_connect('69.172.204.200', 'ejcontrerast_ejcontrerast', 'zyIFFTr6YQ', 'ejcontrerast_myDB');

    if ($mysqlDB->connect_error) {
      die("Connection failed: " . $mysqlDB->connect_error);
    }

    // get the post records
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];

    // database insert SQL code
    $sql = "SELECT * FROM DataReport";

    // insert in database 
    $result = $mysqlDB->query($sql);
    $resultstr = "<pre><table class='table table-striped table-dark text-info table-hover'>";
    $resultstr .= "<thead><tr><th>FirstName</th><th>Lastname</th><th>E-mail</th><th>Telephone</th></thead></tr><tbody>";

    if ($result->num_rows > 0) {
      // output data of each row
      while ($row = $result->fetch_assoc()) {
        $resultstr .= sprintf(
          "<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", $row["FirstName"], $row["LastName"],
          $row["Email"], $row["Telephone"]
        );
      }
      $resultstr .= "</tbody><table></pre>";
    } else {
      $resultstr = "0 results";
    }


    $mysqlDB->close();
    ?>
    <div class="container">
      <div class="contentproject">
        <h1><span>Bootstrap e.g.<span></h1><br>
        <div class="row">
          <div class="col">
            <?php
            echo $resultstr;
            ?>
          </div>
        </div>
      </div>
    </div>
  </header>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>

</html>