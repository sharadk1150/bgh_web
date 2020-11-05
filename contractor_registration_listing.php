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

    label,h6 {
        color:blue;
        text-align: left;
        margin-top: 5px;
        padding: 0px;
        font-weight: bold;
        font-style: normal;        
    }


</style>

    <meta charset=utf-8 />
    <title>Contractor Registration Listing</title>
  </head>
  <body>




<!--<div class="container"> -->

<nav class="navbar navbar-dark fixed-top bg-warning">
 <a class="navbar-brand" href="srm_vendor_main.php"><img src="sail-logo.jpg" width="40" height="40" alt="BGH-MAIN"></a> 
  <h6>SRM-Vendor Activation Listing</h6>
<div class="container">
<form  class="form-inline" name="myform" action="contractor_registration_listing.php" method="POST"> <input type="hidden" name="check_submit" value="1" />     
  
<div class="form-group">  
        <label for="stdate">Received From ERP From Date</label>  
        <input class="form-control mr-sm-2" type="date"   id="stdate" name="stdate" placeholder="Date" aria-label="stdate" value="<?php echo isset($_POST['stdate']) ? $_POST['stdate']:''; ?>">
    </div>     
         
         
    <div class="form-group">  
        <label for="endate">To Date</label>  
        <input class="form-control mr-sm-2" type="date" id="endate" name="endate" placeholder="ToDate"   aria-label="todate" value="<?php echo isset($_POST['endate']) ? $_POST['endate']:''; ?>">
    </div>  
          
    <button class="btn btn-success my-2 my-sm-0" type="submit" name="submit">Get Data...</button>
</form>
</div>
</nav>
<br><br><br>


<?php
if (array_key_exists('check_submit', $_POST)) 
{
  if (isset($_POST['stdate'])){$stdate    =  $_POST['stdate'];}
  if (isset($_POST['endate'])){$endate    =  $_POST['endate'];}
         
        function do_fetch($s)
        {
            print '<table class="table table-hover table-striped table-bordered mydatatable" style="width:100%">'; 
      
            print '<thead>';           
            print '<tr>';
                print '<th scope="col">RegType</th>';
                print '<th scope="col">V-Code</th>';
                print '<th scope="col">PAN-No</th>';            
                print '<th scope="col">Reg-Number</th>';
                print '<th scope="col">EMail</th>';
                print '<th scope="col">Passwd</th>';
                        
            print '</tr>';
            print '</thead>';   

            print '<tfoot>';           
            print '<tr>';
            print '<th scope="col">RegType</th>';
            print '<th scope="col">V-Code</th>';
            print '<th scope="col">PAN-No</th>';            
            print '<th scope="col">Reg-Number</th>';
            print '<th scope="col">EMail</th>';
            print '<th scope="col">Passwd</th>';
                     
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
        $c = oci_connect("CNTR", "CNTR", "10.143.100.249/ORCL");
        // Use bind variable to improve resuability, 
        // and to remove SQL Injection attacks.
        $query = "select reg_type, v_code, pan_no, reg_number, email_id, passwd
                  from cntr_registration";
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

} 
else 
{
    
}
?> 

<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="node_modules/datatables.net/js/jquery.dataTables.min.js"></script>



<script>
$(document).ready(function() {
    $('.mydatatable').DataTable( {
        "scrollY":        "500px",
        "scrollCollapse": true,
        "paging":         false
    } );
} );
</script>  



<!-- </div> -->   
</body>
</html>