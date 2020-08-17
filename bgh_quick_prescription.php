<?php
    session_start();
?>

<html>
<head>
  <title>OPD: Cash Collection</title>
<link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>

<!-- Nav Bar for position at the top of page-->  
<nav class="navbar navbar-dark fixed-top bg-warning">
 <a class="navbar-brand" href="bgh_main.php"><img src="sail-logo.jpg" width="40" height="40" alt="BGH-MAIN"></a> 
  <h6>View Entitled Patient Details</h6>
<div class="container"> 
<form  class="form-inline" name="myform" action="bgh_quick_prescription.php" method="POST">
                <input type="hidden" name="check_submit" value="1" />
    <form class="form-inline">   
        <div class="form-group row">
            <label for="stno" class="mr-sm-3 col-form-label">Staff No/MIN No/ID</label> 
                <div class="mr-sm-3">
                    <input type="text" class="form-control" id="stno" name="stno" 
                    value="<?php echo isset($_POST['stno']) ? $_POST['stno']:''; ?>">
                </div>                       
                <button type="submit" name="submit" class="btn btn-primary">Get Details.</button>                       
            <button type="button" onclick="myFunction()" name="btngraph" class="btn btn-success">Show Graph.</button>                       
        </div>
    </form>            
  </form>
</div>  
</nav>

<br><br><br>

<?php
    
global $gtotal;
$gtotal =0;    
    
if (array_key_exists('check_submit', $_POST)) 
{
            $stno =  $_POST['stno'];
        function do_fetch($myeid, $s)
        {
             
                print '<table class="table table-sm table-bordered table-striped table-dark w-auto table-hover">';            
                print '<thead class="thead-light">';
                print '<tr>'; 
                print '<td colspan="9">' . 'Employee Details of  : ' . $myeid . '</td>';
                print '</tr>';
                print '<tr>';
                print '<th scope="col">Name</th>';
                print '<th scope="col">Rel</th>';
                print '<th scope="col">BirthDt</th>';
                print '<th scope="col">MidNo</th>';
                print '<th scope="col">Gender</th>';
                print '<th scope="col">Grade</th>';
                print '<th scope="col">Roll</th>';
                print '<th scope="col">Des</th>';
                print '</tr>';
                print '</thead>';
                          
                        $x = 0;
                        $gtotal = 0;
                        while ($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) 
                        {
                            $x = $x + 1;
                            
                            if ($x%2==0) {
                                print '<tr class="bg-success">';}
                            else {
                                print '<tr class="bg-primary">';}                                
                            
                            foreach ($row as $item) 
                            {                                
                                print '<td>'.($item?htmlentities($item):'&nbsp;').'</td>';
                                                                
                            }

                            print '<td align="right">                           
                            <a href="prescription.php?mid_no='.$row["MID_NO"].'
                            &name='.$row["NAME"].'
                            "class="btn btn-warning btn-xs"><i class="fas fa-eye"></i>View</a>
                            </td>';

                            print '</tr>';
                            }


                            print '<tr>';
                        print '<td>' . 'Total Members' .  '</td>';
                        print '<td>' .  $x .  '</td>';
                print '</tr>';   
            print '</table>';
                

                print '<br>';
        }
   
  
    
        // Create connection to Oracle
        $c = oci_connect("BGH", "hpv185e", "10.143.100.36/BGH6"); 
        $query = "select name, relation, birth_dt, stno, srl, mid_no, dep_stat, sex, 
                  emp_stat, pat_stat, party_code, gradep, roll_stat, desdescp, retention_till, 
                 last_update
                 from bgh_mid_employee where stno=UPPER(:EIDBV) order by 6";
    
    
        $s = oci_parse($c, $query);    
        $myeid = $stno;
        oci_bind_by_name($s, ":EIDBV", $myeid);
        
        oci_execute($s);
        do_fetch($myeid, $s);
        oci_close($c);

} 
else 
{
    
}
?> 

 
 
<script>
function myFunction() {
    alert("Demo Alert");
    location.replace("opd_daily_cash_collgr01.html");
}  
</script>  




<script src="node_modules/jquery/dist/jquery.min.js"></script>
<script src="node_modules/popper.js/dist/popper.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
</body>
</html>