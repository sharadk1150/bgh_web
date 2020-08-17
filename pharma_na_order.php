<?php
    session_start();
?>

<html>
<head>
  <title>Pharma: NA Medicines</title>
<link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="DataTables/datatables.min.css" rel="stylesheet" type="text/css" />
<script src="node_modules/jquery/dist/jquery.min.js"></script>
<script src="node_modules/popper.js/dist/popper.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
</head>
<body>

<?php          
         $login_name = $_SESSION["login"];        
        if (!isset($_SESSION["loggedIn"]))
        {  
            header('Location:/login_bgh.php'); 
        }
        else
        {
            ;            
        }
?>
    
<!-- <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
.navbar-expand{-sm|-md|-lg|-xl}
-->
 
<nav class="navbar navbar-dark fixed-top bg-warning">
 <a class="navbar-brand" href="bgh_main.php"><img src="sail-logo.jpg" width="40" height="40" alt="BGH-MAIN"></a> 
  <h6>BGH NA Medicines</h6>
<div class="container">
<form  class="form-inline" name="myform" action="pharma_na_order.php" method="POST"> <input type="hidden" name="check_submit" value="1" />     
  
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
    global $gtotal;
    $gtotal =0;        
if (array_key_exists('check_submit', $_POST)) 
{
            $stdate =  $_POST['stdate'];
            $endate =  $_POST['endate'];                
        function do_fetch($myeid, $myendt, $s)
        {
//              date("d/m/Y", strtotime($str));
             
//                print '<table class="table table-sm table-bordered table-striped table-dark w-auto table-hover">';    
                print '<table class="table table-hover table-striped table-bordered mydatatable" style="width:100%">'; 

                print '<thead class="thead-light">';
                print '<tr>'; 
                print '<td colspan="9">' . 'NA Medicines From : ' . date("d-m-Y", strtotime($myeid)) .  '  To Date : ' . date("d-m-Y", strtotime($myendt)) . '</td>';
                print '</tr>';
                print '<tr>';
                print '<th scope="col">Drug Code</th>';            
                print '<th scope="col">Med Name</th>';
                print '<th scope="col">Unit</th>';
                print '<th scope="col">Quantity</th>';
                print '</tr>';
                print '</thead>';                          
                        $x = 0;
                        while ($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) 
                        {
                            $x = $x + 1;
                            if ($x%2==0) {
                                print '<tr class="bg-primary">';}
                            else {
                                print '<tr class="bg-information">';}                                                            
                            foreach ($row as $item) 
                            {                                
                                print '<td>'.($item?htmlentities($item):'&nbsp;').'</td>';
                                                                
                            }
                                print '</tr>';
                            }
            print '</table>';
            print '<br>';
        }
   
  
    
        // Create connection to Oracle
        $c = oci_connect("BGH", "hpv185e", "10.143.100.36/BGH6"); 
        $query = "select substr(old_cat_no,7,11) drug_code, med_name, unit, sum(total) total
                  from BGH_OPD_LP_DRUGS
                  where to_char(na_date,'YYYY-MM-DD') between :EIDBV and :EIDBV2 
                  group by old_cat_no, med_name, unit
                  order by 4 desc";
    
    
        $s = oci_parse($c, $query);    
        $myeid = $stdate;
        oci_bind_by_name($s, ":EIDBV", $myeid);
    
        
        $myendt = $endate;
        oci_bind_by_name($s,":EIDBV2", $myendt);
 
       
    
        oci_execute($s);
        do_fetch($myeid, $myendt, $s);
        oci_close($c);

} 
else 
{
    
}
?> 

 
<!-- 
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>  
-->

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


</body>
</html>