<!DOCTYPE html>
<html>
  <head>
      
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

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
    <title>Mediclaim: Admission To Billing Status</title>
  </head>
  <body>

<!-- Nav Bar for position at the top of page-->  
<nav class="navbar navbar-dark fixed-top bg-warning">
 <a class="navbar-brand" href="bgh_main.php"><img src="sail-logo.jpg" width="40" height="40" alt="BGH-MAIN"></a> 
  <h6>BGH Mediclaim Billing Tracking</h6>
<div class="container">
<form  class="form-inline" name="myform" action="mediclaim_admtobill_status.php" method="POST"> <input type="hidden" name="check_submit" value="1" />     
  
    <div class="form-group">  
        <label for="stdate">Bill From Date</label>  
        <input class="form-control mr-sm-2" type="date"   id="stdate" name="stdate" placeholder="fromDate" aria-label="stdate" value="<?php echo isset($_POST['stdate']) ? $_POST['stdate']:''; ?>">
    </div>     
                  
    <div class="form-group">  
        <label for="endate">Bill To Date</label>  
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
         

        function do_fetch($mystdate, $myendate, $s)
        {            
            print '<div class="table-responsive">';
            print '<table class="table table-hover table-striped table-bordered mydatatable" style="width:100%">';            
            print '<p id="billnotmade"></p>';
            print '<thead>';           
            print '<tr>';
                print '<th scope="col">MinNo</th>';
                print '<th scope="col">Hospno</th>';               
                print '<th scope="col">PatName</th>';            
                print '<th scope="col">Age</th>';
                print '<th scope="col">Unit</th>';
                print '<th scope="col">AdmDate</th>';
                print '<th scope="col">AdmTm</th>';            
                print '<th scope="col">DisDt</th>';
                print '<th scope="col">DisTm</th>';
                print '<th scope="col">HbillNo</th>';            
                print '<th scope="col">Billdt</th>';            
                print '<th scope="col">DisToBill</th>';            
                print '<th scope="col">BillTotal</th>';            
            print '</tr>';
            print '</thead>';   
            print '<tfoot>';           
            print '<tr>';
            print '<th scope="col">MinNo</th>';
            print '<th scope="col">Hospno</th>';            
            print '<th scope="col">PatName</th>';            
            print '<th scope="col">Age</th>';
            print '<th scope="col">Unit</th>';
            print '<th scope="col">AdmDate</th>';
            print '<th scope="col">AdmTm</th>';            
            print '<th scope="col">DisDt</th>';
            print '<th scope="col">DisTm</th>';
            print '<th scope="col">HbillNo</th>';            
            print '<th scope="col">Billdt</th>';            
            print '<th scope="col">DisToBill</th>';            
            print '<th scope="col">BillTotal</th>';            
            print '</tr>';
            print '</tfoot>';                           
            print '<tbody>';    
                        while ($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) 
                        {
                           


                            if ($row["HBILLNO"] == NULL){
                                print '<tr class="bg-primary">';
                            }
                            elseif ($row["DIS_TO_BILL"]>7){
                                print '<tr class="bg-warning">';
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
        $query = "select stno, (hospno||'/'||hospyr) hospno, patname, age,unit,
        admdate, admtime, bdisdt, bdistm, hbillno, bbilldt,
                   dis_to_bill, bill_grand_total
                  from MEDICLAIM_ADM_REL_BILL_VW
                  where to_char(admdate,'YYYY-MM-DD') between :EIDBV and :EIDBV1 order by hospno";
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

<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.bootstrap4.min.js"></script>


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
</body>
</html>