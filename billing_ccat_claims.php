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
    
<nav class="navbar navbar-dark fixed-top bg-primary">
  <h6>Billing: Third Party Claims</h6>
</nav>
<br><br><br>



 <form  name="myform" action="billing_ccat_claims.php" method="POST"> <input type="hidden" name="check_submit" value="1" />     
<form class="form-inline">   
   <div class="form-group row">
      <label for="finyear" class="col-sm-1 col-form-label">Finacial Year</label>
      <div class="col-sm-2">
      <select id="finyear" name="finyear" class="form-control">       
            <?php
          
            $c = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD");
            $sql = "select distinct fin_yr from cat_wise_net_claim order by 1 desc";  
            $stid = oci_parse($c, $sql);  
            $success = oci_execute($stid);
                while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)){
                print '<option> ' . $row["FIN_YR"] . '</option>';
            }  
//          oci_free($stid);  
            oci_close($c);  
        ?>                    
      </select>
      </div>     
            <button type="submit" name="submit" class="btn btn-primary">Get Data....</button>               
    </div>
    </form>
</form>


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
 
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>  
</body>
</html>