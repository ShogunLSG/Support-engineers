<?php

function connect()
{
    $conn = mysqli_connect("localhost", "root", "", "engineers");

    if (!$conn) {

        print("could not connect to database");
    }

    return $conn;
}

function isTaskEmpty($taskId)
{

    $value = 1;

    $conn = connect();

    $sql = "Select * From emp_task where task_Id=$taskId";
    $results = $conn->query($sql);


    $data = mysqli_fetch_assoc($results);

    if ( isset($data['task_id']) ) {

        $value = 0;

    }



    $conn->close();

    return $value;
}

function taskAssignedTo($taskId)
{

    $value = "unassigned";

    $conn = connect();

    $sql = "Select a.emp_id as tempid,b.First_name,b.Surname  From emp_task a,employee b where a.Task_id=$taskId and a.emp_id=b.Emp_id";
    $results = $conn->query($sql);


    $data = mysqli_fetch_assoc($results);

    if (isset($data['tempid'])) {

        $value = $data['First_name'] . " " . $data['Surname'];
    }


    $conn->close();

    return $value;
}

function getTaskAmount($taskId)
{

    $value = "-";

    $conn = connect();

    $sql = "Select Amount from emp_task where Task_id=$taskId";
    $results = $conn->query($sql);


    $data = mysqli_fetch_assoc($results);

    if (isset($data['Amount'])) {

        $value = "R".$data['Amount'];
    }


    $conn->close();

    return $value;
}

function getTaskCompletionDate($taskId)
{

    $value = "incomplete";

    $conn = connect();

    $sql = "Select completed_date from emp_task where Task_id=$taskId";
    $results = $conn->query($sql);


    $data = mysqli_fetch_assoc($results);

    if (isset($data['completed_date'])) {

        if( $data['completed_date'] != "0000-00-00" ){
        $value = $data['completed_date'];
        }

    }


    $conn->close();

    return $value;
}

function updateTaskEmpId($taskId, $empId)
{

    $conn = connect();

    $sql = "UPDATE emp_task SET emp_id=$empId where task_id=?";
    $stmt = mysqli_stmt_init($conn);

	print("updateTaskEmpId()<br>");
    print("Task ID: ".$taskId."<br>");
    print("Employee ID: ".$empId."<br>");

    if (!mysqli_stmt_prepare($stmt, $sql)) {

        print("could not prepare statement b");
        exit();
    } else {


        mysqli_stmt_bind_param($stmt, "i", $taskId);

        if (!mysqli_stmt_execute($stmt)) {

            print("could not execute statement");
            exit();
        }
    }

    $conn->close();

}

function updateTaskAmount($taskId, $amount)
{

    print("<br><br>updateTaskAmount()<br>");
	print("Task ID: ".$taskId."<br>");
	print("amount: ".$amount."<br>");

    $conn = connect();

    $sql = "UPDATE emp_task SET amount=$amount where task_id=?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {

        print("could not prepare statement a");
        exit();
    } else {


        mysqli_stmt_bind_param($stmt, "i", $taskId);

        if (!mysqli_stmt_execute($stmt)) {

            print("could not execute statement");
            exit();
        }
    }

    $conn->close();

}

function unassignTask($taskId)
{

    $conn = connect();

    $sql = "DELETE From emp_task where task_id=?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {

        print("could not prepare statement");
        exit();
    } else {


        mysqli_stmt_bind_param($stmt, "i", $taskId);

        if (!mysqli_stmt_execute($stmt)) {

            print("could not execute statement unassignTask");
            exit();
        }
    }
}

function addTask($taskDetails)
{

    $conn = connect();

    $sql = "INSERT INTO task(`task_desc`) VALUES (?)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {

        print("could not prepare statement");
        exit();
    } else {


        mysqli_stmt_bind_param($stmt, "s", $taskDetails);

        if (!mysqli_stmt_execute($stmt)) {

            print("could not execute statement addTask");
            exit();
        }
    }
}

