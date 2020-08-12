<?php
/*
  This Program displays the counterwise expiry, damage and breakage entry for a fiancual year
  Same program if selected ALL in the counter list displays the consolidated List
*/
    session_start();
?>

<html>
<head>
  <title>BILL: Guarantor Bill Pending </title>
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
  <h6>BGH IPD Guarantor's Bill Pending</h6>
<div class="container">
<form  class="form-inline" name="myform" action="bill_grntr_pending_01.php" method="POST"> <input type="hidden" name="check_submit" value="1" />     
  
   <div class="form-group">         
      <label for="year">Year For Which Guarantor Bill Pending:</label>
      <select id="year" name="year" class="form-control mr-sm-2">       
            <?php

            $c = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD");
            $sql = "select hospyr from hospyr_view order by 1 desc";  
            $stid = oci_parse($c, $sql);  
            $success = oci_execute($stid);          
                while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)){
                print '<option> ' . $row["HOSPYR"] . '</option>';
            }  
            oci_close($c);            
          ?>                    
      </select>
      </div>                          
      
        <button class="btn btn-success my-2 my-sm-0" type="submit" name="submit">Get Data...</button>
    </form>
</nav>
</div>    
<!-- Nav Bar for position at the top of page-->      


<br><br><br>

<?php
if (array_key_exists('check_submit', $_POST)) 
{
    
                if (isset($_POST['year'])){$year      =  $_POST['year'];}
               
    
        function do_fetch($myfinyr, $s)            
            {
                print '<table class="table table-sm table-bordered table-striped table-dark w-auto table-hover">';            
                print '<thead class="thead-light">';
                print '<tr>'; 
                print '<td colspan="9">' . 'Guarantor Bill Pending  For : ' . $myfinyr . '</td>';
                print '</tr>';
                print '<tr>';
                print '<th scope="col">StaffNo</th>';
                print '<th scope="col">RetDt</th>';
                print '<th scope="col">EmpName</th>';
                print '<th scope="col">Design</th>';
                print '<th scope="col">Deptt</th>';
                print '<th scope="col">Hospno</th>';
                print '<th scope="col">Hospyr</th>';
                print '<th scope="col">AdmDt</th>';
                print '<th scope="col">Time</th>';
                print '<th scope="col">PatName</th>';
                print '<th scope="col">Age</th>';
                print '<th scope="col">Gender</th>';
                print '<th scope="col">Unit</th>';
            
                print '</thead>';
            

// Print the data in Table            
                        while ($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) 
                        {                            
                            print '<tr>';

                            foreach ($row as $item) 
                            { 
                                
                                print '<td>'.($item?htmlentities($item):'&nbsp;').'</td>';
                                                                
                            }
                                print '</tr>';
                            }
                print '</table>';
        }
    
    
        // Create connection to Oracle
        $c = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD");
        // Use bind variable to improve resuability, 
        // and to remove SQL Injection attacks.

    
        $query = "select staff_no, ret_dt, employee, design, deptt, hospno, hospyr, admdate, admtime, pat_name, pat_age,               pat_sex gender, pat_admit_unit 
                  from WARDBILL_GUARANTOR_BILLPENDING 
                  where hospyr=:EIDBV order by 8";
    
    
        $s = oci_parse($c, $query);
    
        $myfinyr = $year;
        oci_bind_by_name($s, ":EIDBV", $myfinyr);
    
        
    
        oci_execute($s);    
    
        do_fetch($myfinyr, $s);
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