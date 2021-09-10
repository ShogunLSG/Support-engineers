<?php
session_start();
require_once("php/functions.php");
//require_once ("../school/php/component.php");
//require_once ("../school/php/operation.php");

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">


  <title>Send Tasks</title>

  <link rel="stylesheet" type="text/css" href="css/style 1.css" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


  <!--Custom stylesheet-->

  <link rel="stylesheet" href="style.css">
</head>

<body>

 <!-------------------------menu----------------------------->



 <div class="menu-bar">
        <ul>

            <li><a href="index.php"><i></i>Users</li>


            <li><a href="view task.php"><i></i>View Tasks</a></li>
            <li class="active"><a href="send task.php"><i></i>Send Tasks</a></li>
            <li><a href="../salary/index.php"><i></i>Salaries</a></li>
            <li><a href="profile.php"><i class="fa fa-user"></i>Profile</li>

            <li><a href="../login.php"><i class="fa fa-power-off"></i>Log Out</a></li>

        </ul>



    </div>



    </li>


    </ul>
    </div>


    <!-----------------------menu ends---------------------------->


  <main>
    <div class="container text-center" style="margin-top: 50px;">
      <h1 class="py-4 bg-dark text-light rounded"><i></i><?php //print($_SESSION['company_name']); ?> Send Tasks</h1>

      <div class="d-flex justify-content-center" id="divToPrint">
        <?php displayTasksTable(); ?>
      </div>

    </div>



    </div>

  </main>


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <script src="../Company/php/main.js"></script>



</body>

</html>