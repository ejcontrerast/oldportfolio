<?php
if (!filter_input(INPUT_POST, 'choice')) {
?>
<html>

<body>
    <form action="" method="POST">
        <select name="choice">
            <option value='2022'>2022</option>
            <option value='2021'>2021</option>
            <option value='2020'>2020</option>
        </select>
        <br /><br />
        <input type="submit" value="Submit">
    </form>
</body>

</html>
<?php
} elseif (filter_input(INPUT_POST, 'choice')) {

    /* Open connection to "testDB" MySQL database. */
    $mysqli = mysqli_connect('69.172.204.200', 'ejcontrerast_ejcontrerast', 'zyIFFTr6YQ', 'ejcontrerast_myDB');

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
        #salesChart {
            height: 80%;
            width: 80%;
        }
    </style>
</head>

<body>
    <div id='salesChart'></div>
    <script>

        var myConfig = {
            "type": "pie",
            "legend": {},
            "title": {
                "text": " <?php echo 'Quarterly Sales For The Year: ' . $_POST['choice']; ?>"
            },
            "series": [
                        <?php
    while($info = mysqli_fetch_array($data))  {
echo " { \"values\": [$info[$q1]], \"legend- text\": \"Q1\"
            }," .
            " { \"values\": [$info[$q2]], \"legend- text\": \"Q2\"}," .
            "{ \"values\": [$info[$q3]], \"legend - text\": \"Q3\"}," .
            "{ \"values\": [$info[$q4]], \"legend - text\": \"Q4\"}";
    }
                        ?>
                    ]
                }

        zingchart.render({
            id: 'salesChart',
            data: myConfig,
            height: "80%",
            width: "80%"
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>

</html>
<?php } ?>