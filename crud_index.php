<!DOCTYPE html>

<html>
<head>

<title>PHP/MySQLi CRUD Operation using Bootstrap/Modal</title>
<link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="DataTables/datatables.min.css" rel="stylesheet" type="text/css" />
<script src="node_modules/jquery/dist/jquery.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="node_modules/bootstrap-filestyle/src/bootstrap-filestyle.min.js"> </script>

<script>

$(document).ready(function(){
$('#empTable').dataTable();

});

</script>
</head>

<body style="margin:20px auto">
<centre>
<h2><span style="font-size:25px; color:blue">
Simple CRUD Operation using PHP, MySQL and Bootstrap</span>
</h2></centre>

<div class="container">
<br/><br/>
<div class="row header col-sm-12" style="text-align:center;color:green">
<span class="pull-left">
<a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> Add New</a></span>

<div style="height:50px;"></div>
<table class="table table-striped table-bordered table-responsive table-hover" 
id="empTable" >
<thead>
<th><centre>DrugCode</centre></th>
<th><centre>Desc</centre></th>
<th><centre>GenName</centre></th>
<th><centre>Bname</centre></th>
<th><centre>View</centre></th>
<th><centre>Edit</centre></th>

</thead>
<tbody>

<?php

        $c = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD"); 
        $query = "select substr(old_cat_no,7,11) drug_code, med_Desc, med_gen_name,bname  
          from bgh_med_master where disp_in_form='Y' order by old_cat_no";       
        $s = oci_parse($c, $query);    
        oci_execute($s);
        while ($row=oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)){

?>

<tr>
<!--<td> <img src='<?php echo $img ?>' height="50px" width="70px" /></td> -->
<td><?php echo $row['DRUG_CODE']; ?></td>
<td><?php echo $row['MED_DESC']; ?></td>
<td><?php echo $row['MED_GEN_NAME']; ?></td>
<td><?php echo $row['BNAME']; ?></td>

<td>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detail<?php echo $row['DRUG_CODE'];?>">View</button>
</td>
<td>
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit<?php echo $row['DRUG_CODE'];?>">Edit</button>
</td>
<?php include('php_crud_show.php'); ?>
<?php include('php_crud_edit.php'); ?>

</tr>
<?php } ?>
</tbody>
</table>
</div>
<!-- include insert modal -->
<?php include('php_crud_add.php'); ?>
<!-- End -->
</div>
</body>
</html>