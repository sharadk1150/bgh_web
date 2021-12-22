<?php
// Start the session
session_start();

//login.php

include('pdo_db_connections.php');

if(isset($_SESSION['type']))
{
 header("location:inv_index.php");
}

$message = '';

if(isset($_POST["login"]))
{
  
    $query = "SELECT * FROM INV_USER_DETAILS WHERE USER_EMAIL = :user_email";
    $statement = $connect->prepare($query);
  //$statement->bindParam(':user_email', $_POST["user_email"]);
    $statement->execute(array('user_email' => $_POST["user_email"]));
 
    $count = $statement->rowCount();
    echo $count;
    $count = 1;

 if($count > 0)
 {
  $result = $statement->fetchAll();
  foreach($result as $row)
  {
      echo($row["USER_PASSWORD"]);

   //if(password_verify($_POST["user_password"], $row["USER_PASSWORD"]))
   if(($_POST["user_password"] == $row["USER_PASSWORD"]))
   
   {
    echo("SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS\n");   
    if($row['USER_STATUS'] == 'Active')
    {
     $_SESSION['type']      = $row['USER_TYPE'];
     $_SESSION['user_id']   = $row['USER_ID'];
     $_SESSION['user_name'] = $row['USER_NAME'];
     
     header("location:inv_index.php");
    }
    else
    {
     $message = "<label>Your account is disabled, Contact Master</label>";
    }
   }
   else
   {
    $message = "<label>Wrong Password</label>";
   }
  }
 }
 else
 {
  $message = "<label>Wrong Email Address</labe>";
 }
}

?>

<!DOCTYPE html>
<html>
 <head>
  <title>Inventory Management System using PHP with Ajax Jquery</title>  
  
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script> 
  <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>





 </head>
 <body>
  <br />
  <div class="container">
   <h2 align="center">Inventory Management System using PHP with Ajax Jquery</h2>
   <br />
   <div class="panel panel-default">
    <div class="panel-heading">Login</div>
    <div class="panel-body">
     <form method="post">
      <?php echo $message; ?>
      <div class="form-group">
       <label>User Email</label>
       <input type="text" name="user_email" class="form-control" required />
      </div>
      <div class="form-group">
       <label>Password</label>
       <input type="password" name="user_password" class="form-control" required />
      </div>
      <div class="form-group">
       <input type="submit" name="login" value="Login" class="btn btn-info" />
      </div>
     </form>
    </div>
   </div>
  </div>
 </body>
</html>
