<?php

session_start();

require_once("dbConnect.php");
require_once("global functions.php");

if( isset($_POST['employee_login']) ){

    if( isLoginValid("employee", "emp_username",$_POST['employee_username'], "emp_password", $_POST['employee_password']) == 1){

        $username = $_POST['employee_username'];

        $_SESSION['employee_username']=$_POST['employee_username'];
        $_SESSION['employee_ID']=selectFromTable("employee","emp_id","emp_username='$username'");
        $_SESSION['employee_company_ID']=selectFromTable("employee","company_id","emp_username='$username'");
        $_SESSION['employee_firstname']=selectFromTable("employee","first_name","emp_userName='$username'");
        $_SESSION['employee_lastname']=selectFromTable("employee","surname","emp_username='$username'");
		
        header("Location: ../Employee");
        exit();


    }else{

        header("Location: ../login.php?error=incorrect email or password");
        exit();

    }

}

if( isset($_POST['school_login']) ){

    if( isLoginValid("school", "school_username",$_POST['school_username'], "password", $_POST['school_password']) == 1){

        $username = $_POST['school_username'];

        $_SESSION['school_username']=$_POST['school_username'];
        $_SESSION['school_ID']=selectFromTable("school","school_id","school_username='$username'");
        $_SESSION['school_name']=selectFromTable("school","school_name","school_username='$username'");
        $_SESSION['school_address']=selectFromTable("school","school_location","school_username='$username'");
        
        header("Location: ../School");
        exit();

    }else{

        header("Location: ../login.php?error=incorrect email or password");
        exit();

    }

}

if( isset($_POST['company_login']) ){

    if( isLoginValid("company", "Company_UserName",$_POST['company_username'], "Company_Password", $_POST['company_password']) == 1){

        $username = $_POST['company_username'];

        $_SESSION['company_username']=$_POST['company_username'];
        $_SESSION['company_ID']=selectFromTable("company","company_id","company_username='$username'");
        $_SESSION['company_name']=selectFromTable("company","company_name","Company_UserName='$username'");
        $_SESSION['company_address']=selectFromTable("company","company_address","company_username='$username'");

        header("Location: ../Company");
        exit();
        
    }else{

        header("Location: ../login.php?error=incorrect email or password");
        exit();

    }

}

