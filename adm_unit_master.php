<!DOCTYPE html>
<html>
  <head>
<!--  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
-->

<link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="node_modules/datatables.net-bs4/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="node_modules/datatables.net-dt/css/jquery.dataTables.min.css">
<script src="node_modules/jquery/dist/jquery.min.js"></script>
<script src="node_modules/datatables.net/js/jquery.dataTables.min.js"></script>



<script>
    $(document).ready( function () {
        var table = $('#example').DataTable({ fixedHeader: true});
      } );
</script>      


<style>
    body 
    {
        font: 90%/1.45em "Helvetica Neue", HelveticaNeue, Verdana, Arial, Helvetica, sans-serif;
        margin: 0;
        padding: 0;
        color: #333;
        background-color: #fff;
    }
</style>

    <meta charset=utf-8 />
    <title>BGH: Unit Master</title>
  </head>
  <body>

<nav class="navbar navbar-dark fixed-top bg-warning">
 <a class="navbar-brand" href="bgh_main.php"><img src="sail-logo.jpg" width="40" height="40" alt="BGH-MAIN"></a> 
  <h6>BGH IPD Medico Legal Cases</h6>
<div class="container">
    <h2>Currently Active Units and Unit Incharge</h2>
</div>
</nav>
<br><br><br>

<?php
         
        function do_fetch($s)
        {
            print '<table id="example" class="display nowrap table-bordered" width="80%">';          
            print '<thead>';           
            print '<tr>';
                print '<th scope="col">Unit-Code</th>';
                print '<th scope="col">Unit-Name-1</th>';
                print '<th scope="col">UNit-Name-2</th>';
                print '<th scope="col">Active</th>';            
                print '<th scope="col">Last-Change-Date</th>';
            print '</tr>';
            print '</thead>';   

            print '<tfoot>';           
            print '<tr>';
            print '<th scope="col">Unit-Code</th>';
            print '<th scope="col">Unit-Name-1</th>';
            print '<th scope="col">UNit-Name-2</th>';
            print '<th scope="col">Active</th>';            
            print '<th scope="col">Last-Change-Date</th>';
    print '</tr>';
            print '</tfoot>';   
            
            
            print '<tbody>';    
                        while ($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) 
                        {
                            print '<tr>';
                            foreach ($row as $item) 
                            {
                                print '<td>'.($item?htmlentities($item):'&nbsp;').'</td>';
                                
                            }
                                print '</tr>';
                            }
                print '</tbody>';            
                print '</table>';
        }
        
        // Create connection to Oracle
        $c = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD");
        // Use bind variable to improve resuability, 
        // and to remove SQL Injection attacks.

        $query = "select CODE, NAME, NAME1, ACTIVE, CHANGE_DATE
                  from wardbill_unitdic
                  where active='Y' order by code";
                  $s = oci_parse($c, $query);

//        $mystdate = $stdate;
//        oci_bind_by_name($s, ":EIDBV", $mystdate);

//        $myendate = $endate;
//        oci_bind_by_name($s, ":EIDBV1", $myendate);
// Execute the query
        oci_execute($s);
// fecth data
        do_fetch($s);
//        do_fetch($s);
    

        // Close the Oracle connection
        oci_close($c);

?> 


<!--
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>  
-->

<script src="node_modules/popper.js/dist/popper.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>


<!-- </div> -->   
</body>
</html>