function employeeSelect()
{

    $conn = connect();

    $sql = "Select * From employee";
    $results = $conn->query($sql);

    print("<td style='border-bottom:2px solid #343a40;background-color:white;padding-top:18px'><select name='employee'>");
    print("<option value='-1'>unassign</option>");

    while ($data = mysqli_fetch_assoc($results)) {

        print("<option value='$data[Emp_id]'>$data[First_name] $data[Surname]</option>");
    }

    print("</select></td>");

    $conn->close();
}

function assignTask($companyId, $taskId, $employeeId, $amount)
{

    if ( isTaskEmpty($taskId) == 0) {

		print("assignTask()<br>");
		print("amount:$amount<br><br>");
	
        updateTaskEmpId($taskId, $employeeId);
		
		if(!empty($amount)){
		
			updateTaskAmount($taskId,$amount);
    
		}
	

    } else {
        $conn = connect();

        $sql = "INSERT INTO emp_task (company_id,task_id,emp_id,amount) VALUES (?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {

            print("could not prepare statement");
            exit();
        } else {


            mysqli_stmt_bind_param($stmt, "iiii", $companyId, $taskId, $employeeId, $amount);

            if (!mysqli_stmt_execute($stmt)) {

                print("could not execute statement assignTask");
                exit();
            }
        }
    }
}

function displayTasksTable()
{

    $conn = connect();

    //$sql = "Select a.task_id,a.task_desc,a.distance,a.amount,a.date,a.school_location,c.emp_name,c.emp_surname From task a,emp_task b,employee c where a.task_id=b.task_id and c.emp_id=b.emp_id and c.emp_id=b.emp_id";
    $sql = "Select a.Task_id,a.School_id as tSchool_id,a.Company_id,a.Task_Description,b.school_name FROM task a,school b where a.School_Id=b.School_id and a.Company_id=$_SESSION[company_ID]";
    $results = $conn->query($sql);

    print("<table class='table table-striped table-dark'  border='0' style='text-align:center;transform:scale(.8);' cellspacing='0'>");
    print("<thead class='thead-dark'>");
    print("<tr style='background-color:#343a40'>");
    print("<th scope='col' colspan='6'><h3>Task Details</h3></th>");
    print("<th scope='col' colspan='1' style='background-color:black'><p style='width:1px;'></p></th>");
    print("<th scope='col' colspan='3' ><h3>Assign Tasks</h3></th>");
    print("</tr>");
    print("</thead>");
    print("<thead class='thead-dark'>");
    print("<tr style='background-color:#343a40'>");
    print("<th scope='col'><p>ID</p></th>");
    print("<th scope='col'><p style='width:200px;'>School Name</p></th>");
    print("<th scope='col'><p style='width:300px;'>Description</p></th>");
    print("<th scope='col' ><p style='width:100px;'>Amount</p></th>");
    print("<th scope='col' ><p style='width:200px;'>Completion Date</p></th>");
    print("<th scope='col' ><p style='width:200px;'>Currently Assigned</p></th>");
    print("<th scope='col' style='background-color:black'><p style='width:1px;'></th>");
    print("<th scope='col' ><p style='width:200px;'>Select Employee</p></th>");
    print("<th scope='col'><p style='width:100px;'>Set amount</p></th>");
    print("<th scope='col'><p style='width:100px;'>-</p></th>");
    print("</tr>");
    print("</thead>");
    print("<tbody>");


    while ($data = mysqli_fetch_assoc($results)) {



        print("<form action='php/send task script.php'  method='POST'>");
        print("<tr>");
        print("<td style='border-bottom:2px solid #343a40;background-color:white'><p style='color:black;padding:10;padding-top:7px;'>" . $data['Task_id'] . "</p></td>");
        print("<td style='border-bottom:2px solid #343a40;background-color:white'><p style='color:black;padding:10;padding-top:7px;'>" . $data['school_name'] . "</p></td>");
        print("<td style='border-bottom:2px solid #343a40;background-color:white'><p style='color:black;padding:10;padding-top:7px;'>" . $data['Task_Description'] . "</p></td>");
        print("<td style='border-bottom:2px solid #343a40;background-color:white'><p style='color:black;padding:10;padding-top:7px;'>" . getTaskAmount($data['Task_id'])  . "</p></td>");
        print("<td style='border-bottom:2px solid #343a40;background-color:white'><p style='color:black;padding:10;padding-top:7px;'>" . getTaskCompletionDate($data['Task_id']) . "</p></td>");
        print("<td style='border-bottom:2px solid #343a40;background-color:white'><p style='color:black;padding:10;padding-top:7px;'>" . taskAssignedTo($data['Task_id']) . "</p></td>");
        print("<td style='border-bottom:2px solid #343a40;background-color:black'></td>");
        employeeSelect();
        print("<td style='border-bottom:2px solid #343a40;background-color:white;padding-top:17px;'><input name='amount' type='number' /></td>");
        print("<td style='background-color:white;border-bottom:2px solid #343a40'><button type='submit' class='smaller' style='margin-top:0px;margin-bottom:-10px;background-color:#2bab0d;border:0;' name='update'>assign</button</td>");
        print("<input type='hidden' value='" . $data['Task_id'] . "' name='taskId' />");
        ///  print("<input type='hidden' value='" . $data['amount'] . "' name='amount' />");
        print("</tr>");
        print("</form>");
    }

    print("</tbody>");

    print("</table>");
}

