<?php
/*
  This Program displays the counterwise expiry, damage and breakage entry for a fiancual year
  Same program if selected ALL in the counter list displays the consolidated List
*/
    session_start();
?>

<html>
<head>
  <title>Bill: Billing Under Heads</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    

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

     
<!-- Nav Bar for position at the top of page-->  
<nav class="navbar navbar-dark fixed-top bg-warning">
 <a class="navbar-brand" href="bgh_main.php"><img src="sail-logo.jpg" width="40" height="40" alt="BGH-MAIN"></a> 
  <h6>BGH IPD Billing Headwise</h6>
<div class="container">
<form  class="form-inline" name="myform" action="wardbill_headwise_billing_01.php" method="POST"> <input type="hidden" name="check_submit" value="1" />     
  
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
   
        function do_fetch($mystdate, $myendate,  $s)            
            {
                print '<table class="table table-sm table-bordered table-striped table-dark w-auto table-hover">'; 
                print '<thead class="thead-light">';
                print '<tr>'; 
                print '<td colspan="9">' . 'Billing Under Different Heads For Bill Date Between  : ' . date("d-m-Y", strtotime($mystdate)) .  ' and ' . date("d-m-Y", strtotime($myendate)) . '</td>';
                print '</tr>';
                print '<tr>';
                print '<th scope="col">Code</th>';
                print '<th scope="col">Cat Name</th>';
                print '<th scope="col">Drug Total</th>';
                print '<th scope="col">Charge Total</th>';
                print '<th scope="col">Misc. Total</th>';
                print '<th scope="col">Grand Total</th>';            
                print '</thead>';            


// Print the data in Table            
                       while ($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) 
                        {                            
                            print '<tr>';

                            foreach ($row as $item) 
                            { 
//                                if ($row["NAME"]) {
                                    print '<td>'.($item?htmlentities($item):'&nbsp;').'</td>';
//                                }
//                                else{
//                                    print '<td text-align: right>'.($item?htmlentities($item):'&nbsp;').'</td>';
//                                }
                                
                                                                
                            }
                                print '</tr>';
                            }
                print '</table>';
        }
    
    
        // Create connection to Oracle
        $c = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD");
        // Use bind variable to improve resuability, 
        // and to remove SQL Injection attacks.

            
        
  
    
        $query = "select a.hcatno hcatno, b.name name, sum(a.new_drug_total) drug_total, sum(new_charge_total) charges_total, 
                  sum(new_misc_total) misc_total, 
                 (sum(a.new_drug_total)+sum(new_charge_total)+sum(new_misc_total)) grand_total 
                 from wardbill_rgstrpat a, wardbill_catedic b
                 where a.hcatno=b.code and 
                 to_char(a.hbilldt,'YYYY-MM-DD') between :EIDBV and :EIDBV2
                 group by a.hcatno, b.name
                 order by a.hcatno";
    

        $s = oci_parse($c, $query);
    
        $mystdate = $stdate;
        oci_bind_by_name($s, ":EIDBV", $mystdate);
        $myendate = $endate;
        oci_bind_by_name($s, ":EIDBV2", $myendate);    
        oci_execute($s);

 
    
        do_fetch($mystdate, $myendate, $s);
        oci_close($c);

} 
else 
{
    
}
?> 
 
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>  
</body>
</html>