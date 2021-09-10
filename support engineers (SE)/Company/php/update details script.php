<?php

session_start();
require("../../include/dbConnect.php");
require("../../include/global functions.php");

if( isset($_POST['update_details']) ){

    update("company","company_username",$_POST['company_username'],"`company_id`=$_SESSION[company_ID]","s");
    update("company","company_name",$_POST['company_name'],"`company_id`=$_SESSION[company_ID]","s");
    update("company","company_address",$_POST['company_address'],"`company_id`=$_SESSION[company_ID]","s");

    $_SESSION['company_username'] = $_POST['company_username'];
    $_SESSION['company_name'] = $_POST['company_name'];
    $_SESSION['company_address'] = $_POST['company_address'];
    
    Header("Location: ../profile.php?details_msg=details updated successfully");
    exit();

}

