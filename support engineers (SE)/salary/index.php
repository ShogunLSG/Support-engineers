<html>
<style>

</style>

<head>


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!--Custom stylesheet-->

    <link rel="stylesheet" href="style.css">

    <title> finances </title>
    <style>
        body {
            background-color: lightslategrey;
        }

        table,
        th,
        td {
            border: 1px solid black;
            width: 1100px;
            background-color: white;
            color: black;
        }

        .btn {
            width: 20%;
            height: 5%;
            font-weight: bold;
        }
    </style>
 <!-------------------------menu----------------------------->



 <div class="menu-bar">
        <ul>

            <li><a href="../Company/index.php"><i></i>Users</li>


            <li ><a href="../Company/view task.php"><i></i>View Tasks</a></li>
            <li><a href="../Company/send task.php"><i></i>Send Tasks</a></li>
            <li class="active"><a href="index.php"><i></i>Salaries</a></li>
            <li><a href="../Company/profile.php"><i class="fa fa-user"></i>Profile</li>

            <li><a href="../login.php"><i class="fa fa-power-off"></i>Log Out</a></li>

        </ul>



    </div>



    </li>


    </ul>
    </div>


    <!-----------------------menu ends---------------------------->


</head>

<body>
    <center>

        <div style="margin-top: 50px;" class="container text-center">
            <h1 class="py-4 bg-dark text-light rounded">Financial Details</h1>

            <div class="container">
                
                <form action="" method="POST">

                   <table style="margin-top:50px;transform:scale(0.8)" class="table table-striped table-dark">
                
                    <thead class="thead-dark">
                       
                        <tr>
                            <th>First Name</th>
                            <th>Surname</th>
                            <th>Salary</th>
                            
                         <!--   <input type="submit" class = "btn" name = "finances" value = "View Data"><br><br> -->


                    </thead> 
                    
                </form>




                    <!--bootstrap table-->
                    <tbody id="tbody">
                        <?php
                        $conn = mysqli_connect("localhost", "root", "", "engineers");

                     //   if (isset($_POST['finances'])) {

                            $query = "SELECT first_name, surname,salary 
                            FROM employee,salary 
                            WHERE employee.emp_id = salary.emp_id";
                            
                            $query="SELECT a.first_name,a.surname,b.salary FROM employee a,salary b WHERE a.emp_id=b.emp_id";
                            
                            $query_run = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_array($query_run)) {
                        ?>
                                <tr>
                                    
                                    <td> <?php echo $row['first_name'] ?> </td>
                                    <td> <?php echo $row['surname'] ?> </td>
                                    <td>R <?php echo $row['salary'] ?> </td>

                                </tr>
                        <?php
                            }
                      //  }

                        ?>


        </div>

    </center>
</body>