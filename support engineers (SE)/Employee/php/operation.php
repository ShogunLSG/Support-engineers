<?php

require_once ("db.php");
require_once ("component.php");
session_start();
$con = Createdb();

// create button click
if(isset($_POST['create'])){
    createData();
}

if(isset($_POST['update'])){
    UpdateData();
}

if(isset($_POST['direction'])){
   header("Location: ../Employee/gmaps/directions.php");
        exit();
}

if(isset($_POST['deleteall'])){
    deleteAll();

}

function createData(){
    $emp_id = textboxValue("emp_id");
    $company_id = textboxValue("company_id");
    $task_id = textboxValue("task_id");
    $completed_date = textboxValue("completed_date");
    $amount = textboxValue("amount");

    if($emp_id && $company_id && $task_id && $completed_date && $amount){

        $sql = "INSERT INTO emp_task (emp_id, company_id, task_id,completed_date,amount) 
                        VALUES ('$emp_id','$company_id','$task_id','$completed_date','$amount')";

        if(mysqli_query($GLOBALS['con'], $sql)){
            TextNode("success", "Record Successfully Inserted...!");
        }else{
            echo "Error";
        }

    }else{
            TextNode("error", "Provide Data in the Textbox");
    }
}

function textboxValue($value){
    $textbox = mysqli_real_escape_string($GLOBALS['con'], trim($_POST[$value]));
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
    $id =$_SESSION['employee_ID'];
    $sql = "SELECT * FROM emp_task WHERE emp_id ='$id'";

    $result = mysqli_query($GLOBALS['con'], $sql);

    if(mysqli_num_rows($result) > 0){
        return $result;
    }
}

// update dat
function UpdateData(){
    
    $id =textboxValue("emp_task_id");
    $completed_date = textboxValue("completed_date");
    $task_id = textboxValue("task_id");
    
	//print($id."<br>");
	//print("completed data: ".$completed_date."<br>");
	//print("task id: ".$task_id."<br>");
	//exit();
	
    if($task_id){
         $sql ="SELECT school_name FROM school,task WHERE school.school_id = task.school_id AND task.task_id ='$task_id';";
        $queryResult = mysqli_query($GLOBALS['con'],$sql);
        
        while($row =mysqli_fetch_assoc($queryResult)){
            
           $school_name = $row['school_name'];  
           # session_start();
           $_SESSION['school_name'] =  $school_name;
        
    } 
    
        
    }
   
    

    $rate = 3.98;
    $travelCost = (float)getDistance("TUT soshanguve",$school_name);
    $cost =$rate*$travelCost;

    
 
     if($id  && $completed_date && $cost){
        $sql = "
                    UPDATE emp_task SET  completed_date ='$completed_date' ,amount =amount+ '$cost' WHERE emp_task_id='$id'; ";

        if(mysqli_query($GLOBALS['con'], $sql)){
            TextNode("success", "Data Successfully Updated");
        }else{
            TextNode("error", "Enable to Update Data");
        }

    }else{
        TextNode("error", "Insert Data Using text box -correct employee task id ,and date you will complete the task ");
    }


}


function deleteRecord(){
    $userid = (int)textboxValue("emp_task_id");

    $sql = "DELETE FROM emp_task WHERE emp_task_id=$userid";

    if(mysqli_query($GLOBALS['con'], $sql)){
        TextNode("success","Record Deleted Successfully...!");
    }else{
        TextNode("error","Unable to Delete Record...!");
    }

}


function deleteBtn(){
    $result = getData();
    $i = 0;
    if($result){
        while ($row = mysqli_fetch_assoc($result)){
            $i++;
            if($i > 100){
                buttonElement("btn-deleteall", "btn btn-danger" ,"<i class='fas fa-trash'></i> Delete All", "deleteall", "");
                return;
            }
        }
    }
}


function deleteAll(){
    $sql = "DROP TABLE emp_task";

    if(mysqli_query($GLOBALS['con'], $sql)){
        TextNode("success","All Record deleted Successfully...!");
        Createdb();
    }else{
        TextNode("error","Something Went Wrong Record cannot deleted...!");
    }
}


// set id to textbox
function setID(){
    $getid = getData();
    $id = 0;
    if($getid){
        while ($row = mysqli_fetch_assoc($getid)){
            $id = $row['emp_task_id'];
        }
    }
    return ($id + 1);
}


function getDistance($startLoc, $endLoc)
{

    $distanceReturn = "invalid address";

    $debug = false;//set debugging to true or false

    $start = $startLoc;
    $end = $endLoc;

    $key = "AIzaSyB6orQbWGCAQ7qD5PSorHJR4Pg8yx4gnB8";
    $url = "https://maps.googleapis.com/maps/api/directions/json?origin=" . urlencode($start) . "&destination=" . urlencode($end) . "&key=AIzaSyB6orQbWGCAQ7qD5PSorHJR4Pg8yx4gnB8";
    $jsonfile = file_get_contents($url);
    $jsondata = json_decode($jsonfile);

    $startAddrStatus = $jsondata->geocoded_waypoints[0]->geocoder_status;
    $endAddrStatus = $jsondata->geocoded_waypoints[1]->geocoder_status;

    $status = $jsondata->status;

    if ($startAddrStatus == 'ZERO_RESULTS' || $endAddrStatus == 'ZERO_RESULTS' || empty($start) || empty($end) || $status == 'ZERO_RESULTS') {

        if ($debug == true) {

            print("one of the addresses is invalid<br>");
        }

    } else {

        $startAddr = $jsondata->routes[0]->legs[0]->start_address;
        $startAddrID = $jsondata->geocoded_waypoints[0]->place_id;

        $endAddr = $jsondata->routes[0]->legs[0]->end_address;
        $endAddrID = $jsondata->geocoded_waypoints[1]->place_id;

        $distance = $jsondata->routes[0]->legs[0]->distance->text;

        $start = strtoupper($start);
        $end = strtoupper($end);

        $kilometres = $jsondata->routes[0]->legs[0]->distance->value / 1000;
        $distanceReturn = $kilometres;
       // $rate = 3.98;
       // $cost = round($kilometres * $rate, 2);

        if ($debug == true) {

            print("json url: $url</br></br>");

            print("start address: $start</br>");
            print("start address detailed: $startAddr</br>");
            print("start address ID: $startAddrID</br></br>");

            print("end address: $end</br>");
            print("end address detailed: $endAddr</br>");
            print("end address ID: $endAddrID</br></br>");

            print("distance: $distance</br>");
        }
    }


    return $distanceReturn;
}






