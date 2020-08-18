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

     
<nav class="navbar navbar-dark fixed-top bg-warning">
 <a class="navbar-brand" href="bgh_main.php"><img src="sail-logo.jpg" width="40" height="40" alt="BGH-MAIN"></a> 
  <h6>BGH Ward Lab Non Conformity Report</h6>
<div class="container">
<form  class="form-inline" name="myform" action="wardlab_non_conformity_01.php" method="POST"> <input type="hidden" name="check_submit" value="1" />     
  
<div class="form-group">  
        <label for="stdate">From Date</label>  
        <input class="form-control mr-sm-2" type="date"   id="stdate" name="stdate" placeholder="fromDate" aria-label="stdate" value="<?php echo isset($_POST['stdate']) ? $_POST['stdate']:''; ?>">
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
   
        function do_fetch($lab_type, $mystdate, $myendate, $s)            
            {
                print '<table class="table table-sm table-bordered table-striped table-dark w-auto table-hover">'; 
                print '<thead class="thead-light">';
                print '<tr>'; 
                if ($lab_type=='BBN') {
                    print '<td colspan="9">' . 'Non Conformity Report  For Blood Bank : ' . date("d-m-Y", strtotime($mystdate)) .  ' and ' . date("d-m-Y", strtotime($myendate)) . '</td>';
                }
                elseif ($lab_type=='BCHM') {
                    print '<td colspan="9">' . 'Non Conformity Report  For BioChemistry : ' . date("d-m-Y", strtotime($mystdate)) .  ' and ' . date("d-m-Y", strtotime($myendate)) . '</td>';                
                }
                elseif ($lab_type=='PATH') {
                    print '<td colspan="9">' . 'Non Conformity Report  For Pathology : ' . date("d-m-Y", strtotime($mystdate)) .  ' and ' . date("d-m-Y", strtotime($myendate)) . '</td>';                
                }
                elseif ($lab_type=='ROUT') {
                    print '<td colspan="9">' . 'Non Conformity Report  For Urine Routine : ' . date("d-m-Y", strtotime($mystdate)) .  ' and ' . date("d-m-Y", strtotime($myendate)) . '</td>';                
                }
                elseif ($lab_type=='BACT') {
                    print '<td colspan="9">' . 'Non Conformity Report  For Bacteriology : ' . date("d-m-Y", strtotime($mystdate)) .  ' and ' . date("d-m-Y", strtotime($myendate)) . '</td>';                
                }

                print '</tr>';
                print '<tr>';
                print '<th scope="col">Remarks</th>';
                print '<th scope="col">Count</th>';
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
  
        // Variable for Holding the type of Lab
        $lab_type = 'BBN';
        // Blood bank Non Conformity Report    
        $query = "select nvl(test_rmks,'SNR') rmks , count(test_rmks) crmks
                  from wardlab.bgh_wardlab_01_vw 
                  where test_rmks in( select code from wardlab.BGH_LAB_RMKS_DIC where code!='Y') and
                  to_char(sample_dt,'YYYY-MM-DD') between :EIDBV and :EIDBV2
                  group by test_rmks";
    
        $s = oci_parse($c, $query);
    
        $mystdate = $stdate;
        oci_bind_by_name($s, ":EIDBV", $mystdate);
        $myendate = $endate;
        oci_bind_by_name($s, ":EIDBV2", $myendate);    
        oci_execute($s); 
    
        do_fetch($lab_type, $mystdate, $myendate, $s);
        
// For BioChemistry
        $lab_type = 'BCHM';
        $query = "select nvl(test_rmks,'SNR') rmks , count(test_rmks) crmks
        from wardlab.bgh_wardlab_02_vw 
        where test_rmks in( select code from wardlab.BGH_LAB_RMKS_DIC where code!='Y') and 
        to_char(sample_dt,'YYYY-MM-DD') between :EIDBV and :EIDBV2
        group by test_rmks";

        $s = oci_parse($c, $query);

        $mystdate = $stdate;
        oci_bind_by_name($s, ":EIDBV", $mystdate);
        $myendate = $endate;
        oci_bind_by_name($s, ":EIDBV2", $myendate);    
        oci_execute($s); 
        do_fetch($lab_type, $mystdate, $myendate, $s);
               
        // For Pathology
        $lab_type = 'PATH';
        $query = "select nvl(test_rmks,'SNR') rmks , count(test_rmks) crmks
        from wardlab.bgh_wardlab_03_vw 
        where test_rmks in( select code from wardlab.BGH_LAB_RMKS_DIC where code!='Y') and 
        to_char(sample_dt,'YYYY-MM-DD') between :EIDBV and :EIDBV2
        group by test_rmks";

        $s = oci_parse($c, $query);

        $mystdate = $stdate;
        oci_bind_by_name($s, ":EIDBV", $mystdate);
        $myendate = $endate;
        oci_bind_by_name($s, ":EIDBV2", $myendate);    
        oci_execute($s); 
        do_fetch($lab_type, $mystdate, $myendate, $s);

        // For Urine Routine
        $lab_type = 'ROUT';
        $query = "select nvl(test_rmks,'SNR') rmks , count(test_rmks) crmks
        from wardlab.bgh_wardlab_10_vw 
        where
        test_rmks in( select code from wardlab.BGH_LAB_RMKS_DIC where code!='Y') and
        to_char(sample_dt,'YYYY-MM-DD') between :EIDBV and :EIDBV2
        group by test_rmks";

        $s = oci_parse($c, $query);

        $mystdate = $stdate;
        oci_bind_by_name($s, ":EIDBV", $mystdate);
        $myendate = $endate;
        oci_bind_by_name($s, ":EIDBV2", $myendate);    
        oci_execute($s); 
        do_fetch($lab_type, $mystdate, $myendate, $s);

        // For Urine Routine
        $lab_type = 'BACT';
        $query = "select nvl(test_rmks,'SNR') rmks , count(test_rmks) crmks
        from wardlab.bgh_wardlab_04_vw 
        where
        test_rmks in( select code from wardlab.BGH_LAB_RMKS_DIC where code!='Y') and
        to_char(sample_dt,'YYYY-MM-DD') between :EIDBV and :EIDBV2
        group by test_rmks";

        $s = oci_parse($c, $query);

        $mystdate = $stdate;
        oci_bind_by_name($s, ":EIDBV", $mystdate);
        $myendate = $endate;
        oci_bind_by_name($s, ":EIDBV2", $myendate);    
        oci_execute($s); 
        do_fetch($lab_type, $mystdate, $myendate, $s);

        
        
// Close the connection        
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