<?php
session_start();
require_once("php/component.php");
require_once("php/operation.php");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <title>Update Users</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!--Custom stylesheet-->

    <link rel="stylesheet" href="style.css">
</head>

<body>

 <!-------------------------menu----------------------------->



 <div class="menu-bar">
        <ul>

            <li class="active"><a href="index.php"><i></i>Users</li>


            <li><a href="view task.php"><i></i>View Tasks</a></li>
            <li><a href="send task.php"><i></i>Send Tasks</a></li>
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
        <div style="margin-top: 50px;" class="container text-center">
            <h1 class="py-4 bg-dark text-light rounded"><?php //print($_SESSION['company_name']); ?> Users</h1>

            <div style="margin-top: 50px;" class="d-flex justify-content-center">
                <form action="" method="post" class="w-50">
                    <div class="py-2">
                        <?php
                        inputElement("<i style='width:100px'>Employee ID</i>", "", "id", setID());
                        ?>

                    </div>
                    <div class="PT-2">
                        <?php
                        inputElement("<i style='width:100px'>Company ID</i>", "", "company_id", "");
                        ?>

                    </div>

                    <div class="PT-2">
                        <?php
                        inputElement("<i style='width:100px'>Username</i>", " ", "username", "");
                        ?>

                    </div>

                    <div class="PT-2">
                        <?php
                        inputElement("<i style='width:100px'>First name</i>", "", "firstname", "");
                        ?>

                    </div>

                    <div class="PT-2">
                        <?php
                        inputElement("<i style='width:100px'>Last name</i>", " ", "lastname", "");
                        ?>

                    </div>




                    <div class="d-flex justify-content-center">
                        <?php //buttonElement("btn-read", "btn btn-primary", "<i class='fas fa-sync'></i>", "read", "data-toggle='tooltip' data-placement='bottom' title='Read'"); ?>
                        <?php buttonElement("btn-update", "btn btn-light border", "<i class='fas fa-pen-alt'></i>", "update", "data-toggle='tooltip' data-placement='bottom' title='Update'"); ?>
                        <?php buttonElement("btn-delete", "btn btn-danger", "<i class='fas fa-trash-alt'></i>", "delete", "data-toggle='tooltip' data-placement='bottom' title='Delete'"); ?>
                        <?php deleteBtn(); ?>
                    </div>

                </form>

            </div>
            <!bootstrap table-->
                <div class="d-flex table-data">
                    <table class="table table-striped table-dark">
                        <thead class="thead-dark">
                            <tr>
                                <th>Employee ID</th>
                                <th>Company ID</th>
                                <th>Username</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <?php


                        //    if (isset($_POST['read'])) {
                                $result = getData();

                                if ($result) {

                                    while ($row = mysqli_fetch_assoc($result)) { ?>

                                        <tr>
                                            <td data-id="<?php echo $row['emp_id']; ?>"><?php echo $row['emp_id']; ?></td>
                                            <td data-id="<?php echo $row['emp_id']; ?>"><?php echo $row['company_id']; ?></td>
                                            <td data-id="<?php echo $row['emp_id']; ?>"><?php echo $row['emp_username']; ?></td>
                                            <td data-id="<?php echo $row['emp_id']; ?>"><?php echo  $row['first_name']; ?></td>
                                            <td data-id="<?php echo $row['emp_id']; ?>"><?php echo $row['surname']; ?></td>
                                            <td><i class="fas fa-edit btnedit" data-id="<?php echo $row['emp_id']; ?>"></i></td>
                                        </tr>

                            <?php
                                    }
                                }
                         //   }


                            ?>
                        </tbody>

                    </table>
                </div>

        </div>

    </main>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="php/main.js"></script>
</body>

</html>