<?php

#session_start();
require_once ("../../Employee/php/component.php");
require_once ("../../Employee/php/db.php");
require_once ("../../Employee/php/operation.php");


$debug = false;

 
$start = "TUT SOSHANGUVE";
$end =$_SESSION['school_name']; 


/*

if (isset($_GET['start']) && isset($_GET['end'])) {
    $start = $_GET['start'];
    $end = $_GET['end'];
} else {

    $start = $_POST['start'];
    $end = $_POST['end'];
}

*/


$key = "AIzaSyB6orQbWGCAQ7qD5PSorHJR4Pg8yx4gnB8";
$url = "https://maps.googleapis.com/maps/api/directions/json?origin=" . urlencode($start) . "&destination=" . urlencode($end) . "&key=AIzaSyB6orQbWGCAQ7qD5PSorHJR4Pg8yx4gnB8";
$jsonfile = file_get_contents($url);
$jsondata = json_decode($jsonfile);

$startAddrStatus = $jsondata->geocoded_waypoints[0]->geocoder_status;
$endAddrStatus = $jsondata->geocoded_waypoints[1]->geocoder_status;

$status = $jsondata->status;

if ($startAddrStatus == 'ZERO_RESULTS' || $endAddrStatus == 'ZERO_RESULTS' || empty($start) || empty($end) || $status == 'ZERO_RESULTS' ) {

    if ($debug == true) {
    print("json url: $url</br>");

    print("no results<br>");
    
    exit();
    }

    if ($startAddrStatus == 'ZERO_RESULTS') {

        $_SESSION['startAddrErr'] = "starting location not found";

        if ($debug == true) {
            print("starting location not found");
        }
    } else {

        $_SESSION['startAddrErr'] = "";
    }

    if ($endAddrStatus == 'ZERO_RESULTS') {

        $_SESSION['endAddrErr'] = "end destination not found";

        if ($debug == true) {
            print("end destination not found");
        }
    } else {

        $_SESSION['endAddrErr'] = "";
    }


    if ($debug == false) {
        header("Location: directions error.php");
        exit();
    }

}



$startAddr = $jsondata->routes[0]->legs[0]->start_address;
$startAddrID = $jsondata->geocoded_waypoints[0]->place_id;

$endAddr = $jsondata->routes[0]->legs[0]->end_address;
$endAddrID = $jsondata->geocoded_waypoints[1]->place_id;

$distance = $jsondata->routes[0]->legs[0]->distance->text;

$start = strtoupper($start);
$end = strtoupper($end);

$metres = $jsondata->routes[0]->legs[0]->distance->value / 1000;
$rate = 3.98;
$cost = round($metres * $rate, 2);

if ($debug == true) {

    print("json url: $url</br></br>");

    print("start address: $start</br>");
    print("start address detailed: $startAddr</br>");
    print("start address ID: $startAddrID</br></br>");

    print("end address: $end</br>");
    print("end address detailed: $endAddr</br>");
    print("end address ID: $endAddrID</br></br>");

    print("distance: $distance</br>");
}

?>

<html>

<head>

    <link rel="stylesheet" type="text/css" href="css/style 1.css" />

    <title>directions</title>

</head>

<body>

    <center>
        <h1 class="header">Travel Cost</h1>
        </br>
        </br>

        </br>

        <div style="display:inline-block;margin:auto;margin-right:10;margin-bottom:10;vertical-align:top;width:600;height:200;border:2px solid teal;border-radius:5px">
            <h3 style="color:teal;">Starting Location</h3>
            <p><?php print($start); ?></p>
            <p style="color:teal;"><?php print($startAddr); ?></p>
        </div>

        <div style="display:inline-block;margin:auto;margin-left:10;margin-bottom:10;vertical-align:top;width:600;height:200;border:2px solid teal;border-radius:5px">
            <h3 style="color:teal;">End Destination</h3>
            <p><?php print($end); ?></p>
            <p style="color:teal;"><?php print($endAddr); ?></p>
        </div>

        <h1 style="color:teal;">Distance: <?php print($distance); ?></h1>
        <h2 style="color:teal;">Cost: R<?php print($cost); ?></h2>

        <p style="color:teal;">rate per Km: R3.98</p>

        </br>

        <iframe width="800" height="600" style="border:0" loading="lazy" allowfullscreen <?php print("src='https://www.google.com/maps/embed/v1/directions?origin=place_id:$startAddrID&destination=place_id:$endAddrID&key=AIzaSyDGehurawfySP9iFQyiF6MkO4_92R9HMgE'") ?> src="https://www.google.com/maps/embed/v1/directions?origin=place_id:ChIJq74B9IKZlR4RQKezgbKIdL0&destination=place_id:ChIJVVVVVRFilR4RmLT4jzUI5ig&key=AIzaSyDGehurawfySP9iFQyiF6MkO4_92R9HMgE"></iframe>

        <br>

        <a href="../../Employee/index.php">
            <!--  -->
            <button type="button" style="margin-top: 50;">Back</button>
        </a>

        </br>
        </br>
        </br>
        </br>
        </br>

    </center>

</body>

</html>