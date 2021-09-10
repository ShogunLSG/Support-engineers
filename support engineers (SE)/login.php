<?php
require_once 'include/header.php';
?>

<div>
    <h1>Log in</h1>
    <p> No account? <a href="register.php">Register here!</a></p>

    <br>

    <h3>account type</h3>
    <select onclick="hiddenForms()" type='text' style='width: 30%;height:50;text-align:center;' name='accountType' id='accountType'>
        <option value="Employee">Employee</option>
        <option value="School">School</option>
        <option value="Company">Company</option>
    </select>

    <br>

    <center>

    <form action="include/login-inc.php" method="post" id="employee_login">
        <input  type="text" name="employee_username" placeholder="employee username">
        <input type="password" name="employee_password" placeholder="Password">
        <button type="submit" name="employee_login">LOGIN</button>
    </form>

    <form action="include/login-inc.php" method="post" id="school_login">
        <input type="text" name="school_username" placeholder="school username">
        <input type="password" name="school_password" placeholder="Password">
        <button type="submit" name="school_login">LOGIN</button>
    </form>

    <form action="include/login-inc.php" method="post" id="company_login">
        <input type="text" name="company_username" placeholder="company username">
        <input type="password" name="company_password" placeholder="Password">
        <button type="submit" name="company_login">LOGIN</button>
    </form>

    </center>


</div>



</body>

<script type="text/javascript">
    var docBody = document.getElementById("body");

    var employee_form = document.getElementById("employee_login");
    var school_form = document.getElementById("school_login");
    var company_form = document.getElementById("company_login");

    var accountType = document.getElementById("accountType");

    function hiddenForms() {

        

        if (accountType.value == "Employee") {

            employee_form.style.display = "table";
            school_form.style.display = "none";
            company_form.style.display = "none";
        

        } else if (accountType.value == "School") {

            employee_form.style.display = "none";
            school_form.style.display = "table";
            company_form.style.display = "none";


        } else if (accountType.value == "Company") {

            employee_form.style.display = "none";
            school_form.style.display = "none";
            company_form.style.display = "table";

        }

    }


    docBody.onload = function() {

        hiddenForms();

    };
</script>


</html>