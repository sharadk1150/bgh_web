<?php
    session_start();
?>

<html>
<head>
  <title>Bill: Category Wise</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <style>
    label {
        color:blue;
        text-align: left;
        margin-top: 5px;
        padding: 0px;
        font-weight: bold;
        font-style: normal;
        
    }


    .navbar-nav > li > a {
        padding-top:5px; 
        padding-bottom:5px;
        }
    .navbar {
        padding-top:5px; 
        padding-bottom:5px;
        }

  </style>
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
    


           


<!--<nav class="navbar fixed-top navbar-light bg-warning justify-content-between"> -->
<nav class="navbar fixed-top navbar-light bg-warning justify-content-start">
  <a class="navbar-brand" href="bgh_main.php"><img src="sail-logo.jpg" width="40" height="40" alt="BGH-MAIN"></a> 
 <!-- <span class="navbar-text">OPD Patient Visit Data:</span> -->
  <form class="form-inline" name="myform" action="opd_pat_seen_01.php" method="POST">
                <input type="hidden" name="check_submit" value="1" />

        <div class="form-group">
            <label for="stdate">From Date</label>
            <input type="date" class="form-control" id="stdate" name="stdate" 
            placeholder="From Date" value="<?php echo isset($_POST['stdate']) ? $_POST['stdate']:''; ?>">
        </div>

        <div class="form-group">
            <label for="endate">To Date</label>
            <input type="date" class="form-control" id="endate" name="endate" 
            placeholder="To Date" value="<?php echo isset($_POST['endate']) ? $_POST['endate']:''; ?>">
        </div>
        <button class="btn  btn-outline-success my-2 my-sm-0" type="submit" name="submit" id="submit">Get Data</button>
  </form>

</nav>


 

<br><br><br>

<?php

if (array_key_exists('check_submit', $_POST)) 
{
            $stdate =  $_POST['stdate'];
            $endate =  $_POST['endate'];
            
            
           

            function do_fetch_slip($conn, $myeid, $myendt,  $doc_code)
            {
                $query1 = "select count(distinct tr_id) tot_count
                from bgh_opd_patient_prescription
                where 
                opd_doc_code = :DOC_CODE and
                sl_on = 'S' and 
                to_char(opd_date,'YYYY-MM-DD') between :EIDBV and :EIDBV2";                
                $t = oci_parse($conn, $query1);
    
                oci_bind_by_name($t, ":EIDBV", $myeid);
                oci_bind_by_name($t, ":EIDBV2", $myendt);
                oci_bind_by_name($t, ":DOC_CODE", $doc_code);
                oci_define_by_name($t, 'TOT_COUNT', $tot_count);   
                oci_execute($t);
                while (oci_fetch($t)) 
                {
                    print '<td>' . $tot_count . '</td>';
                }            
            }
    
        
        function do_fetch($myeid, $myendt,  $s)
        {
            $conn = oci_connect("BGH", "hpv185e", "10.143.100.36/BGH6");
//            date("d/m/Y", strtotime($str));
                print '<table class="table table-sm table-bordered table-striped table-dark w-auto table-hover">';            
                print '<thead class="thead-light">';
                print '<tr>'; 
                print '<td colspan="9">' . 'Billing party Wise From : ' . date("d-m-Y", strtotime($myeid)) .  '  To Date : ' . date("d-m-Y", strtotime($myendt)) . '</td>';
                print '</tr>';
                print '<tr>';
                print '<th scope="col">DoctorCode</th>';     
                print '<th scope="col">DoctorName</th>';     

                print '<th scope="col">OnLine</th>';
                print '<th scope="col">Slips</th>';     

                print '</tr>';
                print '</thead>';
                                    
            
                        while ($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) 
                        {
                
                            print '<tr class="bg-primary">';
                            foreach ($row as $item) 
                            {                                
                                print '<td>'.($item?htmlentities($item):'&nbsp;').'</td>';
//                                do_fetch_slip($conn, $myeid, $myendt,  $row["DOCTOR_CODE"]);
//                                print $row["DOCTOR_CODE"];
                                                                
                            }
                            do_fetch_slip($conn, $myeid, $myendt,  $row["DOCTOR_CODE"]);
                                print '</tr>';
                            }
                print '</table>';
        }

        


        // Create connection to Oracle
        $c = oci_connect("BGH", "hpv185e", "10.143.100.36/BGH6");
        // Use bind variable to improve resuability, 
        // and to remove SQL Injection attacks.
    
        $query = "select a.doctor_code, (b.title||' '|| b.name) drname, count(a.huid_no) pat_seen 
                  from bgh_opd_registration  a,
                  bgh_doctdic_new        b
                  where 
                  a.doctor_code=b.code and
                  to_char(a.opd_date,'YYYY-MM-DD') between :EIDBV and :EIDBV2 and 
                  a.opd_seen is not null
                  group by  a.doctor_code, (b.title||' '|| b.name) 
                  order by doctor_code ";
    
//        $qcount = "select cat_name, count(*) tot_count from ward_admission_vw_grade 
//        where  to_char(admdate,'YYYY-MM-DD') between :EIDBV and :EIDBV2 group by cat_name";
    
        $s = oci_parse($c, $query);
//        $scount = oci_parse($c, $qcount);
    
        $myeid = $stdate;
        oci_bind_by_name($s, ":EIDBV", $myeid);
//        oci_bind_by_name($scount, ":EIDBV", $myeid);
    
        
        $myendt = $endate;
        oci_bind_by_name($s,":EIDBV2", $myendt);
//        oci_bind_by_name($scount, ":EIDBV2", $myeid);
    
        oci_execute($s);
//        oci_execute($scount);
    
    
//        while ($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) {
//            echo $row[0] . $row[1]. "<br>\n";
//              echo $row["HOSPNO"];
//        }
    
        do_fetch($myeid, $myendt,  $s);
    
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