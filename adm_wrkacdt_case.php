<?php
    session_start();
?>

<html>
<head>
  <title>Work Accident Cases</title>
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
    
<!-- <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
.navbar-expand{-sm|-md|-lg|-xl}
  -->
 
  <nav class="navbar navbar-dark fixed-top bg-warning">
 <a class="navbar-brand" href="bgh_main.php"><img src="sail-logo.jpg" width="40" height="40" alt="BGH-MAIN"></a> 
  <h6>Work Accident Cases</h6>
<div class="container">
<form  class="form-inline" name="myform" action="adm_wrkacdt_case.php" method="POST"> <input type="hidden" name="check_submit" value="1" />     
  
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
    
global $gtotal;
$gtotal =0;    
    
if (array_key_exists('check_submit', $_POST)) 
{
            $stdate =  $_POST['stdate'];
            $endate =  $_POST['endate'];
            
    
        function do_fetch($myeid, $myendt, $s)
        {
//            date("d/m/Y", strtotime($str));
             
                print '<table class="table table-sm table-bordered table-striped table-dark w-auto table-hover">';            
                print '<thead class="thead-light">';
                print '<tr>'; 
                print '<td colspan="6">' . 'Work Accident Cases From : ' . date("d-m-Y", strtotime($myeid)) .  '  To Date : ' . date("d-m-Y", strtotime($myendt)) . '</td>';                
                print '</tr>';
                print '<tr>';
                print '<th scope="col">HospNo</th>';
                print '<th scope="col">From</th>';                        
                print '<th scope="col">No.</th>';      
                print '<th scope="col">PatName</th>';      
                print '<th scope="col">AdmDate</th>'; 
                print '<th scope="col">AdmTm</th>'; 
                print '<th scope="col">PatAge</th>'; 
                print '<th scope="col">Gender</th>'; 
                print '<th scope="col">StaffNo</th>'; 
                print '<th scope="col">Deptt</th>'; 
                print '<th scope="col">Grade</th>'; 
                print '<th scope="col">Unit</th>'; 
                print '<th scope="col">Diag.</th>'; 
            
            
            
            
                print '</tr>';
                print '</thead>';
                          
                        $x = 0;
                        $y = 0;
                        while ($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC))                         

                        {
//                            $y = $y + $row["TOTAL_DEATH"];
                            $x = $x + 1;
                            if ($x%2==0) {
                                print '<tr class="bg-primary">';}
                            else {
                                print '<tr class="bg-information">';}                                
                            
                            foreach ($row as $item) 
                            {                                
                                print '<td>'.($item?htmlentities($item):'&nbsp;').'</td>';
                                                                
                            }
                                print '</tr>';
                            }
                print '<tr>';
                        print '<td>' . 'Total Cases ' .  '</td>';
                        print '<td>' .  $x .  '</td>';
                print '</tr>';   
            print '</table>';
                print '<br>';
        }
  
    
    
    
        // Create connection to Oracle
        $c = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD"); 
        $query = "select (hospno||'/'||hospyr) hospno, 
                case pfrom1
                when 'O' then 'OPD'
                when 'C' then 'CASUALTY'
                when 'S' then 'OHS'
                end case,
                pfrom2, pat_name, admdate, admtime,pat_age, pat_sex, staff_no, deptt,gradep,
                pat_admit_unit, pat_provdiag
                from WARD_ADMISSION_VW_GRADE
                where to_char(admdate,'YYYY-MM-DD') between :EIDBV and :EIDBV2
                and wrk_acdt_case='Y'
                order by admdate desc, hospno desc";
                
                  
                  
                  
                  
                   
                  
    
    
        $s = oci_parse($c, $query);    
        $myeid = $stdate;
        oci_bind_by_name($s, ":EIDBV", $myeid);
    
        
        $myendt = $endate;
        oci_bind_by_name($s,":EIDBV2", $myendt);
/*
$stid = oci_parse($conn, "create table emp2 as select * from employees");
oci_execute($stid);
echo oci_num_rows($stid) . " rows inserted.<br />\n";
oci_free_statement($stid);
*/
    
    
        oci_execute($s);
        do_fetch($myeid, $myendt, $s);
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