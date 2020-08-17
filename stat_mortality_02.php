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
    
<!-- <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
.navbar-expand{-sm|-md|-lg|-xl}
  -->
 
 <nav class="navbar navbar-dark fixed-top bg-warning">
  <h6>BGH Stats-Mortality</h6>
<div class="container">
<form  class="form-inline" name="myform" action="stat_mortality_02.php" method="POST">
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
            <button type="submit" name="submit" class="btn btn-primary">Get Data.</button>                       
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
                print '<th scope="col">Total Mortality</th>';                        
                print '</tr>';
                print '</thead>';
                          
                        $x = 0;
                        $y = 0;
                        while ($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) 
                        {
                            $y = $y + $row["TOTAL_DEATH"];
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
                        print '<td>' . 'Total ' .  '</td>';
                        print '<td>' .  $y .  '</td>';
                print '</tr>';   
            print '</table>';
                

                print '<br>';
        }
   
  
    
        // Create connection to Oracle
        $c = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD"); 
        $query = "select DEPT, count(*) total_death
                  from WARD_STAT_DEATH_VIEW
                  where to_char(death_dt,'YYYY-MM-DD') between :EIDBV and :EIDBV2 
                  group by dept
                  order by 2 desc";
    
    
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