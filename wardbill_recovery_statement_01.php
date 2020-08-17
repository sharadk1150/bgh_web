<?php
/*
  This Program displays the counterwise expiry, damage and breakage entry for a fiancual year
  Same program if selected ALL in the counter list displays the consolidated List
*/
    session_start();
?>

<html>
<head>
  <title>WARD Bill: Receovery Statement for Guarantorship</title>
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

     
<!-- Nav Bar for position at the top of page-->  
<nav class="navbar navbar-dark fixed-top bg-warning">
 <a class="navbar-brand" href="bgh_main.php"><img src="sail-logo.jpg" width="40" height="40" alt="BGH-MAIN"></a> 
  <h6>BGH IPD Guarantor Recovery Statement</h6>
<div class="container">
<form  class="form-inline" name="myform" action="wardbill_recovery_statement_01.php" method="POST"> <input type="hidden" name="check_submit" value="1" />     
  
   <div class="form-group">         
      <label for="year">Year For Recovery Statement:</label>
      <select id="year" name="year" class="form-control mr-sm-2">       
            <?php

            $c = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD");
            $sql = "select year from q_year order by to_number(year) desc";  
            $stid = oci_parse($c, $sql);  
            $success = oci_execute($stid);          
                while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)){
                print '<option> ' . $row["YEAR"] . '</option>';
            }  
            oci_close($c);            
          ?>                    
      </select>
      </div>                          
      
      
      <div class="form-group">
      <label for="month">For Month:</label>
      <select id="month" name="month" class="form-control mr-sm-2">       
      <?php
          
            $c = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD");
            $sql = "select month from q_month order  by 1 desc";  
            echo $sql;
            $stid = oci_parse($c, $sql);  
            $success = oci_execute($stid);
                while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)){
                print '<option> ' . $row["MONTH"] . '</option>';
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
    
                if (isset($_POST['year'])){$year      =  $_POST['year'];}
                if (isset($_POST['month'])){$month    =  $_POST['month'];}
    
        function do_fetch($myyr, $mymonth,  $s)            
            {
                print '<table class="table table-sm table-bordered table-striped table-dark w-auto table-hover">';            
                print '<thead class="thead-light">';
                print '<tr>'; 
                print '<td colspan="9">' . 'Recovery Statement For Month : ' . $mymonth .  ' and Year  ' . $myyr . '</td>';
                print '</tr>';
                print '<tr>';
                print '<th scope="col">StaffNo</th>';
                print '<th scope="col">HospNo Desc</th>';
                print '<th scope="col">BillNo</th>';
                print '<th scope="col">BillDt</th>';
                print '<th scope="col">MMYr</th>';
                print '<th scope="col">HospCg</th>';
                print '<th scope="col">BillAmount (Rs.)</th>';
            

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
    
        //form the table name
        $myyr    = $year;
        $mymonth = $month;
        $tname = 'ward_recovery_view_' . $mymonth.$myyr;
        
        // Create connection to Oracle
        $c = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD");
        // Use bind variable to improve resuability, 
        // and to remove SQL Injection attacks.

        
    
        $query = "select staffno, hospital_no, bill_no, updated_bill_dt, mmyear, hospcg, bill_balance
                  from " . $tname . " order by 1";
    
//        $qcount = "select sum(tot_rate) TOT_VALUE from BGH_MED_STOCK_ISSUE_VW 
//        where  ctrno = '20' and to_char(issue_dt,'YYYY-MM-DD') between :EIDBV and :EIDBV2";
    
        $s = oci_parse($c, $query);
//        $scount = oci_parse($c, $qcount);
    
       
//        oci_bind_by_name($s, ":EIDBV", $myfinyr);
//        oci_bind_by_name($scount, ":EIDBV", $myeid);
    
        
        
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
    
        do_fetch($myyr, $mymonth,  $s);
        oci_close($c);

} 
else 
{
    
}
?> 
 
<script src="node_modules/jquery/dist/jquery.min.js"></script>
<script src="node_modules/popper.js/dist/popper.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>