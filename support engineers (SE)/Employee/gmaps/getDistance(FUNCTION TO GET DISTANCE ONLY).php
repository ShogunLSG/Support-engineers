<?php

function getDistance($startLoc, $endLoc)
{

    $distanceReturn = "invalid address";

    $debug = false;//set debugging to true or false

    $start = $startLoc;
    $end = $endLoc;

    $key = "AIzaSyB6orQbWGCAQ7qD5PSorHJR4Pg8yx4gnB8";
    $url = "https://maps.googleapis.com/maps/api/directions/json?origin=" . urlencode($start) . "&destination=" . urlencode($end) . "&key=AIzaSyB6orQbWGCAQ7qD5PSorHJR4Pg8yx4gnB8";
    $jsonfile = file_get_contents($url);
    $jsondata = json_decode($jsonfile);

    $startAddrStatus = $jsondata->geocoded_waypoints[0]->geocoder_status;
    $endAddrStatus = $jsondata->geocoded_waypoints[1]->geocoder_status;

    $status = $jsondata->status;

    if ($startAddrStatus == 'ZERO_RESULTS' || $endAddrStatus == 'ZERO_RESULTS' || empty($start) || empty($end) || $status == 'ZERO_RESULTS') {

        if ($debug == true) {

            print("one of the addresses is invalid<br>");
        }

    } else {

        $startAddr = $jsondata->routes[0]->legs[0]->start_address;
        $startAddrID = $jsondata->geocoded_waypoints[0]->place_id;

        $endAddr = $jsondata->routes[0]->legs[0]->end_address;
        $endAddrID = $jsondata->geocoded_waypoints[1]->place_id;

        $distance = $jsondata->routes[0]->legs[0]->distance->text;

        $start = strtoupper($start);
        $end = strtoupper($end);

        $kilometres = $jsondata->routes[0]->legs[0]->distance->value / 1000;
        $distanceReturn = $kilometres;
       // $rate = 3.98;
       // $cost = round($kilometres * $rate, 2);

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
    }


    return $distanceReturn;
}

print(getDistance("TUT soshanguve","TUT Acadia"));

//this is how we'll calculate travel cost
 $rate = 3.98;
 $cost = round(getDistance("address1","address2") * $rate, 2);

