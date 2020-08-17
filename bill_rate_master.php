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
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="node_modules/datatables.net-dt/css/jquery.dataTables.min.css">
    <script src="node_modules/datatables.net/js/jquery.dataTables.min.js"></script>



<!-- working
<script>
    $(document).ready( function () {
        var table = $('#example').DataTable();
      } );
</script>      
-->
<script>
    $(document).ready( function () {
        var table = $('#example').DataTable({ fixedHeader: true});
      } );
</script>      


<!--
$('#myTable').DataTable( {
    fixedHeader: true
} );
-->

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
    <title>BGH: RATE Chart for IPD</title>
  </head>
  <body>


<nav class="navbar navbar-dark fixed-top bg-warning">
 <a class="navbar-brand" href="bgh_main.php"><img src="sail-logo.jpg" width="40" height="40" alt="BGH-MAIN"></a> 
 <h2>IPD Charges for Normal and RD/CD Category</h2>
<div class="container">



</nav>
</div>  


<br><br><br><br>


<?php
         
        function do_fetch($s)
        {
            //Fetch the results in an associative array
            //print '<p>$myeid is ' . $myeid . '</p>';
            //print '<p>Data Showing For the Date:' . $myeid . '</p>';
            // <table class="table table-dark">
            // print '<table class="table table-sm table-bordered table-striped table-dark w-auto"  border="1">';
            
//            print '<table id="example" class="display" style="width:100%">';
//            print '<table id="example" class="table table-striped table-dark table-bordered" style="width:100%">';                
            print '<table id="example" class="display nowrap table-bordered" width="80%">';          
//            print '<tr>'; 
//              print '<td  colspan="9">' . 'Donor Data From : ' . date('d-m-Y', strtotime($mystdate)) . ' To '. date('d-m-Y', strtotime($myendate)) .  '</td>';
//            print '</tr>';  

            print '<thead>';           
            print '<tr>';
                print '<th scope="col">Charge-Name</th>';
                print '<th scope="col">Charge-Code</th>';
                print '<th scope="col">Normal-Rate</th>';
                print '<th scope="col">RD-Rate</th>';                           
            print '</tr>';
            print '</thead>';   

            print '<tfoot>';           
            print '<tr>';
            print '<th scope="col">Charge-Name</th>';
            print '<th scope="col">Charge-Code</th>';
            print '<th scope="col">Normal-Rate</th>';
            print '<th scope="col">RD-Rate</th>';                           
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

        $query = "select name chargename, chargecode chargecode, charges18 normal_rate, charges18rd rd_rate
                  from wardbill_chargedic_new
                  where del_18 is null and subgroup='N'
                  order by chargecode";
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



<script src="node_modules/popper.js/dist/popper.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- </div> -->   
</body>
</html>