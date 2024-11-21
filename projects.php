<?php
$mysqlDB = mysqli_connect('69.172.204.200', 'ejcontrerast_ejcontrerast', 'zyIFFTr6YQ', 'ejcontrerast_myDB');

if ($mysqlDB->connect_error) {
	die("Connection failed: " . $mysqlDB->connect_error);
}

// database insert SQL code
$sql = "SELECT * FROM sales";

// insert in database 
$result = $mysqlDB->query($sql);
$resultstr = "<pre><table class='table table-dark table-hover text-info'>";
$resultstr .= "<thead><tr><th>Year</th><th>Q1</th><th>Q2</th><th>Q3</th><th>Q4</th></thead></tr><tbody>";

if ($result->num_rows > 0) {
	// output data of each row
	while ($row = $result->fetch_assoc()) {
		$resultstr .= sprintf(
			"<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", $row["Year"], $row["Q1"],
			$row["Q2"], $row["Q3"], $row["Q4"]
		);
	}
	$resultstr .= "</tbody><table></pre>";
} else {
	$resultstr = "0 results";
}
$mysqlDB->close();
?>
<!DOCTYPE html>
<html>

<head>
	<title>Ernesto's Projects</title>
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
				<li><a href="form_report.html">Form Report</a></li>
				<li><a href="ajax.html">AJAX</a></li>
				<li><a href="resume.html">Resume</a></li>
				<li><a href="linkedin.html">LinkedIn</a></li>
				<li><a href="wordpress.html">WordPress</a></li>
				<li><a href="jquery.html">JQuery</a></li>
				<li class="active"><a href="projects.php">Other Projects</a></li>
			</ul>
		</div>
		<div class="contentproject" >
			<h1><span >Charts PHP/JS</span></h1>
			<?php
                echo $resultstr
                	?>
			<p>Select an option and click the button to see the table in a chart!</p>
			<form action="" method="POST" id="tform">
				<select class="form-select text-info bg-dark" name="choice">
					<option value='2022'>2022</option>
					<option value='2021'>2021</option>
					<option value='2020'>2020</option>
				</select>
				<br /><br />
				<input class="btn" value="BarChart" type="button" onclick="submitForm('SalesBarChart.php')">
				<input class="btn" value="PieImage" type="button" onclick="submitForm('salespie.php')">
				<input class="btn" value="PieChart" type="button" onclick="submitForm('SalesPieChart.php')">
			</form>
			
		</div>
	</header>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		function submitForm(action) {
			var form = document.getElementById('tform');
			form.action = action;
			form.submit();
		}
	</script>
</body>

</html>