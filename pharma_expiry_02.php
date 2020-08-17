<?php
/*
  This Program displays the counterwise expiry, damage and breakage entry for a fiancual year
  Same program if selected ALL in the counter list displays the consolidated List
*/
    session_start();
?>

<html>
<head>
  <title>Pharma: Counter Wise Expiry, Damage, Breakage </title>
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
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
  <h6> Pharma: Counter Wise Expiry, Damage, Breakage</h6>
</nav>
<br><br><br>



 <form  name="myform" action="pharma_expiry_02.php" method="POST"> <input type="hidden" name="check_submit" value="1" />
 
 <!-- print '<form  name="myform" action=' . $_SERVER['PHP_SELF'].  ' method="POST"> <input type="hidden" name="check_submit" value="1" />'; -->
     
<form class="form-inline">   
 
   <div class="form-group row">
      <label for="finyear" class="col-sm-1 col-form-label">Finacial Year</label>
      <div class="col-sm-2">
      <select id="finyear" name="finyear" class="form-control">
       
    <?php
          
        $c = oci_connect("BGH", "hpv185e", "10.143.100.36/BGH6");
        $sql = "select distinct fin_year from bgh_pharma_expiry_vw order by fin_year desc";  
        $stid = oci_parse($c, $sql);  
        $success = oci_execute($stid);
        while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)){
            print '<option> ' . $row["FIN_YEAR"] . '</option>';
        }  
         oci_close($c);  
    ?>      
       
       
      </select>
      </div>
     
      <label for="ctrno" class="col-sm-1 col-form-label">Counter No</label>
      <div class="col-sm-2">
      <select id="ctrno" name="ctrno" class="form-control">

    <?php                  
        $c = oci_connect("BGH", "hpv185e", "10.143.100.36/BGH6");
        $sql = "select 'ALL COUNTERS' CTRNO from DUAL";  
        $stid = oci_parse($c, $sql);  
        $success = oci_execute($stid);
        while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)){
            print '<option> ' . $row["CTRNO"] . '</option>';
        }  
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
                $ctrno   =  $_POST['ctrno'];
    
        function do_fetch($myfinyr, $myctrno,  $s)            
            {
                print '<table class="table table-sm table-bordered table-striped table-dark w-auto table-hover">';            
                print '<thead class="thead-light">';
                print '<tr>'; 
                print '<td colspan="9">' . 'Expiry Medicine in  : ' . $myfinyr .  '  Consolidated for All Counters </td>';
                print '</tr>';
                print '<tr>';
                print '<th scope="col">Med Name</th>';
                print '<th scope="col">Damage</th>';
                print '<th scope="col">Breakage</th>';
                print '<th scope="col">Expiry</th>';   
                print '<th scope="col">FinYr</th>';               
                print '</tr>';
                print '</thead>';
            
// print the total value of the medicine issued to the CSR Counter  
//                print '<tr>';
//                while ($row_1 = oci_fetch_array($scount, OCI_RETURN_NULLS+OCI_ASSOC)) 
//                {            
//                    print '<b>' . 'Total Value of Medicine Issued to CSR HC-5 is Rs.: ' . $row_1["TOT_VALUE"] . '</b>';
                    
//                }                        
//                print '</tr>';

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
        $c = oci_connect("BGH", "hpv185e", "10.143.100.36/BGH6");
        // Use bind variable to improve resuability, 
        // and to remove SQL Injection attacks.
    
        $query = "select med_desc, sum(dmg) dmg, sum(bkg) bkg, sum(exp), fin_year from bgh_pharma_expiry_vw
                  where fin_year=:EIDBV group by med_desc, fin_year
                  order by med_desc";
    
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
    
        do_fetch($myfinyr, $myctrno,  $s);
        oci_close($c);

} 
else 
{
    
}
?> 
<script src="node_modules/jquery/dist/jquery.min.js"></script>
<script src="node_modules/popper.js/dist/popper.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script></body>
</html>