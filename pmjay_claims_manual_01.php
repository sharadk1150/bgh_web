<?php
/*
  This Program displays the counterwise expiry, damage and breakage entry for a fiancual year
  Same program if selected ALL in the counter list displays the consolidated List
*/
    session_start();
?>

<html>
<head>
  <title>PMJAY: Claims & Receipts</title>
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
<div class="container">
<nav class="navbar navbar-dark fixed-top" style="background-color: bisque; height:50px; position: absolute;">
<form  class="form-inline" name="myform" action="pmjay_claims_manual_01.php" method="POST"> <input type="hidden" name="check_submit" value="1" />     
                           
      <div class="form-group">
      <label for="fyyr">For Financial Year:</label>
      <select id="fyyr" name="fyyr" class="form-control mr-sm-2">       
      <?php
          
            $c = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD");
            $sql = "select fy_yr from ward_fyyr order  by 1 desc";  
            echo $sql;
            $stid = oci_parse($c, $sql);  
            $success = oci_execute($stid);
                while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)){
                print '<option> ' . $row["FY_YR"] . '</option>';
            }  
            oci_close($c);  
      ?>                    
      </select>
      </div>        
        <button class="btn btn-success my-2 my-sm-0" type="submit" name="submit">Get Data...</button>
    </form>
</nav>
</div>    
<!-- Nav Bar for position at the top of page-->      


<br><br><br>

<?php
if (array_key_exists('check_submit', $_POST)) 
{
    
                if (isset($_POST['fyyr'])){$fyyr    =  $_POST['fyyr'];}
    
        function do_fetch($myfinyr,   $s)            
            {
                print '<table class="table table-sm table-bordered table-striped table-dark w-auto table-hover">';            
                print '<thead class="thead-light">';
                print '<tr>'; 
                print '<td colspan="9">' . 'PMJAY Claims and Receipts  For : ' . $myfinyr . '</td>';
                print '</tr>';
                print '<tr>';
                print '<th scope="col">FinYr</th>';
                print '<th scope="col">FromMonth</th>';
                print '<th scope="col">ToMonth</th>';
                print '<th scope="col">Claims</th>';
                print '<th scope="col">Receipt Amount (Rs.)</th>';


                print '</thead>';
            
                        $tot_claims=0;
                        $tot_rec=0;
// Print the data in Table            
                        while ($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) 
                        {      
                            $tot_claims = $tot_claims + $row["NO_OF_CLAIM"];                      
                            $tot_rec    = $tot_rec    + $row["CLAIM_AMT"];                      
                            print '<tr>';

                            foreach ($row as $item) 
                            { 
                                
                                print '<td>'.($item?htmlentities($item):'&nbsp;').'</td>';
                                                                
                            }
                                print '</tr>';
                            }
                            Print '<tr>';
                                    print '<td colspan="3">' . 'Totals' . '</td>';
                                    print '<td>' . $tot_claims . '</td>';
                                    print '<td>' . $tot_rec . '</td>';
                            print '</tr'>

                print '</table>';
        }
    
    
        // Create connection to Oracle
        $c = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD");
        // Use bind variable to improve resuability, 
        // and to remove SQL Injection attacks.

    
        $query = "select fin_yr, from_month, to_month, no_of_claim, claim_amt 
                 from pmjay_claims_manual 
                  where fin_yr=:EIDBV
                  order by 1";
    
//        $qcount = "select sum(tot_rate) TOT_VALUE from BGH_MED_STOCK_ISSUE_VW 
//        where  ctrno = '20' and to_char(issue_dt,'YYYY-MM-DD') between :EIDBV and :EIDBV2";
    
        $s = oci_parse($c, $query);
//        $scount = oci_parse($c, $qcount);
    
        $myfinyr = $fyyr;
        oci_bind_by_name($s, ":EIDBV", $myfinyr);
//        oci_bind_by_name($scount, ":EIDBV", $myeid);
    
        
//        $mylab = $lab;
//        oci_bind_by_name($s, ":EIDBV2", $mylab);
//        oci_bind_by_name($scount, ":EIDBV2", $myendt);
    
        oci_execute($s);
//        oci_execute($scount);
    
/*   
        while ($row_1 = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) {
            echo $row_1[0] . $row_1[1]. "<br>\n";
              echo $row_1["tot_value"];
        }
*/        
    
        do_fetch($myfinyr, $s);
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