<?php


    $dbHost = "localhost";
    $dbUser = "root";
    $dbPass = "";
    $dbname = "engineers";

    // create connection
    $conn = mysqli_connect($dbHost, $dbUser, $dbPass,$dbname);

    // Check Connection
    if (!$conn){
        die("Connection Failed : ");
    }
  ?>