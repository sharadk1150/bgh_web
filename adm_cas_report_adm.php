<?php
    session_start();
?>

<html>
<head>
  <title>Cat Iwse Admission </title>
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
    
<nav class="navbar navbar-dark fixed-top bg-primary">
  <h6> Admission Data</h6>
</nav>
<br><br><br>
<form  name="myform" action="adm_cas_report_adm.php" method="POST">
                <input type="hidden" name="check_submit" value="1" />
    <form class="form-inline">   
        <div class="form-group row">
            <label for="stdate" class="col-sm-1 col-form-label">From Date</label> 
                <div class="col-sm-2">
                    <input type="date" class="form-control" id="stdate" name="stdate" 
                    value="<?php echo isset($_POST['stdate']) ? $_POST['stdate']:''; ?>">
                </div>    
                   
            <label for="endate" class="col-sm-1 col-form-label">To Date</label> 
                <div class="col-sm-2">
                    <input type="date" class="form-control" id="endate" name="endate"
                    value="<?php echo isset($_POST['endate']) ? $_POST['endate']:''; ?>">
                </div>    
                   
                    <button type="submit" name="submit" class="btn btn-primary">Get Data....</button>               
        </div>
    </form>            
  </form>


<?php
if (array_key_exists('check_submit', $_POST)) 
{
            $stdate =  $_POST['stdate'];
            $endate =  $_POST['endate'];
/*    
        function do_fetch($myeid, $myendt,  $s)
        {
                print '<table class="table table-sm table-bordered table-striped table-dark w-auto table-hover">';            
                print '<thead class="thead-light">';
                print '<tr>'; 
                print '<td colspan="9">' . 'Category Wise Admission From : ' . date("d-m-Y", strtotime($myeid)) .  '  To Date : ' . date("d-m-Y", strtotime($myendt)) . '</td>';
                print '</tr>';
                print '<tr>';
                print '<th scope="col">Category</th>';
                print '<th scope="col">Total Patient</th>';            
                print '</tr>';
                print '</thead>';
            
                        while ($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) 
                        {
                
                            print '<tr class="bg-primary">';
                            foreach ($row as $item) 
                            {                                
                                print '<td>'.($item?htmlentities($item):'&nbsp;').'</td>';
                                                                
                            }
                                print '</tr>';
                            }
                print '</table>';
        }
*/

        // Create connection to Oracle
        $c = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD");
        $query = "select count(*) 
                  from ward_admission_vw 
                  where pfrom1='C' and ent_nonent='Y' and  
                  to_char(admdate, 'MON')=:BMONTH       and 
                  to_char(admdate, 'YYYY')='2020'";    
        $s = oci_parse($c, $query);    
//        $myeid = $stdate;
//        oci_bind_by_name($s, ":EIDBV", $myeid);    
//        oci_execute($s);

        $month_array = ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"];
        $type_array  = ["ENTITLED", "NON-ENTITLED"];

        foreach ($month_array as $month => $value) 
        {
             oci_bind_by_name($s, ":BMONTH", $value);
             oci_execute($s);
             $tcount = oci_fetch_all($s, $res);
             print $month . '<\n>';
             print $value . '<\n>';
             var_dump($res);




             
        }



    
//        do_fetch($myeid, $myendt,  $s);
    
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