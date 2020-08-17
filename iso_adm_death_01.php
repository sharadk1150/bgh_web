<?php
/*
  This Program displays the counterwise expiry, damage and breakage entry for a fiancual year
  Same program if selected ALL in the counter list displays the consolidated List
*/
    session_start();
?>

<html>
<head>
  <title>ISO: Admission and Death Data</title>
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
<div class="container">
<nav class="navbar navbar-dark fixed-top" style="background-color: bisque; height:50px; position: absolute;">
<form  class="form-inline" name="myform" action="iso_adm_death_01.php" method="POST"> <input type="hidden" name="check_submit" value="1" />     
  
<div class="form-group">  
        <label for="stdate">Start Date </label>  
        <input class="form-control mr-sm-2" type="date"   id="stdate" name="stdate" placeholder="fromDate" aria-label="stdate" value="<?php echo isset($_POST['stdate']) ? $_POST['stdate']:''; ?>">
    </div>
     
         
    <div class="form-group">  
        <label for="enddt">End Date </label>  
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
   
        function do_fetch($mystdate, $myendate, $tot_ent, $tot_nonent, $tot_ent_death, $tot_nent_death, $tot_pmjay, $tot_pmjay_death,  $s)            
            {
                print '<table class="table table-sm table-bordered table-striped table-dark w-auto table-hover">'; 
                print '<thead class="thead-light">';
                print '<tr>'; 
                print '<td colspan="9">' . 'Admission and Death Between  : ' . date("d-m-Y", strtotime($mystdate)) .  ' and ' . date("d-m-Y", strtotime($myendate)) . '</td>';
                print '</tr>';
                print '<tr>';
                print '<th scope="col">Type</th>';
                print '<th scope="col">Total Admission</th>';
                print '<th scope="col">Total Death</th>';
                print '</thead>';            
                print '<tr>';
                        print '<td>' . 'Entitled' . '</td>';
                        print '<td>' .$tot_ent . '</td>';
                        print '<td>' .$tot_ent_death . '</td>';
                print '</tr>';
                print '<tr>';
                        print '<td>' . 'Non-Entitled' . '</td>';
                        print '<td>' .$tot_nonent . '</td>';
                        print '<td>' .$tot_nent_death . '</td>';
                print '</tr>';
                print '<tr>';
                        print '<td>' . 'PMJAY' . '</td>';
                        print '<td>' .$tot_pmjay . '</td>';
                        print '<td>' .$tot_pmjay_death . '</td>';
                print '</tr>';
                print '<tr>';
                        print '<td>' . 'TOTAL' . '</td>';
                        print '<td>' . ($tot_ent+$tot_nonent+$tot_pmjay) . '</td>';
                        print '<td>' . ($tot_ent_death+$tot_nent_death+$tot_pmjay_death) . '</td>';
                print '</tr>';


            
                print '</table>';            


// Print the data in Table            
//                        while ($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) 
//                        {                            
//                            print '<tr>';
//
//                            foreach ($row as $item) 
//                            { 
//                                
//                                print '<td>'.($item?htmlentities($item):'&nbsp;').'</td>';
//                                                                
//                            }
//                                print '</tr>';
//                            }
//                print '</table>';
        }
    
    
        // Create connection to Oracle
        $c = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD");
        // Use bind variable to improve resuability, 
        // and to remove SQL Injection attacks.

  
    
        $query = "select count(ent_nonent) tot_ent 
                  from ward_admission_vw
                  where ent_nonent='Y'
                  and to_char(admdate,'YYYY-MM-DD') between :EIDBV and :EIDBV2
                  group by ent_nonent";
    
        $neadm = "select count(ent_nonent) tot_nonent 
                  from ward_admission_vw
                  where ent_nonent='N'
                  and to_char(admdate,'YYYY-MM-DD') between :EIDBV and :EIDBV2
                  group by ent_nonent";

        $pmjay = "select count(ent_nonent) tot_pmjay 
                  from ward_admission_vw
                  where ent_nonent='P'
                  and to_char(admdate,'YYYY-MM-DD') between :EIDBV and :EIDBV2
                  group by ent_nonent";

        $endeath = "select count(ent) tot_ent_death 
                  from WARD_STAT_DEATH_VIEW
                  where ent='Y'
                  and to_char(death_dt,'YYYY-MM-DD') between :EIDBV and :EIDBV2
                  group by ent";

        $nendeath = "select count(ent) tot_nent_death 
                  from WARD_STAT_DEATH_VIEW
                  where ent='N'
                  and to_char(death_dt,'YYYY-MM-DD') between :EIDBV and :EIDBV2
                  group by ent";

        $pmjaydeath = "select nvl(count(ent),0) tot_pmjay_death 
                  from WARD_STAT_DEATH_VIEW
                  where ent='P'
                  and to_char(death_dt,'YYYY-MM-DD') between :EIDBV and :EIDBV2
                  group by ent";
    
        $s = oci_parse($c, $query);
        oci_define_by_name($s, 'TOT_ENT', $tot_ent);    
        $mystdate = $stdate;
        oci_bind_by_name($s, ":EIDBV", $mystdate);
        $myendate = $endate;
        oci_bind_by_name($s, ":EIDBV2", $myendate);    
        oci_execute($s);
        oci_fetch($s); 
