<?php
    session_start();
?>

<html>
<head>
  <title>Get Admission Data For Employees</title>


<meta name="viewport" content="width=device-width, initial-scale=1">
    
        
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
  
<nav class="navbar navbar-dark fixed-top bg-warning">
 <a class="navbar-brand" href="bgh_main.php"><img src="sail-logo.jpg" width="40" height="40" alt="BGH-MAIN"></a> 
  <h6>BGH IPD Admissions Data</h6>
<div class="container">
<form  class="form-inline" name="myform" action="get_adm_employee.php" method="POST"> <input type="hidden" name="check_submit" value="1" />     
  
<div class="form-group">  
        <label for="stdate">Admission Start Date</label>  
        <input class="form-control mr-sm-2" type="date"   id="stdate" name="stdate" placeholder="fromDate" aria-label="stdate" value="<?php echo isset($_POST['stdate']) ? $_POST['stdate']:''; ?>">
    </div>     
         
         
    <div class="form-group">  
        <label for="endate">Admission To Date</label>  
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
    $stdate =  $_POST['stdate'];
    $endate =  $_POST['endate'];         

        function do_fetch($myeid, $myendt, $scount, $s)
        {
            
                print '<table class="table table-sm table-bordered table-striped table-dark w-auto table-hover">';            
                print '<thead class="thead-light">';
                print '<tr>'; 
                print '<td colspan="9">' . 'Admission Data From Date : ' . $myeid .  '  To Date : ' . $myendt . '</td>';
                print '</tr>';
                print '<tr>';
                print '<th scope="col">Hospno</th>';
                print '<th scope="col">HospYr</th>';
                print '<th scope="col">Patient</th>';
                print '<th scope="col">AdmDate</th>';   
                print '<th scope="col">AdmTime</th>';   
                print '<th scope="col">Age</th>';   
                print '<th scope="col">Gender</th>';   
                print '<th scope="col">Unit</th>';   
                print '<th scope="col">StaffNo</th>';   
                print '<th scope="col">Desig</th>';   
                print '<th scope="col">Deptt.</th>'; 
                print '<th scope="col">Address</th>';   
                print '<th scope="col">Tel No</th>';   
                print '<th scope="col">Prov Diag</th>';         
                print '</tr>';
                print '</thead>';
            
            
                        while ($row_1 = oci_fetch_array($scount, OCI_RETURN_NULLS+OCI_ASSOC)) {
                        print '<b>' . $row_1["GRADEP"] . " =  " . $row_1["TOT_COUNT"] . " ; " . '<b>';
                        }

                        while ($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) 
                        {
                            
                            
                            if (strpos($row["GRADEP"],'E') !== false){
                                print '<tr class="bg-danger">';
                            }
                            else{
                                print '<tr class="bg-active">';
                            }

                            foreach ($row as $item) 
                            {
                                
                                print '<td>'.($item?htmlentities($item):'&nbsp;').'</td>';                                
                            }
                                print '</tr>';
                            }
                print   '</table>';

        }
    
        // Create connection to Oracle
        $c = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD");
        // Use bind variable to improve resuability, 
        // and to remove SQL Injection attacks.
        $query = "select hospno, hospyr, pat_name, to_char(admdate,'DD.MM.YY') admdate, admtime, pat_age, pat_sex gender, pat_admit_unit,staff_no,design,deptt,pat_local_ADD, PAT_LOCAL_TEL, PAT_PROVDIAG, gradep 
        from ward_admission_vw_grade 
        where category='99' and family='E' and  
        to_char(admdate,'YYYY-MM-DD') between :EIDBV  and :ENDBV order by hospno, admdate, pat_name";
        
        $qcount = "select gradep, count(*) tot_count from ward_admission_vw_grade 
        where category='99' and family='E' and  
        to_char(admdate,'YYYY-MM-DD') between :EIDBV  and :ENDBV 
        group by gradep order by gradep";
        
        
        
        $s      = oci_parse($c, $query);
        $scount = oci_parse($c, $qcount);
        $myeid =  $stdate;
        $myendt = $endate;
        oci_bind_by_name($s, ":EIDBV", $myeid);
        oci_bind_by_name($s, ":ENDBV", $myendt);    

        oci_bind_by_name($scount, ":EIDBV", $myeid);
        oci_bind_by_name($scount, ":ENDBV", $myendt);    
        
        
        
        oci_execute($s);
        oci_execute($scount);
        
//        $rowarray = oci_fetch_array($statement, $mode);
//        $rowcount = oci_fetch_array($scount, OCI_RETURN_NULLS+OCI_NUM);
//        $rcount = $rowcount[0]; 
//        echo $rowcount[0]; 
        
        do_fetch($myeid, $myendt, $scount, $s);
        
        
        
        
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