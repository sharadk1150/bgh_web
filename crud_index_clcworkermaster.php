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
CLC-Worker Master Listing</span>
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
<th><centre>IP-NO</centre></th>
<th><centre>W-Name</centre></th>
<th><centre>W-Gender</centre></th>
<th><centre>M-User</centre></th>
<th><centre>M-EntDate</centre></th>
<th><centre>AADHAAR</centre></th>
<th><centre>View</centre></th>
<th><centre>Edit</centre></th>



</thead>
<tbody>

<?php

        $c = oci_connect("BGH", "hpv185e", "10.143.100.36/BGH6"); 
        $query = "select ip_no, w_name, w_gender,m_user, m_entdate, aadhaar_no  
          from clc_worker_master";       
        $s = oci_parse($c, $query);    
        oci_execute($s);
        while ($row=oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)){

?>

<tr>

<td><?php echo $row['IP_NO']; ?></td>
<td><?php echo $row['W_NAME']; ?></td>
<td><?php echo $row['W_GENDER']; ?></td>
<td><?php echo $row['M_USER']; ?></td>
<td><?php echo $row['M_ENTDATE']; ?></td>
<td><?php echo $row['AADHAAR_NO']; ?></td>

<td>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detail<?php echo $row['IP_NO'];?>">View</button>
</td>
<td>
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit<?php echo $row['IP_NO'];?>">Edit</button>
</td>

<!-- include the  modals here  -->


</tr>
<?php } ?>

</tbody>
</table>
</div>
<!-- include insert modal -->
<!-- End -->
</div>
</body>
</html>