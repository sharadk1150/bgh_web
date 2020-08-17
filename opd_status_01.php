<?php
/*
  This Program displays the counterwise expiry, damage and breakage entry for a fiancual year
  Same program if selected ALL in the counter list displays the consolidated List
*/
    session_start();
?>

<html>
<head>
  <title>OPD: Status Parameters </title>
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
  <h6> OPD: Current Status Parameters</h6>
</nav>
<br><br><br>



 
<!-- The form for getting the dates by default shall show the current dates and get data-->          
<form  name="myform" action="opd_status_01.php" method="POST">
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

<!-- Arrange the cards on which we want to display the data-->    

<?php
if (array_key_exists('check_submit', $_POST)) 
{
                $stdate   =  $_POST['stdate'];
                $endate   =  $_POST['endate'];

       echo $stdate;
       echo $endate;
    
        $c = oci_connect("BGH",  "hpv185e", "10.143.100.36/BGH6");
        $w = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD");

           print '<div class="container">';
// ON LINE QUERY    
        $query = "select count(*) opd_online from bgh_opd_registration where 
                 to_char(opd_date,'YYYY-MM-DD') between :EIDBV and :EIDBV2 and opd_seen_status ='Y'";
    
        $s = oci_parse($c, $query);
        $mystdate = $stdate;
        oci_bind_by_name($s, ":EIDBV", $mystdate);
        $myendate = $endate;
        oci_bind_by_name($s, ":EIDBV2", $myendate);
        oci_execute($s); 
        while ($opdonline = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) {$onl = $opdonline["OPD_ONLINE"];}

 
        print '<div class="card-deck">';
    
        print '<div class="card border-primary mb-3" style="max-width: 18rem;">';
        print '<div class="card-header">OPD  Online</div>';
        print '<div class="card-body text-primary">';
        print '<h5 class="card-title">' . $onl .  '</h5>';
        print '</div>';
        print '</div>';
// SLIP QUERY    
        $query = "select count(distinct tr_id) opd_slip from bgh_opd_patient_prescription where 
                 to_char(dl_dt,'YYYY-MM-DD') between :EIDBV and :EIDBV2 and sl_on='S'";
    
        $s = oci_parse($c, $query);
        $mystdate = $stdate;
        oci_bind_by_name($s, ":EIDBV", $mystdate);
        $myendate = $endate;
        oci_bind_by_name($s, ":EIDBV2", $myendate);
        oci_execute($s); 
        while ($opdslip = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) {$slip = $opdslip["OPD_SLIP"];}
        print '<div class="card border-primary mb-3" style="max-width: 18rem;">';
        print '<div class="card-header">OPD  Slips</div>';
        print '<div class="card-body text-primary">';
        print '<h5 class="card-title">' . $slip .  '</h5>';
        print '</div>';
        print '</div>';
// OPD at CTR 101    
        $query = "select count(*) opd_pvt from ctr_101_pat_trans where 
                 to_char(visit_date,'YYYY-MM-DD') between :EIDBV and :EIDBV2 and chargecode ='5101001'";
    
        $s = oci_parse($w, $query);
        $mystdate = $stdate;
        oci_bind_by_name($s, ":EIDBV", $mystdate);
        $myendate = $endate;
        oci_bind_by_name($s, ":EIDBV2", $myendate);
        oci_execute($s); 
        
        while ($opd101 = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) {$opvt = $opd101["OPD_PVT"];}
// OPD CTR 101 Cash Collected     
        $qamount = "select sum(total_amt) tot_amt from ctr_101_pat_trans where 
                 to_char(visit_date,'YYYY-MM-DD') between :EIDBV and :EIDBV2 and pat_type='NE'";
    
        $q = oci_parse($w, $qamount);
        $mystdate = $stdate;
        oci_bind_by_name($q, ":EIDBV", $mystdate);
        $myendate = $endate;
        oci_bind_by_name($q, ":EIDBV2", $myendate);
        oci_execute($q); 
        
        while ($opd101 = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) {$opvt = $opd101["OPD_PVT"];}
        while ($opdcash= oci_fetch_array($q, OCI_RETURN_NULLS+OCI_ASSOC)) {$ocsh = $opdcash["TOT_AMT"];}
    
    
        
    
        print '<div class="card border-primary mb-3" style="max-width: 18rem;">';
        print '<div class="card-header">OPD  Private</div>';
        print '<div class="card-body text-primary">';
        print '<h5 class="card-title">' . $opvt .  ' / Rs.' . $ocsh . '</h5>';
        print '</div>';
        print '</div>';
// Only Employee     
//select * from bgh_opd_registration where opd_date=trunc(sysdate)-1 and opd_seen_status='Y' and party_code='2000' and //substr(huid_no,7,2)='00'    
        $qemp = "select count(*) tot_emp from bgh_opd_registration where 
                 to_char(opd_date,'YYYY-MM-DD') between :EIDBV and :EIDBV2 and opd_seen_status='Y' and
                 party_code='2000' and substr(huid_no,7,2)='00' ";
    
        $e = oci_parse($c, $qemp);
        $mystdate = $stdate;
        oci_bind_by_name($e, ":EIDBV", $mystdate);
        $myendate = $endate;
        oci_bind_by_name($e, ":EIDBV2", $myendate);
        oci_execute($e); 
        
        while ($opdemp = oci_fetch_array($e, OCI_RETURN_NULLS+OCI_ASSOC)) {$oemp = $opdemp["TOT_EMP"];}
    
        print '<div class="card border-primary mb-3" style="max-width: 18rem;">';
        print '<div class="card-header">Employee Only</div>';
        print '<div class="card-body text-primary">';
        print '<h5 class="card-title">' . $oemp. '</h5>';
        print '</div>';
        print '</div>';
    

// Div for Deck   
//        print '</div>';

// Next Deck Number of Sample Appoitment Given and Collected
//        print '<div class="card-deck">';
// Number of Sample Appointment Given
        $qamount = "select count(*) tot_sample from bgh_lab_sample where 
                 to_char(sample_dt,'YYYY-MM-DD') between :EIDBV and :EIDBV2";
    
        $q = oci_parse($w, $qamount);
        $mystdate = $stdate;
        oci_bind_by_name($q, ":EIDBV", $mystdate);
        $myendate = $endate;
        oci_bind_by_name($q, ":EIDBV2", $myendate);
        oci_execute($q); 
        
        while ($invsamp= oci_fetch_array($q, OCI_RETURN_NULLS+OCI_ASSOC)) {$osamp = $invsamp["TOT_SAMPLE"];}
    
        print '<div class="card border-primary mb-3" style="max-width: 18rem;">';
        print '<div class="card-header">Sample Appointment Given</div>';
        print '<div class="card-body text-primary">';
        print '<h5 class="card-title">' . $osamp .  '</h5>';
        print '</div>';
        print '</div>';
// Number of Sample Collected

        $qamount = "select count(*) tot_sample from bgh_lab_sample where 
                 to_char(sample_dt,'YYYY-MM-DD') between :EIDBV and :EIDBV2 and 
                 to_char(samp_dt,'YYYY-MM-DD') between :EIDBV and :EIDBV2";
    
        $q = oci_parse($w, $qamount);
        $mystdate = $stdate;
        oci_bind_by_name($q, ":EIDBV", $mystdate);
        $myendate = $endate;
        oci_bind_by_name($q, ":EIDBV2", $myendate);
        oci_execute($q);         
        while ($invsamp= oci_fetch_array($q, OCI_RETURN_NULLS+OCI_ASSOC)) {$osamp = $invsamp["TOT_SAMPLE"];}
        print '<div class="card border-primary mb-3" style="max-width: 18rem;">';
        print '<div class="card-header">Sample Collected</div>';
        print '<div class="card-body text-primary">';
        print '<h5 class="card-title">' . $osamp .  '</h5>';
        print '</div>';
        print '</div>';

    print '</div>'; // deck
// Online OPD under different Categories    
  
// Div for Container   
    print '</div>';
//}

    print '<div class="container">';
// Online OPD under Different Category
    
                $qcat = "select a.party_code party_code, b.party_short_name party_name, count(*) tot_count 
                from bgh_opd_registration a, bgh_party_master b 
                where a.party_code = b.party_code and a.opd_seen_status='Y' and
                to_char(a.opd_date,'YYYY-MM-DD') between :EIDBV and :EIDBV2 
                group by a.party_code, b.party_short_name  
                order by 3 desc";
                
                
    
                $cat = oci_parse($c, $qcat);
                $mystdate = $stdate;
                oci_bind_by_name($cat, ":EIDBV", $mystdate);
                $myendate = $endate;
                oci_bind_by_name($cat, ":EIDBV2", $myendate);
                oci_execute($cat);   
    
                print '<table class="table table-sm table-bordered table-striped table-dark w-auto table-hover">';            
                print '<thead class="thead-light">';
                print '<tr>'; 
                print '<td colspan="9">' . 'From Date  : ' . $mystdate .  '  To Date : ' . $myendate . '</td>';
                print '</tr>';
                print '<tr>';
                print '<th scope="col">Party Code</th>';
                print '<th scope="col">party Name</th>';
                print '<th scope="col">OPD Visit</th>';
                print '</tr>';
                print '</thead>';
            
                        while ($row = oci_fetch_array($cat, OCI_RETURN_NULLS+OCI_ASSOC)) 
                        {                            
                            print '<tr>';

                            foreach ($row as $item) 
                            { 
                                
                                print '<td>'.($item?htmlentities($item):'&nbsp;').'</td>';
                                                                
                            }
                                print '</tr>';
                            }
                print '</table>';
// Div for Container   
    print '</div>';      
}
    ?>

    
 
<script src="node_modules/jquery/dist/jquery.min.js"></script>
<script src="node_modules/popper.js/dist/popper.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>