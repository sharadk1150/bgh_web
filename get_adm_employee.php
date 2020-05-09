<?php
    session_start();
?>

<html>
<head>
  <title>Get Admission Data For Employees</title>


<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">    
    
        
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>





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
  
<div class="w3-panel w3-red">
  <p>Employees Admitted at BGH...</p>
</div>
    
<form class="w3-container" name="myform" action="get_adm_employee.php" method="post">    
    <input type="hidden" name="check_submit" value="1" />    
    
    <div class="w3-row-padding">
           
           <div class="w3-quarter">
                <label class="w3-text-blue"><b>Start Date</b></label>
                <input maxlength="10" size="12" class="w3-input w3-border" type="date" id="stdate" name="stdate">
           </div>

           <div class="w3-quarter">
                <label class="w3-text-blue"><b>End Date</b></label>
                <input maxlength="10" size="12" class="w3-input w3-border" type="date" id="endate" name="endate">
           </div>
           
            <div class="w3-quarter">    
                    <button class="w3-btn w3-blue w3-margin-top" type="submit" name="submit" id="submit">Get Data</button>
            </div>
            
     </div>
</form>    




<?php

    if (array_key_exists('check_submit', $_POST)) 
{
    $stdate =  $_POST['stdate'];
    $endate =  $_POST['endate'];         

        function do_fetch($myeid, $myendt, $rcount, $s)
        {
            
            print '<div class="w3-responsive">';
            print '<table class="w3-bordered w3-striped w3-table-all">';
  
            
//                print '<table class="table table-sm table-bordered table-striped table-dark w-auto">';   
                print '<thead>';            
                print '<tr class="w3-red">'; 
                print '<td  colspan="6">' . 'Data For Date: ' . $myeid .  ' To ' .  $myendt . 'Toatl : ' . $rcount . '</td>';
                print '</tr>';            
                print '<tr class="w3-blue">';
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
            
                        while ($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) 
                        {
                            print '<tr class="w3-hover-green">';
                            foreach ($row as $item) 
                            {
                                
                                print '<td>'.($item?htmlentities($item):'&nbsp;').'</td>';                                
                            }
                                print '</tr>';
                            }
//                print '</table>';
print   '</table>';
print   '</div>';

        
        }
    
        // Create connection to Oracle
        $c = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD");
        // Use bind variable to improve resuability, 
        // and to remove SQL Injection attacks.
        $query = "select hospno, hospyr, pat_name, to_char(admdate,'DD.MM.YY') admdate,admtime, pat_age, pat_sex gender, pat_admit_unit,staff_no,design,deptt,pat_local_ADD, PAT_LOCAL_TEL, PAT_PROVDIAG from ward_admission_vw 
        where category='99' and family='E' and  
        to_char(admdate,'YYYY-MM-DD') between :EIDBV  and :ENDBV order by admdate, pat_name";
        
        $qcount = "select count(*) tot_count from ward_admission_vw 
        where category='99' and family='E' and  
        to_char(admdate,'YYYY-MM-DD') between :EIDBV  and :ENDBV order by admdate, pat_name";
        
        
        
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
        $rowcount = oci_fetch_array($scount, OCI_RETURN_NULLS+OCI_NUM);
        $rcount = $rowcount[0]; 
        echo $rowcount[0]; 
        
        do_fetch($myeid, $myendt, $rcount, $s);
        
        
        
        
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