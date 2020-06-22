<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>

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

  <div class="container">
  <nav class="navbar navbar-dark fixed-top bg-warning">
  <h2>IPD Charges for Normal and RD/CD Category</h2>

<!--
<form  class="form-inline" name="myform" action="bbank_donor_rep_01.php" method="POST">
                <input type="hidden" name="check_submit" value="1" />
    <form class="form-inline">   
        <div class="form-group row">
            <label for="stdate" class="mr-sm-3 col-form-label"> From Date</label> 
                <div class="mr-sm-3">
                    <input type="date" class="form-control" id="stdate" name="stdate" 
                    value=" ?>"> 
                </div>                       
            <label for="endate" class="mr-sm-3 col-form-label"> To Date</label> 
                <div class="mr-sm-3">
                    <input type="date" class="form-control" id="endate" name="endate"
                    value="?>">
                </div>                                            
            <button type="submit" name="submit" class="btn btn-primary">Get Data.</button>                       
            <button type="button" onclick="myFunction()" name="btngraph" class="btn btn-success">Show Graph.</button>                       

        </div>
    </form>            
  </form>
-->


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


<!--
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
-->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>  

<!-- </div> -->   
</body>
</html>