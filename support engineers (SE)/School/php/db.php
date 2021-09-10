<?php

function Createdb(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "engineers";

    // create connection
    $conn = mysqli_connect($servername, $username, $password,$dbname);

    // Check Connection
    if (!$conn){
        die("Connection Failed : " . mysqli_connect_error());
    }

    // create Database
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

    if(mysqli_query($conn, $sql)){
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        $sql = "
                        CREATE TABLE IF NOT EXISTS task(
                            task_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			    School_id INT(11) NOT NULL,
   			    Company_id INT(11) NOT NULL,
                            task_desc VARCHAR (25) NOT NULL
                        );
        ";

        if(mysqli_query($conn, $sql)){
            return $conn;
        }else{
            echo "Cannot Create table...!";
        }

    }else{
        echo "Error while creating database ". mysqli_error($conn);
    }

}
