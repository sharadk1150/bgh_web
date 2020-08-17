<?php
/*
  This Program displays the counterwise expiry, damage and breakage entry for a fiancual year
  Same program if selected ALL in the counter list displays the consolidated List
*/
    session_start();
?>

<html>
<head>
  <title>Billing Third Party Billing Claims and Receipt</title>
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">

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
    
<nav class="navbar navbar-dark fixed-top bg-warning">
 <a class="navbar-brand" href="bgh_main.php"><img src="sail-logo.jpg" width="40" height="40" alt="BGH-MAIN"></a> 
  <h6>BGH IPD Claims on Third Party</h6>
<div class="container">
    <form  class="form-inline" name="myform" action="billing_ccat_claims.php" method="POST"> <input type="hidden" name="check_submit" value="1" />     
        <div class="form-group row">
            <label for="finyear" class="col-sm-3 col-form-label">Finacial Year</label>
        <div class="col-sm-4">
            <select id="finyear" name="finyear" class="form-control">       
                <?php          
                    $c = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD");
                    $sql = "select distinct fin_yr from cat_wise_net_claim order by 1 desc";  
                    $stid = oci_parse($c, $sql);  
                    $success = oci_execute($stid);
                        while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)){
                        print '<option> ' . $row["FIN_YR"] . '</option>';
                        }  
                        oci_close($c);  
                ?>                    
            </select>
      </div>     
            <button type="submit" name="submit" class="btn btn-primary">Get Data....</button>               
    </div>
    </form>
    </nav>
<br><br><br>

<?php
if (array_key_exists('check_submit', $_POST)) 
{
                $finyear =  $_POST['finyear'];
//                $ctrno   =  $_POST['ctrno'];
    
        function do_fetch($myfinyr,  $s)            
            {
                print '<table class="table table-sm table-bordered table-striped table-dark w-auto table-hover">';            
                print '<thead class="thead-light">';
                print '<tr>'; 
                print '<td colspan="9">' . 'Third Party Billing For  : ' . $myfinyr .  '</td>';
                print '</tr>';
                print '<tr>';
                print '<th scope="col">FinYr</th>';
                print '<th scope="col">PartyName</th>';
                print '<th scope="col">NumBills</th>';
                print '<th scope="col">NetClaim</th>';   
                print '<th scope="col">AmtReceived</th>';               
                print '</tr>';
                print '</thead>';
            

// Print the data in Table            
                        while ($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) 
                        {                            
                            print '<tr>';

                            foreach ($row as $item) 
                            { 
                                
                                print '<td>'.($item?htmlentities($item):'&nbsp;').'</td>';
                                                                
                            }
                                print '</tr>';
                            }
                print '</table>';
        }
    
    
        // Create connection to Oracle
        $c = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD");
        // Use bind variable to improve resuability, 
        // and to remove SQL Injection attacks.
    
        $query = "select fin_yr, cat_name, no_of_bills_made num_bills, net_claim, amt_received 
                  from cat_wise_net_claim where fin_yr=:EIDBV order by 1";
    
//        $qcount = "select sum(tot_rate) TOT_VALUE from BGH_MED_STOCK_ISSUE_VW 
//        where  ctrno = '20' and to_char(issue_dt,'YYYY-MM-DD') between :EIDBV and :EIDBV2";
    
        $s = oci_parse($c, $query);
//        $scount = oci_parse($c, $qcount);
    
        $myfinyr = $finyear;
        oci_bind_by_name($s, ":EIDBV", $myfinyr);
//        oci_bind_by_name($scount, ":EIDBV", $myeid);
    
        
//        $myctrno = $ctrno;
//        oci_bind_by_name($s, ":EIDBV2", $myctrno);
//        oci_bind_by_name($scount, ":EIDBV2", $myendt);
    
        oci_execute($s);
//        oci_execute($scount);
    
/*   
        while ($row_1 = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) {
            echo $row_1[0] . $row_1[1]. "<br>\n";
              echo $row_1["tot_value"];
        }
*/        
    
        do_fetch($myfinyr,  $s);
        oci_close($c);

} 
else 
{
    
}
?> 
<script src="node_modules/jquery/dist/jquery.min.js"></script>
<script src="node_modules/popper.js/dist/popper.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script></head>
</body>
</html>