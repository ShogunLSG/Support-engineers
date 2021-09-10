<?php

session_start();
require("../../include/dbConnect.php");
require("../../include/global functions.php");

if( isset($_POST['update_details']) ){

    update("employee","emp_username",$_POST['employee_username'],"`emp_id`=$_SESSION[employee_ID]","s");
    update("employee","first_name",$_POST['employee_firstname'],"`emp_id`=$_SESSION[employee_ID]","s");
    update("employee","surname",$_POST['employee_lastname'],"`emp_id`=$_SESSION[employee_ID]","s");

    $_SESSION['employee_username'] = $_POST['employee_username'];
    $_SESSION['employee_firstname'] = $_POST['employee_firstname'];
    $_SESSION['employee_lastname'] = $_POST['employee_lastname'];
    
    Header("Location: ../profile.php?details_msg=details updated successfully");
    exit();

}

