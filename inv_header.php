<?php
//session_start();
//header.php
?>
<!DOCTYPE html>
<html>
 <head>
  <title>BGH: DashBoard</title>
  <script src="js/jquery-1.10.2.min.js"></script>
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
  <script src="js/bootstrap.min.js"></script>
 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script> 
  <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>



</head>
 <body>
  <br />
  <div class="container">
   <h2 align="center">IPD DashBoard</h2>

   <nav class="navbar navbar-inverse">
    <div class="container-fluid">
     <div class="navbar-header">
      <a href="inv_index.php" class="navbar-brand">Home</a>
     </div>
     <ul class="nav navbar-nav">
     <?php
      $_SESSION["type"] = 'master';
     if($_SESSION['type'] == 'master')
     {
     ?>
      <li><a href="inv_user.php">User</a></li>
      <li><a href="category.php">Category</a></li>
      <li><a href="brand.php">Brand</a></li>
      <li><a href="product.php">Product</a></li>
     <?php
     }
     ?>
      <li><a href="order.php">Order</a></li>
     </ul>
     <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
       <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count"></span> <?php echo $_SESSION["login"]; ?></a>
       <ul class="dropdown-menu">
        <li><a href="inv_profile.php">Profile</a></li>
        <li><a href="inv_logout.php">Logout</a></li>
       </ul>
      </li>
     </ul>

    </div>
   </nav>