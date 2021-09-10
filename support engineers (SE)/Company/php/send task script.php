<?php

session_start();

require_once("functions.php");

if (isset($_POST['taskId']) && isset($_POST['employee']) && isset($_POST['amount'])) {


    if ($_POST['employee'] != -1) {

        assignTask($_SESSION['company_ID'],$_POST['taskId'], $_POST['employee'], $_POST['amount']);

        // print("assigned");
        //exit();
    } else {

        unassignTask($_POST['taskId']);
    }
}


header("Location: ../send task.php");
