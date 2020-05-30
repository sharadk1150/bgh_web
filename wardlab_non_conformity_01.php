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
<div class="container">
<nav class="navbar navbar-dark fixed-top" style="background-color: bisque; height:50px; position: absolute;">
<form  class="form-inline" name="myform" action="wardlab_non_conformity_01.php" method="POST"> <input type="hidden" name="check_submit" value="1" />     
  
<div class="form-group">  
        <label for="stdate">Ward Lab Non-Conformity Report From Start  Date </label>  
        <input class="form-control mr-sm-2" type="date"   id="stdate" name="stdate" placeholder="fromDate" aria-label="stdate" value="<?php echo isset($_POST['stdate']) ? $_POST['stdate']:''; ?>">
    </div>
     
         
    <div class="form-group">  
        <label for="enddt">To End Date </label>  
        <input class="form-control mr-sm-2" type="date" id="endate" name="endate" placeholder="ToDate"   aria-label="todate" value="<?php echo isset($_POST['endate']) ? $_POST['endate']:''; ?>">
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
 
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>  
</body>
</html>