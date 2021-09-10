

<?php

require_once ("../Employee/php/component.php");
require_once ("../Employee/php/operation.php");
#require_once ("../Employee/php/directions.php");


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    
    <title><?php print($_SESSION['employee_firstname']) ?></title>
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <!--Custom stylesheet-->
   
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <!-------------------------menu----------------------------->



  <div class="menu-bar">
        <ul>

            <li class="active"><a href="index.php"><i></i>View Tasks</a></li>
            <li ><a href="profile.php"><i class="fa fa-user"></i>Profile</li>
            <li><a href="../login.php"><i class="fa fa-power-off"></i>Log Out</a></li>

        </ul>



    </div>



    </li>


    </ul>
    </div>


    <!-----------------------menu ends---------------------------->
  
  <!----getting total salary---------------------------->
  <?php 
    $id =$_SESSION['employee_ID'];
    $salary=0;
    $query ="SELECT SUM(amount) AS salary FROM emp_task WHERE completed_date >0 AND emp_id ='$id'";
        
    $queryResult = mysqli_query($GLOBALS['con'],$query);
        
    while($row =mysqli_fetch_assoc($queryResult)){
            $salary = $row['salary'];    

        
    }   
    $sql =  "UPDATE salary SET salary = '$salary' WHERE emp_id = '$id'";
    $queryResult = mysqli_query($GLOBALS['con'],$sql);   
   ?>
  <main>
    <div class="container text-center">
        <h1 class="py-4 bg-dark text-light rounded"><?php print($_SESSION['employee_firstname']) ?>'s  Task-received
             
              Current Salary is R <?php print($salary) ?> </h1>
               
            <div class="d-flex justify-content-center">
          <form action="" method="post" class="w-50">
           
            
              <div class="row PT-2">
                 <div class="col">
                  <?php 
                  inputElement("<i class='fas fa-tasks'></i>","EMP-TASK-ID ","emp_task_id","");
                  ?>
                  
              </div> 
                
                <div class="col">
                  <?php 
                  inputElement("<i class='fas fa-calendar-alt'></i>","COMPLETED ","completed_date","");
                  ?>
                  
              </div> 
              
               <div class="col">
                  <?php 
                  inputElement("<i class='fas fa-thumbtack'></i>","TASK-ID","task_id","");
                  ?>
                  
              </div> 
              </div>
              
              
              
               <div class="d-flex justify-content-center">
                       
                        <?php buttonElement("btn-read","btn btn-primary","<i class='fas fa-sync'></i>","read","data-toggle='tooltip' data-placement='bottom' title='Read'"); ?>
                        
                        <?php buttonElement("btn-update","btn btn-light border","<i class='fas fa-check-double'></i>","update","data-toggle='tooltip' data-placement='bottom' title='Take-Task'"); ?>
                        
                        <?php buttonElement("btn-update","btn btn-light border","<i class='fas fa-directions'></i>","direction","data-toggle='tooltip' data-placement='bottom' title='direction'"); ?>
                       
                </div>
            
          </form>
          
      </div>  
             
      
      <div class="d-flex table-data">
            <table class="table table-striped table-dark">
                <thead class="thead-dark">
                    <tr>
                        <th>EMP_TASK-ID</th>
                        <th>EMP-ID</th>
                        <th>COMPANY-ID</th>
                        <th>TASK-ID</th>
                        <th>DATE-COMP</th>
                        <th>AMOUNT</th>
                        <th>Completed</th>
                    </tr>
                </thead>
                
                <!bootstrap table-->
               <tbody id="tbody">
                   <?php
                     
                     
                     
                   if(isset($_POST['read'])){
                       $result = getData();

                       if($result){

                           while ($row = mysqli_fetch_assoc($result)){ ?>

                               <tr>
                                   <td data-id="<?php echo $row['emp_task_id']; ?>"><?php echo $row['emp_task_id']; ?></td>
                                   <td data-id="<?php echo $row['emp_task_id']; ?>"><?php echo $row['emp_id']; ?></td>
                                   <td data-id="<?php echo $row['emp_task_id']; ?>"><?php echo $row['company_id']; ?></td>
                                   <td data-id="<?php echo $row['emp_task_id']; ?>"><?php echo  $row['task_id']; ?></td>
                                   <td data-id="<?php echo $row['emp_task_id']; ?>"><?php echo  $row['completed_date']; ?></td>
                                   <td data-id="<?php echo $row['emp_task_id']; ?>"><?php echo $row['amount']; ?></td>
                                   
                                   <td ><i class="far fa-calendar-check btnedit" data-id="<?php echo $row['emp_task_id']; ?>"></i></td>
                                   
                                   
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
      
  </main>
   
   
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
   
  <script src="../Employee/php/main.js"></script>   
</body>
</html>