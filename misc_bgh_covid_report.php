<!DOCTYPE html>
<html>
  <head>

<link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="DataTables/datatables.min.css" rel="stylesheet" type="text/css" />
<script src="node_modules/jquery/dist/jquery.min.js"></script>
<script src="node_modules/popper.js/dist/popper.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="node_modules/datatables.net/js/jquery.dataTables.min.js"></script>


<style>
 body 
 {
        font: 90%/1.45em "Helvetica Neue", HelveticaNeue, Verdana, Arial, Helvetica, sans-serif;
        margin: 0;
        padding: 0;
        color: #333;
        background-color: #fff;
 }
    
.table-hover tbody tr:hover td, 
.table-hover tbody tr:hover th 
{
  background-color: yellow;
}
</style>
    <meta charset=utf-8 />
    <title>BGH: Covid Report</title>
  </head>
  <body>


  
 
<nav class="navbar navbar-dark fixed-top bg-warning">
 <a class="navbar-brand" href="bgh_main.php"><img src="sail-logo.jpg" width="40" height="40" alt="BGH-MAIN"></a> 
  <h6>BGH Covid Report</h6>
<div class="container">
<!-- Change Here for New Program after Copying -->
<form  class="form-inline" name="myform" action="misc_bgh_covid_report.php" method="POST"> <input type="hidden" name="check_submit" value="1" />     
  
    <div class="form-group">  
        <label for="stdate">Sample Collection From Date</label>  
        <input class="form-control mr-sm-2" type="date"   id="stdate" name="stdate" placeholder="fromDate" aria-label="stdate" value="<?php echo isset($_POST['stdate']) ? $_POST['stdate']:''; ?>">
    </div>     
                  
    <div class="form-group">  
        <label for="endate">Sample Collection To Date</label>  
        <input class="form-control mr-sm-2" type="date" id="endate" name="endate" placeholder="ToDate"   aria-label="todate" value="<?php echo isset($_POST['endate']) ? $_POST['endate']:''; ?>">
    </div>  
          
    <button class="btn btn-success my-2 my-sm-0" type="submit" name="submit">Get Data...</button>
</form>
</div>
</nav>
<br><br><br><br>

<?php
if (array_key_exists('check_submit', $_POST)) 
{
  if (isset($_POST['stdate'])){$stdate    =  $_POST['stdate'];}
  if (isset($_POST['endate'])){$endate    =  $_POST['endate'];}
         

        function do_fetch($mystdate, $myendate, $s)
        {            
            print '<div class="table-responsive">';
            print '<table class="table table-hover table-striped table-bordered mydatatable" style="width:100%">';                        
            print '<p id="billnotmade"></p>';
            print '<thead>';           
            print '<tr>';
                print '<th scope="col">Name</th>';
                print '<th scope="col">Age</th>';               
                print '<th scope="col">Gender</th>';            
                print '<th scope="col">MobileNo</th>';
                print '<th scope="col">Address</th>';
                print '<th scope="col">SampleCollDate</th>';
                print '<th scope="col">TrueNatDate</th>';            
                print '<th scope="col">SampleNo</th>';
                print '<th scope="col">TrueNatType</th>';
                print '<th scope="col">Result</th>';            
            print '</tr>';
            print '</thead>';   
            print '<tfoot>';           
            print '<tr>';
            print '<th scope="col">Name</th>';
            print '<th scope="col">Age</th>';               
            print '<th scope="col">Gender</th>';            
            print '<th scope="col">MobileNo</th>';
            print '<th scope="col">Address</th>';
            print '<th scope="col">SampleCollDate</th>';
            print '<th scope="col">TrueNatDate</th>';            
            print '<th scope="col">SampleNo</th>';
            print '<th scope="col">TrueNatType</th>';
            print '<th scope="col">Result</th>';            
        print '</tr>';
            print '</tfoot>';                           
            print '<tbody>';    
                        while ($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) 
                        {
                           


                            if ($row["TRUE_NAT_RESULT"] == 'DETECTED'){
                                print '<tr class="bg-warning">';
                            }
                            elseif ($row["TRUE_NAT_RESULT"] == 'NOT DETECTED'){
                                print '<tr class="bg-primary">';
                            }
                            else{
                                print '<tr class="bg-active">';
                            }




                            foreach ($row as $item) 
                            {
                                print '<td>'.($item?htmlentities($item):'&nbsp;').'</td>';
                                
                            }
                                print '</tr>';
                            }
                print '</tbody>';            
                print '</table>';
                print '</div>';
        }

        // Create connection to Oracle
        $c = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD");
        $query = "select name, age, gender, mobile_no, address, date_of_sample_coll,
                  date_of_true_nat, lab_sample_no, truenat_type, true_nat_result
                  from covid_true_nat_vw
                  where to_char(date_of_sample_coll,'YYYY-MM-DD') between :EIDBV and :EIDBV1 
                  order by date_of_true_nat";

        $s = oci_parse($c, $query);
        $mystdate = $stdate;
        oci_bind_by_name($s, ":EIDBV", $mystdate);
        $myendate = $endate;
        oci_bind_by_name($s, ":EIDBV1", $myendate);
        // Execute the query
        oci_execute($s);
        // fecth data
        do_fetch($mystdate, $myendate, $s);
        // do_fetch($s);
        // Close the Oracle connection
        oci_close($c);
} 
else 
{
    
}
?> 
<!--
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.bootstrap4.min.js"></script>
-->

<script src="node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>



<script>
$(document).ready(function() {
    $('.mydatatable').DataTable( {
        "scrollY":        "500px",
        "scrollCollapse": true,
        "paging":         false
    } );
} );
</script>  

<!--

<script>  
      $(document).ready(function(){  
        $('.mydatatable').DataTable({
            "scrollY": "300",
            "scrollX": true,
            "scrollCollapse": true,
            "paging": false
        });
      });  
 </script>  
 -->

</body>
</html>