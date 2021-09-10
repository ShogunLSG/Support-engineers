<?php

session_start();
require("../../include/dbConnect.php");
require("../../include/global functions.php");

if (isset($_POST['update_password'])) {

    if (verEP("company", "company_username", $_SESSION['company_username'], "company_password", $_POST['old_password']) == true) {

        print("old password is good");

        $hashedPassword = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
        update("company", "company_password", $hashedPassword, "`company_id`=$_SESSION[company_ID]", "s");

        Header("Location: ../profile.php?password_msg=password changed successfully");
        exit();
    } else {

        Header("Location: ../profile.php?password_msg=incorrect password");
        exit();
    }
}
