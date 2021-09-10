<?php

require_once 'db.php';
require_once 'component.php';

$conn = Createdb();

// create button click
if(isset($_POST['create'])){
    createData();
}

if(isset($_POST['update'])){
    UpdateData();
}

if(isset($_POST['delete'])){
    deleteRecord();
}


function createData(){
    
    $school_id = textboxValue("school_id");
    $task_desc = textboxValue("task_description");
    $company_id = 1;
    if($task_desc)
    {

        $sql = "INSERT INTO task(school_id,company_id, task_description) VALUES ('$school_id','$company_id','$task_desc');";

        if(mysqli_query($GLOBALS['conn'], $sql)){
            TextNode("success", "Record Successfully Inserted...!");
        }else{
            echo "Error";
        }
    }else
    {
            TextNode("error", "Provide Data in the Textbox");
    }

   
}

function textboxValue($value){
    $textbox = mysqli_real_escape_string($GLOBALS['conn'], trim($_POST[$value]));
    if(empty($textbox)){
        return false;
    }else{
        return $textbox;
    }
}


// messages
function TextNode($classname, $msg){
    $element = "<h6 class='$classname'>$msg</h6>";
    echo $element;
}


// get data from mysql database
function getData(){
    $sql = "SELECT * FROM task";

    $result = mysqli_query($GLOBALS['conn'], $sql);

    if(mysqli_num_rows($result) > 0){
        return $result;
    }
}

function UpdateData(){
    $school_id = textboxValue("school_id");
    $task_desc = textboxValue("task_description");
    $company_id = 1;
    $task_id = textboxValue("task_id");

    if($task_desc){

        $sql = "UPDATE `task` SET `school_id`='$school_id',`company_id`='$company_id',`task_description`='$task_desc' WHERE task_id='$task_id';";

        if(mysqli_query($GLOBALS['conn'], $sql)){
            TextNode("success", "Data Successfully Updated");
        }else{
            TextNode("error", "Unable to Update Data");
        }

    }else{
        TextNode("error", "Select Data Using Edit Icon");
    }


}


function deleteRecord(){
    
$task_id= (int)textboxValue("task_id");

    $sql = "DELETE FROM task WHERE task_id ='$task_id'";

    if(mysqli_query($GLOBALS['conn'], $sql)){
        TextNode("success","Record Deleted Successfully...!");
    }else{
        TextNode("error","Unable to Delete Record...!");
    }

}




// set id to textbox
function setID(){
    $getid = getData();
    $id = 0;
    if($getid){
        while ($row = mysqli_fetch_assoc($getid)){
            $id = $row['task_id'];
        }
    }
    return ($id + 1);
}

//set company id
function setComp_ID(){
    $comp_id = 1;
    return ($comp_id);
}

function getSchoolData(){
$school_id = textboxValue("school_id");

    $sql = "SELECT * FROM task WHERE school_id = '$school_id'";

    $result = mysqli_query($GLOBALS['conn'], $sql);

    if(mysqli_num_rows($result) > 0){
        return $result;
    }
}




