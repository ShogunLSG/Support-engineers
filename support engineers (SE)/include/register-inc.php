<?php

require_once("dbConnect.php");
require_once("global functions.php");

if (isset($_POST['company_register'])) {

    if (isset($_POST['company_name']) && isset($_POST['company_username']) && isset($_POST['company_location']) && isset($_POST['cpassword']) && isset($_POST['cconfirmPassword'])) {
    
        $username = $_POST['company_username'];

        if (isInDB("school", "School_UserName", "School_UserName=\"$username\"") == 1) {

            header("Location: ../register.php?error=username already taken");
            exit();
        }

        if ($_POST['cpassword'] != $_POST['cpassword']) {

            header("Location: ../register.php?error=passwords do not match");
            exit();
        }

        addCompany($_POST['company_username'], $_POST['company_name'], $_POST['company_location'], $_POST['cpassword']);
        header("Location: ../register.php?success=account created succesfully");
        exit();
    
    } else {

        header("Location: ../register.php?error=missing details");
        exit();
    }
}

if (isset($_POST['school_register'])) {


    if (isset($_POST['school_name']) && isset($_POST['school_username']) && isset($_POST['school_location']) && isset($_POST['spassword']) && isset($_POST['sconfirmPassword'])) {

        $username = $_POST['school_username'];

        if (isInDB("school", "School_UserName", "School_UserName=\"$username\"") == 1) {

            header("Location: ../register.php?error=username already taken");
            exit();
        }

        if ($_POST['spassword'] != $_POST['spassword']) {

            header("Location: ../register.php?error=passwords do not match");
            exit();
        }

        addSchool($_POST['school_username'], $_POST['school_name'], $_POST['school_location'], $_POST['spassword']);
        header("Location: ../register.php?success=account created succesfully");
        exit();

    } else {

        header("Location: ../register.php?error=missing details");
        exit();
    }
}

if (isset($_POST['employee_register'])) {

    if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['username']) && isset($_POST['epassword']) && isset($_POST['econfirmPassword'])) {

        $username = $_POST['username'];

        if (isInDB("employee", "Emp_UserName", "Emp_UserName=\"$username\"") == 1) {

            header("Location: ../register.php?error=username already taken");
            exit();
        }

        if ($_POST['epassword'] != $_POST['epassword']) {

            header("Location: ../register.php?error=passwords do not match");
            exit();
        }

        addEmployee($_POST['companyId'], $_POST['username'], $_POST['firstname'], $_POST['lastname'], $_POST['epassword']);
        header("Location: ../register.php?success=account created succesfully");
        exit();

    } else {

        header("Location: ../register.php?error=missing details");
        exit();
    }
}
