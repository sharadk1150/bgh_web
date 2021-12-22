<!-- Create index.php file and add the following code. -->
<!DOCTYPE html>
<html>
<head>

<title>PHP/MySQLi CRUD Operation using Bootstrap/Modal</title>
<!--
<script src="jquery.min.js"></script>
<link rel="stylesheet" href="bootstrap.min.css" />
<script src="bootstrap.min.js"></script>
<link rel="stylesheet" href="jquery.dataTables.min.css"></style>
<script type="text/javascript" src="jquery.dataTables.min.js"></script>
<script type="text/javascript" src="bootstrap-filestyle.min.js"> </script>
<link href="fonts.css" rel="stylesheet">
-->

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
<a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm">
<span class="glyphicon glyphicon-plus"></span> Add New
</a></span>

<div style="height:50px;"></div>


<?php

    $c = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD"); 
    $query = "select substr(old_cat_no,7,11) drug_code, med_Desc, med_gen_name,bname  
              from bgh_med_master where disp_in_form='Y' order by med_gen_name";       
    $s = oci_parse($c, $query);    
    oci_execute($s);
    print '<table class="table table-striped table-bordered table-responsive table-hover" id="empTable">'; 
    print '<thead class="thead-light">';
    print '<tr>'; 
    print '<td colspan="9">' . 'Medicine Master List' . '</td>';
    print '</tr>';
    print '<tr>';
    print '<th scope="col">Drug Code</th>';            
    print '<th scope="col">Med Description</th>';
    print '<th scope="col">Med Gen Name</th>';
    print '<th scope="col">Med Brand Name</th>';
    print '<th scope="col">Action</th>';

    print '</tr>';
    print '</thead>';
    
        while ($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) 
        {
            print '<tr>';
            foreach ($row as $item) 
            {                                
                print '<td>'.($item?htmlentities($item):'&nbsp;').'</td>';
                                                
            }
            
                print '<td>';
                print '<button class="glyphicon glyphicon-edit" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target='. '"#detail'. $row['DRUG_CODE']. '"' . 'Detail</button>&nbsp;';
?>

               

                <?php include('php_crud_show_detail.php');?>

<?php
            print '</td>';
            print '</tr>';
        }
    print '</table>';
?>


</div>
</body>
</html>