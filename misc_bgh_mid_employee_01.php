<?php
    session_start();
?>

<html>
<head>
  <title>OPD: Cash Collection</title>
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
    
<!-- Nav Bar for position at the top of page-->  
<nav class="navbar navbar-dark fixed-top bg-warning">
 <a class="navbar-brand" href="bgh_main.php"><img src="sail-logo.jpg" width="40" height="40" alt="BGH-MAIN"></a> 
  <h6>View Entitled Patient Details</h6>
<div class="container">
 
 
<form  class="form-inline" name="myform" action="misc_bgh_mid_employee_01.php" method="POST">
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
//            date("d/m/Y", strtotime($str));
             
                print '<table class="table table-sm table-bordered table-striped table-dark w-auto table-hover">';            
                print '<thead class="thead-light">';
                print '<tr>'; 
                print '<td colspan="9">' . 'Employee Details of  : ' . $myeid . '</td>';
                print '</tr>';
                print '<tr>';
                print '<th scope="col">Name</th>';
                print '<th scope="col">Relation</th>';
                print '<th scope="col">BirthDt</th>';
                print '<th scope="col">StNo</th>';
                print '<th scope="col">Srl</th>';
                print '<th scope="col">MidNo</th>';
                print '<th scope="col">DepStat</th>';
                print '<th scope="col">Gender</th>';
                print '<th scope="col">EStat</th>';
                print '<th scope="col">PStat</th>';
                print '<th scope="col">Party</th>';
                print '<th scope="col">Grade</th>';
                print '<th scope="col">Roll</th>';
                print '<th scope="col">Des</th>';
                print '<th scope="col">Retention</th>';
                print '<th scope="col">LastUpd</th>';


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
                            <a href="student_profiles.php?std_id=' . $row["MID_NO"] . ' " class="btn btn-warning btn-xs"><i class="fas fa-eye"></i> View</a>
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
                 from bgh_mid_employee where stno=:EIDBV order by 6";
    
    
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
    
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>  
</body>
</html>