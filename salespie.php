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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
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

    /* Fetch result set from Sales table */
    $data = mysqli_query($mysqli, "SELECT * FROM sales WHERE year = $choice;");
    while ($info = mysqli_fetch_array($data)) {
        $q1 = $info['Q1'];
        $q2 = $info['Q2'];
        $q3 = $info['Q3'];
        $q4 = $info['Q4'];
    }
    $total = $q1 + $q2 + $q3 + $q4;

    $q1Percentage = round(($q1 * 100) / $total, 1);
    $q2Percentage = round(($q2 * 100) / $total, 1);
    $q3Percentage = round(($q3 * 100) / $total, 1);
    $q4Percentage = round(($q4 * 100) / $total, 1);

    $q1ToChart = ($q1Percentage * 360) / 100;
    $q2ToChart = ($q2Percentage * 360) / 100;
    $q3ToChart = ($q3Percentage * 360) / 100;
    $q4ToChart = ($q4Percentage * 360) / 100;


    //create the canvas
    $myImage = ImageCreate(300, 300);
    $q1Square = ImageCreate(20, 20);
    $q2Square = ImageCreate(20, 20);
    $q3Square = ImageCreate(20, 20);
    $q4Square = ImageCreate(20, 20);

    //set up some colors
    $white = ImageColorAllocate($myImage, 255, 255, 255);
    $black = ImageColorAllocate($myImage, 0, 0, 0);
    $red = ImageColorAllocate($myImage, 255, 0, 0);
    $green = ImageColorAllocate($myImage, 0, 255, 0);
    $blue = ImageColorAllocate($myImage, 0, 0, 255);
    $header = 'Quarterly Sales For The Year: ' . $_POST['choice'];
    imagestring($myImage, 3, 30, 10, $header, $black);

    //draw a pie in clockwise direction; other styles: IMG_ARC_CHORD, IMG_ARC_NOFILL, IMG_ARC_EDGED
    ImageFilledArc($myImage, 150, 140, 200, 200, 0, $q1ToChart, $black, IMG_ARC_PIE);
    ImageFilledArc($myImage, 150, 140, 200, 200, $q1ToChart, $q2ToChart + $q1ToChart, $green, IMG_ARC_PIE);
    ImageFilledArc($myImage, 150, 140, 200, 200, $q2ToChart + $q1ToChart, $q2ToChart + $q1ToChart + $q3ToChart, $red, IMG_ARC_PIE);
    ImageFilledArc($myImage, 150, 140, 200, 200, $q2ToChart + $q1ToChart + $q3ToChart, $q2ToChart + $q1ToChart + $q3ToChart + $q4ToChart, $blue, IMG_ARC_PIE);

    $q1String = 'Q1 - ' . $q1Percentage . '%';
    imagestring($myImage, 1, 40, 248, $q1String, $black);
    ImageFilledRectangle($myImage, 30, 250, 35, 255, $black);
    $q2String = 'Q2 - ' . $q2Percentage . '%';
    imagestring($myImage, 1, 40, 258, $q2String, $black);
    ImageFilledRectangle($myImage, 30, 260, 35, 265, $green);
    $q3String = 'Q3 - ' . $q3Percentage . '%';
    imagestring($myImage, 1, 40, 268, $q3String, $black);
    ImageFilledRectangle($myImage, 30, 270, 35, 275, $red);
    $q4String = 'Q4 - ' . $q4Percentage . '%';
    imagestring($myImage, 1, 40, 278, $q4String, $black);
    ImageFilledRectangle($myImage, 30, 280, 35, 285, $blue);
    //imagefilledrectangle($image, $x1, $y1, $x2, $y2, $color);

    //output the image to the browser
    header("Content-type: image/png");
    ImagePNG($myImage);

    //ImagePNG($myImage);

    //clean up after yourself
    ImageDestroy($myImage);
}
    ?>