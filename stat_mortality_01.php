<?php
    session_start();
?>

<html>
<head>
  <title>Stats: Mortality</title>
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
<nav class="navbar navbar-dark fixed-top bg-warning">
 <a class="navbar-brand" href="bgh_main.php"><img src="sail-logo.jpg" width="40" height="40" alt="BGH-MAIN"></a> 
  <h6>BGH Stats-Mortality</h6>
<div class="container">
<form  class="form-inline" name="myform" action="stat_mortality_01.php" method="POST"> <input type="hidden" name="check_submit" value="1" />      
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
            <button type="submit" name="submit" class="btn btn-primary">Get Data.</button>                       
        </div>
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
                print '<td colspan="9">' . 'Mortality From : ' . date("d-m-Y", strtotime($myeid)) .  '  To Date : ' . date("d-m-Y", strtotime($myendt)) . '</td>';
                print '</tr>';
                print '<tr>';
                print '<th scope="col">Dept</th>';
                print '<th scope="col">SlNo</th>';
                print '<th scope="col">Unit</th>';
                print '<th scope="col">Ward</th>';
                print '<th scope="col">Ward</th>';
                print '<th scope="col">Patient Name</th>';
                print '<th scope="col">Hospno</th>';
                print '<th scope="col">Ent</th>';
            
                print '<th scope="col">Age</th>';
                print '<th scope="col">Gender</th>';
                print '<th scope="col">AdmDt</th>';
                print '<th scope="col">AdmTm</th>';
                print '<th scope="col">DeathDt</th>';
                print '<th scope="col">DeathTm</th>';
                print '<th scope="col">Diag</th>';
                print '<th scope="col">Dur(Hrs.)</th>';
            
            
            
                print '</tr>';
                print '</thead>';
                          
                        $x = 0;
                        while ($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) 
                        {
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
//                print '<tr>';
//                        print '<td>' . 'Total Refund Made (Rs.)' .  '</td>';
//                        print '<td>' .  $x .  '</td>';
//                print '</tr>';   
//                    $GLOBALS['gtotal'] = $GLOBALS['gtotal']  + $x;
            print '</table>';
                

                print '<br>';
        }
   
  
    
        // Create connection to Oracle
        $c = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD"); 
        $query = "select DEPT, SRL_NO, UNIT, WARD, WARD_NAME, NAME, HOSPNO, ENT, AGE, 
                  GENDER, ADM_DT, ADM_TIME, DEATH_DT, DEATH_TIME, DIAG_DESC,HOSP_DUR
                  from WARD_STAT_DEATH_VIEW
                  where to_char(death_dt,'YYYY-MM-DD') between :EIDBV and :EIDBV2 
                  order by dept, death_date";
    
    
        $s = oci_parse($c, $query);    
        $myeid = $stdate;
        oci_bind_by_name($s, ":EIDBV", $myeid);
    
        
        $myendt = $endate;
        oci_bind_by_name($s,":EIDBV2", $myendt);
 
       
    
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