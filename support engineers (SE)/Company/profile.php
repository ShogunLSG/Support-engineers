<?php
session_start();
require_once("php/component.php");
require_once("php/operation.php");

function inputElementPwd($icon, $placeholder, $name, $value)
{
    $ele = "
        <div class =\"input-group mb-2\">
            <div class=\"input-group-prepend\">
            <div class =\"input-group-text bg-warning\">$icon</div>
                         
            </div>
            <input type=\"password\"name='$name' value='$value' autocomplete=\"off\" placeholder='$placeholder' class=\"form-control\" id=\"inlineFormInputGroup\" placeholder=\"Username\">
                  
            </div>
    
    ";
    echo $ele;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <title>Profile</title>

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
            <li><a href="send task.php"><i></i>Send Tasks</a></li>
            <li><a href="../salary/index.php"><i></i>Salaries</a></li>
            <li class="active"><a href="profile.php"><i class="fa fa-user"></i>Profile</li>

            <li><a href="../login.php"><i class="fa fa-power-off"></i>Log Out</a></li>

        </ul>



    </div>



    </li>


    </ul>
    </div>


    <!-----------------------menu ends---------------------------->



    <main>
        <div class="container text-center" style="margin-top: 50px;">
            <h1 class="py-4 bg-dark text-light rounded"><i></i><?php //print($_SESSION['company_name']); 
                                                                ?>Company Details</h1>

            <div style="margin-top: 50px;" class="d-flex justify-content-center">
                <form action="php/update details script.php" method="post" class="w-50">

                    <div class="PT-2">
                        <?php
                        if (isset($_GET['details_msg'])) {

                            TextNode("success", "details successfully updated");
                        }
                        ?>

                    </div>

                    <div class="PT-2">
                        <?php
                        inputElement("<i style='width:150px;'>Company email</i>", " ", "company_username", $_SESSION['company_username']);
                        ?>

                    </div>

                    <div class="PT-2">
                        <?php
                        inputElement("<i style='width:150px;'>Company name</i>", "", "company_name", $_SESSION['company_name']);
                        ?>

                    </div>

                    <div class="PT-2">
                        <?php
                        inputElement("<i style='width:150px;'>Company address</i>", " ", "company_address", $_SESSION['company_address']);
                        ?>

                    </div>

                    <button class="wide" name="update_details" type="submit">update details</button>

                </form>

            </div>
            <!bootstrap table-->

        </div>

        <div class="container text-center" style="margin-top: 50px;">
            <h1 style="width:700px;margin:auto" class="py-4 bg-dark text-light rounded"><i></i><?php //print($_SESSION['company_name']); 
                                                                                                ?>Change Password</h1>

            <div style="margin-top: 50px;" class="d-flex justify-content-center">
                <form action="php/update password script.php" method="post" class="w-50">

                    <div class="PT-2">
                        <?php
                        if (isset($_GET['password_msg'])) {

                            if ($_GET['password_msg'] != "incorrect password") {
                                TextNode("success", "password successfully changed");
                            } else {
                                TextNode("error", "incorrect password");
                            }
                        }
                        ?>

                    </div>

                    <div class="PT-2">
                        <?php
                        inputElementPwd("<i style='width:150px;'>Old password</i>", " ", "old_password", "");
                        ?>

                    </div>

                    <div class="PT-2">
                        <?php
                        inputElementPwd("<i style='width:150px;'>New password</i>", "", "new_password", "");
                        ?>

                    </div>

                    <button class="wide" style="width: 300px;" name="update_password" type="submit">change password</button>

                </form>

            </div>
            <!bootstrap table-->

        </div>

    </main>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="php/main.js"></script>
</body>

</html>