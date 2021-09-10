<?php

session_start();

require_once 'php/component.php';
require_once 'php/operation.php';

?>

<html>
<head>
<style>

h4 {
  color: white;
  background: grey;
  border: 2px solid #000000;
  text-align: center;
}

</style>
</head>

<body>
<!-- These session varibles might be usefull -->
<?php /*
<h3>useful session variables:</h3>
<p>$_SESSION['school_ID'] = <?php print($_SESSION['school_ID']) ?> </p>
<p>$_SESSION['school_username'] = <?php print($_SESSION['school_username']) ?> </p>
<p>$_SESSION['school_name'] = <?php print($_SESSION['school_name']) ?> </p>
<p>$_SESSION['school_address'] = <?php print($_SESSION['school_address']) ?> </p>
*/
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">


  <title>Tasks</title>

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!--Custom stylesheet-->

  <link rel="stylesheet" href="style.css">

</head>

<body>
  <!-------------------------menu----------------------------->



  <div class="menu-bar">
    <ul>

      <li class="active"><a href="index.php">Tasks</li>
	  <li><a href="view task.php"><i></i>View Tasks</a>


       

      </li>


      <li><a href="profile.php"><i class="fa fa-user"></i>Profile</li>
      <li><a href="../login.php"><i class="fa fa-power-off"></i>Log Out</a></li>
	<!--<div class="sub-menu-1">
	<ul>
	    <li><a href="#">Track-Tasks</a> </li>
	    <li><a href="#">money-used</a> </li>
	    <li><a href="#">stuff</a> </li>
	    
	</ul>
	
	</div>
-->
</li>



    </ul>
  </div>


  <!-----------------------menu ends---------------------------->





  <main>
  <?php if(isset($_SESSION['school_name'])){

//$school_name = print($_SESSION['school_name']);

}else
{

$school_name = "no";

}

if(isset($_SESSION['school_ID'])){

$school_id = $_SESSION['school_ID'];

}else{
$school_id = 0;

}


?>

          
                      

    <div style="margin-top:50px" class="container text-center">

    
      <h1 class="py-4 bg-dark text-light rounded">Tasks</h1>

      <div class="d-flex justify-content-center">
        
        <form action="" method="post" class="w-50">
          <div class="py-2">

		  <div style="display:none">
		  
        <h4>Task ID</h4>

        <?php
            inputElement("<i class='far fa-user'></i>", "", "task_id",setID());
            ?>
 
          <h4>Company ID</h4>
            <?php
            inputElement("<i class='far fa-user'></i>", "", "company_id",setComp_ID());
            ?>

          

          <div class="py-2">

          <h4>School ID</h4>


          <?php 
          
          

          inputElement("<i class='far fa-user'></i>", "", "school_id",$school_id);

          ?>
</div>
		  
		  </div>


            

          </div>

          <div class="PT-2">
            <?php

            
            inputElement("<i>Task description</i>", "", "task_description", "");
            ?>

          </div>

          
          
          
          

          <div class="d-flex justify-content-center">
            <?php buttonElement("btn-create", "btn btn-success", "<i class='fas fa-plus'></i>", "create", "data-toggle='tooltip' data-placement='bottom' title='Create'"); ?>

            <?php buttonElement("btn-read", "btn btn-primary", "<i class='fas fa-sync'></i>", "read", "data-toggle='tooltip' data-placement='bottom' title='Read'"); ?>

            <?php buttonElement("btn-update", "btn btn-light border", "<i class='fas fa-pen-alt'></i>", "update", "data-toggle='tooltip' data-placement='bottom' title='Update'"); ?>
            
            <?php buttonElement("btn-delete", "btn btn-danger", "<i class='fas fa-trash-alt'></i>", "delete", "data-toggle='tooltip' data-placement='bottom' title='Delete'"); ?>
            
          </div>

		  
		  
        </form>
        </div>
		
	
		
            <!bootstrap table-->
                <div class="d-flex table-data">
                    <table class="table table-striped table-dark">
                        <thead class="thead-dark">
                            <tr>
                                <th>Task ID</th>
                                <th>SCHOOL ID</th>
                                <th>COMPANY ID</th>
                                <th>TASK DESCRIPTION</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                        <?php

                
 

 


if (isset($_POST['read'])) {



    $result = getSchoolData();
    

    if ($result) {

        while ($row = mysqli_fetch_assoc($result)) { ?>

            <tr>
                <td data-id="<?php echo $row['task_id']; ?>"><?php echo $row['task_id']; ?></td>
                <td data-id="<?php echo $row['task_id']; ?>"><?php echo $row['school_id']; ?></td>
                <td data-id="<?php echo $row['task_id']; ?>"><?php echo $row['company_id']; ?></td>
                <td data-id="<?php echo $row['task_id']; ?>"><?php echo  $row['task_description']; ?></td>
                <td><i class="fas fa-edit btnedit" data-id="<?php echo $row['task_id']; ?>"></i></td>
            </tr>

<?php
        }
    }
}


?>
                        </tbody>

                    </table>
                </div>

        </div>


      </div>
      

  </main>


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <script src="../School/php/main.js"></script>  




</body>

</html>
</body>



</html>