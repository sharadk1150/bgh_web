<?php
    session_start();
?>

<html>
<head>
  <title>OPD: Daily Status</title>
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
  <h6>BGH Admission</h6>
<div class="container">
<form  class="form-inline" name="myform" action="opd_status_02.php" method="POST">
                <input type="hidden" name="check_submit" value="1" />
    <form class="form-inline">   
        <div class="form-group row">
            <label for="stdate" class="mr-sm-3 col-form-label">From Date</label> 
                <div class="mr-sm-3">
                    <input type="date" class="form-control" id="stdate" name="stdate" 
                    value="<?php echo isset($_POST['stdate']) ? $_POST['stdate']:''; ?>">
                </div>    
                   
            <label for="endate" class="mr-sm-3 col-form-label">To Date</label> 
                <div class="mr-sm-3">
                    <input type="date" class="form-control" id="endate" name="endate"
                    value="<?php echo isset($_POST['endate']) ? $_POST['endate']:''; ?>">
                </div>  
                
                                                          
                    <button type="submit" name="submit" class="btn btn-primary">Get Data</button>               
        
        </div>
    </form>            
  </form>
</div>  
</nav>

<br><br><br>

<?php
if (array_key_exists('check_submit', $_POST)) 
{
            $stdate =  $_POST['stdate'];
            $endate =  $_POST['endate'];
    
        function do_fetch($myeid, $myendt,  $s)
        {
//            date("d/m/Y", strtotime($str));
                print '<table class="table table-sm table-bordered table-striped table-dark w-auto table-hover">';            
                print '<thead class="thead-light">';
                print '<tr>'; 
                print '<td colspan="9">' . 'OPD Attendance  : ' . date("d-m-Y", strtotime($myeid)) .  '  To Date : ' . date("d-m-Y", strtotime($myendt)) . '</td>';
                print '</tr>';
                print '<tr>';
                print '<th scope="col">OPD Name</th>';
                print '<th scope="col">Total Patients</th>';            
                print '</tr>';
                print '</thead>';
                        $tot_sum = 0;                
                        while ($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) 
                        {
                            $tot_sum = $tot_sum + $row["TOTAL"];
                            print '<tr class="bg-primary">';
                            foreach ($row as $item) 
                            {                                
                                print '<td>'.($item?htmlentities($item):'&nbsp;').'</td>';
                                                                
                            }
                                print '</tr>';
                            }
                     print '<tr>';
                            print '<td>' . 'Total' .  '</td>';
                            print '<td>' . $tot_sum . '</td>';
            
                     print '</tr>';
                         
                print '</table>';
        }
    
        // Create connection to Oracle
        $c = oci_connect("BGH", "hpv185e", "10.143.100.36/BGH6");
        // Use bind variable to improve resuability, 
        // and to remove SQL Injection attacks.
  
        $query = "select opd_code opd_name, count(*) total from bgh_opd_registration
                  where to_char(opd_date,'YYYY-MM-DD') between :EIDBV and :EIDBV2 and
                  opd_seen_status='Y' group by opd_code order by 2 desc ";
        
        $s = oci_parse($c, $query);
        $myeid = $stdate;
        oci_bind_by_name($s, ":EIDBV", $myeid);
        $myendt = $endate;
        oci_bind_by_name($s,":EIDBV2", $myendt);
        oci_execute($s);
        do_fetch($myeid, $myendt,  $s);
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