//      echo "Total Entitled:" . $tot_ent ."\n";
        oci_free_statement($s);

        $s = oci_parse($c, $neadm);
        oci_define_by_name($s, 'TOT_NONENT', $tot_nonent);
        $mystdate = $stdate;
        oci_bind_by_name($s, ":EIDBV", $mystdate);
        $myendate = $endate;
        oci_bind_by_name($s, ":EIDBV2", $myendate);        
        oci_execute($s);
        oci_fetch($s); 
//      echo "Total Entitled:" . $tot_nonent ."\n";
        oci_free_statement($s);
    
        $s = oci_parse($c, $endeath);
        oci_define_by_name($s, 'TOT_ENT_DEATH', $tot_ent_death);
        $mystdate = $stdate;
        oci_bind_by_name($s, ":EIDBV", $mystdate);
        $myendate = $endate;
        oci_bind_by_name($s, ":EIDBV2", $myendate);        
        oci_execute($s);
        oci_fetch($s); 
//      echo "Total Entitled Death:" . $tot_ent_death ."\n";
        oci_free_statement($s);
    
        $s = oci_parse($c, $nendeath);
        oci_define_by_name($s, 'TOT_NENT_DEATH', $tot_nent_death);
        $mystdate = $stdate;
        oci_bind_by_name($s, ":EIDBV", $mystdate);
        $myendate = $endate;
        oci_bind_by_name($s, ":EIDBV2", $myendate);        
        oci_execute($s);
        oci_fetch($s); 
//      echo "Total Non-Entitled Death:" . $tot_nent_death ."\n";
        oci_free_statement($s);

// pmjay admission
        $s = oci_parse($c, $pmjay);
        oci_define_by_name($s, 'TOT_PMJAY', $tot_pmjay);
        $mystdate = $stdate;
        oci_bind_by_name($s, ":EIDBV", $mystdate);
        $myendate = $endate;
        oci_bind_by_name($s, ":EIDBV2", $myendate);        
        oci_execute($s);
        oci_fetch($s); 
//      echo "Total Non-Entitled Death:" . $tot_nent_death ."\n";
        oci_free_statement($s);



        // pmjay death
        $s = oci_parse($c, $pmjaydeath);
        oci_define_by_name($s, 'TOT_PMJAY_DEATH', $tot_pmjay_death);
        $mystdate = $stdate;
        oci_bind_by_name($s, ":EIDBV", $mystdate);
        $myendate = $endate;
        oci_bind_by_name($s, ":EIDBV2", $myendate);        
        oci_execute($s);
        oci_fetch($s); 
//      echo "Total PMJAY Death:" . (int)$tot_pmjay_death ."\n";
        oci_free_statement($s);

    
    
    /*   
        while ($row_1 = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) {
            echo $row_1[0] . $row_1[1]. "<br>\n";
              echo $row_1["tot_value"];
        }
*/        
    
        do_fetch($mystdate, $myendate, $tot_ent, $tot_nonent, $tot_ent_death, $tot_nent_death, $tot_pmjay, (int)$tot_pmjay_death, $s);
        oci_close($c);

} 
else 
{
    
}
?> 
 
<link rel="stylesheet" href="DataTables/datatables.min.css" rel="stylesheet" type="text/css" />
<script src="node_modules/jquery/dist/jquery.min.js"></script>
<script src="node_modules/popper.js/dist/popper.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>


    
</body>
</html>