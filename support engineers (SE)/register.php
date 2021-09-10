<?php
require_once("include/dbConnect.php");
require_once("include/global functions.php");
require_once 'include/header.php';
?>


<div>
    <h1>Register</h1>
    <p> Already have an account? <a href="login.php">Login!</a></p>

    <h3>Account Type</h3>
    <select onchange="hiddenOptions()" id="accType" style="width: 50%;height:50;text-align:center;" type="option" name="accountType">
        <option value="Company">Company</option>
        <option value="School">School</option>
        <option value="Employee">Employee</option>
    </select>
    <br>
    <br>


    <center>
        <form id="company_register" action="include/register-inc.php" method="post">
            <input type="text" name="company name" placeholder="company name">
            <input type="text" name="company username" placeholder="company username">
            <input type="text" name="company location" placeholder="company location">


            <input type="password" name="cpassword" placeholder="Password">
            <input type="password" name="cconfirmPassword" placeholder="Confirm password">


            <button type="submit" name="company_register">REGISTER</button>
        </form>

        <center>

            <center>
                <form style="display: none;" id="school_register" action="include/register-inc.php" method="post">
                    <input type="text" name="school_name" placeholder="school name">
                    <input type="text" name="school_username" placeholder="school username">
                    <input type="text" name="school_location" placeholder="school location">


                    <input type="password" name="spassword" placeholder="Password">
                    <input type="password" name="sconfirmPassword" placeholder="Confirm password">


                    <button type="submit" name="school_register">REGISTER</button>
                </form>

                <center>


                    <center>
                        <form style="display: none;" id="employee_register" action="include/register-inc.php" method="post">

                            <div id="companySelect" style="display: none;">
                                <h3>Comapany Name</h3>
                                <?php companyOptions(); ?>
                                <br>
                                <br>
                            </div>

                            <input type="text" name="lastname" placeholder="lastname">
                            <input type="text" name="firstname" placeholder="firstname">

                            <input type="text" name="username" placeholder="username">

                            <input type="password" name="epassword" placeholder="Password">
                            <input type="password" name="econfirmPassword" placeholder="Confirm password">


                            <button type="submit" name="employee_register">REGISTER</button>
                        </form>

                        <center>



</div>

</body>

<script type="text/javascript">
    var docBody = document.getElementById("body");

    var schoolForm = document.getElementById("school_register");
    var companyForm = document.getElementById("company_register");
    var employeeForm = document.getElementById("employee_register");

    var accType = document.getElementById("accType");
    var companyOptions = document.getElementById("companySelect");

    function hiddenOptions() {

        if (accType.value == "Employee") {

            companyOptions.style.display = "table";
            employeeForm.style.display = "table";
            schoolForm.style.display = "none";
            companyForm.style.display = "none";


        } else if (accType.value == "Company") {

            companyOptions.style.display = "none";
            employeeForm.style.display = "none";
            schoolForm.style.display = "none";
            companyForm.style.display = "table";


        } else if (accType.value == "School") {

            companyOptions.style.display = "none";
            employeeForm.style.display = "none";
            schoolForm.style.display = "table";
            companyForm.style.display = "none";


        }


    }

    docBody.onload = function() {

        hiddenOptions();

    };

    //accType.style.display = "none";
</script>

</html>