<?php

//require("dbConnect.php");

function addSchool($username, $schoolName, $location, $password)
{

    $conn = connect();

    $sql = "INSERT INTO school (`School_UserName`,`School_name`,`School_location`,`Password`) VALUES(?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {

        print("could not prepare statement");
        exit();
    } else {

        $hashedPass = password_hash($password, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "ssss", $username, $schoolName, $location, $hashedPass);

        if (!mysqli_stmt_execute($stmt)) {

            print("could not execute statement");
            exit();
        }
    }
}

function addCompany($username, $companyName, $location, $password)
{

    $conn = connect();

    $sql = "INSERT INTO company (`Company_UserName`,`Company_name`,`Company_address`,`Company_Password`) VALUES(?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {

        print("could not prepare statement");
        exit();
    } else {

        $hashedPass = password_hash($password, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "ssss", $username, $companyName, $location, $hashedPass);

        if (!mysqli_stmt_execute($stmt)) {

            print("could not execute statement");
            exit();
        }
    }
}

function addEmployee($companyId, $username, $firstname, $lastname, $password)
{

    $conn = connect();

    $sql = "INSERT INTO employee (`Company_id`,`Emp_UserName`,`First_name`,`Surname`,`emp_password`) VALUES(?,?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {

        print("could not prepare statement");
        exit();
    } else {

        $hashedPass = password_hash($password, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "issss", $companyId, $username, $firstname, $lastname, $hashedPass);

        if (!mysqli_stmt_execute($stmt)) {

            print("could not execute statement");
            exit();
        }
    }



    //inserting into salary
    $last_id = $conn->insert_id;
    $salary = 0;
    $sql = "INSERT INTO salary (`Emp_id`,`Salary`) VALUES(?,?)";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {

        print("could not prepare statement");
        exit();
    } else {

        $hashedPass = password_hash($password, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "ii", $last_id, $salary);

        if (!mysqli_stmt_execute($stmt)) {

            print("could not execute statement");
            exit();
        }
    }
}

function companyOptions()
{

    $conn = connect();

    $sql = "Select * from company";

    $results = $conn->query($sql);

    print("<select type='text' style='width: 50%;height:50;text-align:center;' name='companyId'>");

    while ($data = mysqli_fetch_assoc($results)) {

        print("<option value='" . $data['company_id'] . "'>" . $data['company_name'] . "</option>");
    }

    print("</select>");
}

function isInDB($table, $column, $where = "#")
{

    $value = 0;

    $conn = connect();

    $stmt = mysqli_stmt_init($conn);
    $query = "SELECT * FROM $table;";

    if ($where != "#") {

        $query = "SELECT * FROM $table WHERE $where;";
    }

    if (!mysqli_stmt_prepare($stmt, $query)) {

        print("could not prepare statement");
        exit();
    } else {

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        $data = mysqli_fetch_assoc($result);

        if (isset($data[$column])) {

            $value = 1;
        }

        mysqli_stmt_close($stmt);
    }

    return $value;
}

function isLoginValid($table, $eColumn, $eValue, $pColumn, $pValue)
{

    $conn = connect();

    $value = 1;

    $stmt = mysqli_stmt_init($conn);
    $query = "SELECT `$eColumn`,`$pColumn` FROM $table WHERE `$eColumn`=?;";

    if (!mysqli_stmt_prepare($stmt, $query)) {

        print("could not prepare statement");
    } else {

        mysqli_stmt_bind_param($stmt, "s", $eValue);

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        $data = mysqli_fetch_assoc($result);

        if ($data[$eColumn] == $eValue && password_verify($pValue, $data[$pColumn]) == true) {

            $value = 1;
        } else {

            $value = 0;
        }

        mysqli_stmt_close($stmt);

        return $value;
    }
}

function selectFromTable($table, $column, $where)
{

    $conn = connect();

    $stmt = mysqli_stmt_init($conn);

    $value = NULL;


    $query = "SELECT * FROM $table WHERE $where;";


    if (!mysqli_stmt_prepare($stmt, $query)) {

        print("could not prepare statement");
    } else {

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        $data = mysqli_fetch_assoc($result);

        if (!empty($data)) {


            $value = $data[$column];
        }


        mysqli_stmt_close($stmt);
    }

    return $value;
}


function update($table, $column, $value, $where, $type){

    $conn = connect();

    $table = filter_var($table, FILTER_SANITIZE_STRING);
    $column = filter_var($column, FILTER_SANITIZE_STRING);
    $value = filter_var($value, FILTER_SANITIZE_STRING);

    $stmt = mysqli_stmt_init($conn);
    $query = "UPDATE `$table` SET `$column`=? WHERE $where;";

    if (!mysqli_stmt_prepare($stmt, $query)) {

        print("<p style='margin:0;color:red'>could not prepare statement</p>");
        print("<p style='margin:0;color:blue'>debug: ");
        print("\$dbObj -> update()</p>");
    } else {

        mysqli_stmt_bind_param($stmt, "$type", $value);
        mysqli_stmt_execute($stmt);
    }
}

function verEP($table, $eColumn,$eValue,$pColumn,$pValue)
    {

        $conn = connect();

        $value=false;

        $table = filter_var($table, FILTER_SANITIZE_STRING);
        $eColumn = filter_var($eColumn, FILTER_SANITIZE_STRING);
        $eValue = filter_var($eValue, FILTER_SANITIZE_STRING);
        $pColumn = filter_var($pColumn, FILTER_SANITIZE_STRING);
        $pValue = filter_var($pValue, FILTER_SANITIZE_STRING);

        $stmt = mysqli_stmt_init($conn);
        $query = "SELECT `$eColumn`,`$pColumn` FROM $table WHERE `$eColumn`=?;";

        if (!mysqli_stmt_prepare($stmt, $query)) {

            print("<p style='margin:0;color:red'>could not prepare statement</p>");
            print("<p style='margin:0;color:blue'>debug: ");
            print("\$dbObj -> verEP()</p>");
        } else {

            mysqli_stmt_bind_param($stmt,"s",$eValue);

            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            $data = mysqli_fetch_assoc($result); 

            if( $data[$eColumn]==$eValue && password_verify($pValue,$data[$pColumn])==true ){

                $value=true;

            }else{

                $value=false;

            }

            mysqli_stmt_close($stmt);

            return $value;

        }
    }