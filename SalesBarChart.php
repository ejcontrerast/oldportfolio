<?php
    if (!filter_input(INPUT_POST, 'choice')) {
?>
    <html><body>
	<form action="" method="POST">		
	    <select name="choice">
		<option value='2022'>2022</option>
		<option value='2021'>2021</option>
		<option value='2020'>2020</option>
	    </select>
	    <br /><br />
	    <input type="submit" value="Submit">
	</form>
    </body></html>
<?php    
    } elseif(filter_input(INPUT_POST, 'choice')) {
      $mysqli = mysqli_connect('69.172.204.200', 'ejcontrerast_ejcontrerast', 'zyIFFTr6YQ','ejcontrerast_myDB');

    /* Check the connection. */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    $choice = filter_input(INPUT_POST, 'choice');
    $country = "sales";
    $q1 = "Q1";
    $q2 = "Q2";
    $q3 = "Q3";
    $q4 = "Q4";
    /* Fetch result set from Sales table */
    $data = mysqli_query($mysqli, "SELECT * FROM sales WHERE year = $choice;");
    ?>  
  
<html>
<head>
  <script src="zingchart.min.js"></script>
 
  <style>
    html,
    body,
    #NAFTAChart {
      height: 90%;
      width: 90%;
    }
  </style>
</head>

<body>
  <div id='NAFTAChart'></div>
  <script>
    
    <?php 
        while($info=mysqli_fetch_array($data)){
            $mydata .=  $info[$q1].','; 
            $mydata .=  $info[$q2].',';
            $mydata .=  $info[$q3].',';
            $mydata .=  $info[$q4].',';
        }
    ?>
    
    var myConfig = {
        "graphset": [{
        "type": "bar",
        "title": {
          "text": " <?php echo 'Sales '.$_POST['choice'].' (in millions)'; ?>"
        },
        "scale-x": {
          "labels": ["Q1","Q2","Q3","Q4"]
        },
        "series": [
        {
            "values":[<?php echo $mydata; ?>]
        }]
    }]
    };

    zingchart.render({
      id: 'NAFTAChart',
      data: myConfig,
      height: "100%",
      width: "100%"
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>

</html>
    <?php } ?>
