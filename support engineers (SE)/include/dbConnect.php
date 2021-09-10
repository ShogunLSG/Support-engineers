<?php

function connect()
{
    $conn = mysqli_connect("localhost", "root", "", "engineers");

    if (!$conn) {

        print("could not connect to database");
    }

    return $conn;

}