function displayTasksTableView()
{

    $conn = connect();

    //$sql = "Select a.task_id,a.task_desc,a.distance,a.amount,a.date,a.school_location,c.emp_name,c.emp_surname From task a,emp_task b,employee c where a.task_id=b.task_id and c.emp_id=b.emp_id and c.emp_id=b.emp_id";
    $sql = "Select a.task_id,a.school_id as tSchool_id,a.company_id,a.task_description,b.school_name FROM task a,school b where a.school_Id=$_SESSION[school_ID] and a.company_id=1 and b.school_Id=$_SESSION[school_ID]";
    $results = $conn->query($sql);

    print("<table class='table table-striped table-dark'  border='0' style='text-align:center;transform:scale(.8);' cellspacing='0'>");
    print("<thead class='thead-dark'>");
    print("<tr style='background-color:#343a40'>");
    print("<th scope='col'><p>ID</p></th>");
    print("<th scope='col'><p style='width:200px;'>School Name</p></th>");
    print("<th scope='col'><p style='width:300px;'>Description</p></th>");
    print("<th scope='col' ><p style='width:100px;'>Amount</p></th>");
    print("<th scope='col' ><p style='width:200px;'>Completion Date</p></th>");
    print("<th scope='col' ><p style='width:200px;'>Currently Assigned</p></th>");
    print("</tr>");
    print("</thead>");
    print("<tbody>");


    while ($data = mysqli_fetch_assoc($results)) {



        print("<form action='php/send task script.php'  method='POST'>");
        print("<tr>");
        print("<td style='border-bottom:2px solid #343a40;background-color:white'><p style='color:black;padding:10;padding-top:7px;'>" . $data['task_id'] . "</p></td>");
        print("<td style='border-bottom:2px solid #343a40;background-color:white'><p style='color:black;padding:10;padding-top:7px;'>" . $data['school_name'] . "</p></td>");
        print("<td style='border-bottom:2px solid #343a40;background-color:white'><p style='color:black;padding:10;padding-top:7px;'>" . $data['task_description'] . "</p></td>");
        print("<td style='border-bottom:2px solid #343a40;background-color:white'><p style='color:black;padding:10;padding-top:7px;'>" . getTaskAmount($data['task_id'])  . "</p></td>");
        print("<td style='border-bottom:2px solid #343a40;background-color:white'><p style='color:black;padding:10;padding-top:7px;'>" . getTaskCompletionDate($data['task_id']) . "</p></td>");
        print("<td style='border-bottom:2px solid #343a40;background-color:white'><p style='color:black;padding:10;padding-top:7px;'>" . taskAssignedTo($data['task_id']) . "</p></td>");
        ///  print("<input type='hidden' value='" . $data['amount'] . "' name='amount' />");
        print("</tr>");
        print("</form>");
    }

    print("</tbody>");

    print("</table>");
}
