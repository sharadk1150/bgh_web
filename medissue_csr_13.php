<?php
/*
  This Program take scare of the Medicine Issued from Counter 20 for CSR Sarwa Swasthya Kendra
*/
    session_start();
?>

<html>
<head>
  <title>Medicne Issued For CSR: Medical Camps </title>
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
  <h6> Medicine Issued to CSR for Medical Camps (Counter:13)</h6>
</nav>
<br><br><br>
<form  name="myform" action="medissue_csr_20.php" method="POST">
                <input type="hidden" name="check_submit" value="1" />
    <form class="form-inline">   
        <div class="form-group row">
            <label for="stdate" class="col-sm-1 col-form-label">From Date</label> 
                <div class="col-sm-2">
                    <input type="date" class="form-control" id="stdate" name="stdate">
                </div>    
                   
            <label for="endate" class="col-sm-1 col-form-label">To Date</label> 
                <div class="col-sm-2">
                    <input type="date" class="form-control" id="endate" name="endate">
                </div>    
                   
                    <button type="submit" name="submit" class="btn btn-primary">Get Data....</button>               
        </div>
    </form>            
  </form>


<?php
if (array_key_exists('check_submit', $_POST)) 
{
                $stdate =  $_POST['stdate'];
                $endate =  $_POST['endate'];
    
        function do_fetch($myeid, $myendt,  $s, $scount)            
            {
                print '<table class="table table-sm table-bordered table-striped table-dark w-auto table-hover">';            
                print '<thead class="thead-light">';
                print '<tr>'; 
                print '<td colspan="9">' . 'Medicine Issued From Date : ' . $myeid .  '  To Date : ' . $myendt . '</td>';
                print '</tr>';
                print '<tr>';
                print '<th scope="col">Cat No</th>';
                print '<th scope="col">Med Name</th>';
                print '<th scope="col">Total Issue (Qty)</th>';
                print '<th scope="col">Total Value (Rs.)</th>';   
                print '</tr>';
                print '</thead>';
            
// print the total value of the medicine issued to the CSR Counter  
                print '<tr>';
                while ($row_1 = oci_fetch_array($scount, OCI_RETURN_NULLS+OCI_ASSOC)) 
                {            
                    print '<b>' . 'Total Value of Medicine Issued to CSR HC-5 is Rs.: ' . $row_1["TOT_VALUE"] . '</b>';
                    
                }                        
                print '</tr>';

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
    
        $query = "select old_cat_no, med_desc, sum(issue_qty) tot_issue, sum(tot_rate) tot_value 
        from BGH_MED_STOCK_ISSUE_VW 
        where ctrno = '20' and to_char(issue_dt,'YYYY-MM-DD') between :EIDBV and :EIDBV2 
        group by  old_cat_no, med_desc order by med_desc";
    
        $qcount = "select sum(tot_rate) TOT_VALUE from BGH_MED_STOCK_ISSUE_VW 
        where  ctrno = '20' and to_char(issue_dt,'YYYY-MM-DD') between :EIDBV and :EIDBV2";
    
        $s = oci_parse($c, $query);
        $scount = oci_parse($c, $qcount);
    
        $myeid = $stdate;
        oci_bind_by_name($s, ":EIDBV", $myeid);
        oci_bind_by_name($scount, ":EIDBV", $myeid);
    
        
        $myendt = $endate;
        oci_bind_by_name($s, ":EIDBV2", $myendt);
        oci_bind_by_name($scount, ":EIDBV2", $myendt);
    
        oci_execute($s);
        oci_execute($scount);
    
/*   
        while ($row_1 = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) {
            echo $row_1[0] . $row_1[1]. "<br>\n";
              echo $row_1["tot_value"];
        }
*/        
    
        do_fetch($myeid, $myendt,  $s, $scount);
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