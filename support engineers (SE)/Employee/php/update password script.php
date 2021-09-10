<?php

session_start();
require("../../include/dbConnect.php");
require("../../include/global functions.php");

if (isset($_POST['update_password'])) {

    if (verEP("employee", "emp_username", $_SESSION['employee_username'], "emp_password", $_POST['old_password']) == true) {

        print("old password is good");

        $hashedPassword = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
        update("employee", "emp_password", $hashedPassword, "`emp_id`=$_SESSION[employee_ID]", "s");

        Header("Location: ../profile.php?password_msg=password changed successfully");
        exit();
    } else {

        Header("Location: ../profile.php?password_msg=incorrect password");
        exit();
    }
}
