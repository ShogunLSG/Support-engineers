<?php

session_start();
require("../../include/dbConnect.php");
require("../../include/global functions.php");

if( isset($_POST['update_details']) ){

    update("school","school_username",$_POST['school_username'],"`school_id`=$_SESSION[school_ID]","s");
    update("school","school_name",$_POST['school_name'],"`school_id`=$_SESSION[school_ID]","s");
    update("school","school_location",$_POST['school_address'],"`school_id`=$_SESSION[school_ID]","s");

    $_SESSION['school_username'] = $_POST['school_username'];
    $_SESSION['school_name'] = $_POST['school_name'];
    $_SESSION['school_address'] = $_POST['school_address'];
    
    Header("Location: ../profile.php?details_msg=details updated successfully");
    exit();

}

