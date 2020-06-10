<?php
    session_start();
?>

<html>
<head>
  <title>Bill: Category Wise</title>
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
    
<!-- <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
.navbar-expand{-sm|-md|-lg|-xl}
  -->
 
 <nav class="navbar navbar-dark fixed-top bg-warning">
  <h6>BGH Admission</h6>
<div class="container">
<form  class="form-inline" name="myform" action="bgh_opd_seen_pivot_01.php" method="POST">
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
if (array_key_exists('check_submit', $_POST)) 
{
            $stdate =  $_POST['stdate'];
            $endate =  $_POST['endate'];
    
        function do_fetch($myeid, $myendt,  $res, $y)
        {
                print '<table class="table table-sm table-bordered table-striped table-dark w-auto table-hover">';            
                print '<thead class="thead-light">';
                print '<tr>'; 
                print '<td colspan="9">' . 'Billing party Wise From : ' . date("d-m-Y", strtotime($myeid)) .  '  To Date : ' . date("d-m-Y", strtotime($myendt)) . '</td>';
                print '</tr>';
//                print '<tr>';
//                print '<th scope="col">Group-Name</th>';            
//                print '<th scope="col">Category-Name</th>';
//                print '<th scope="col">Total Bill (Rs.)</th>';            
//                print '</tr>';
//                print '</thead>';
//var_dump($nrows_opddate);


                  foreach ($res as $col)
                  {
//                    print '<tr>';

                      foreach ($col as $item) 
                      {


                        print '<th scope="col">'. $item. '</th>';

                        oci_bind_by_name($y,":OPDT1", $item);
                        oci_execute($y);
                        while ($row = oci_fetch_array($y, OCI_RETURN_NULLS+OCI_ASSOC)) 
                        {     
//                            print '<tr>';
                            foreach ($row as $col_name) 
                            {     
                                print '<tr>';                           
                                print '<th scope="col">'. $col_name. '</th>';   
                                print '</tr>';                                                             
                            }
//                            print '</tr>';



                        }   






                    }
//                    print '</tr>';

                }

/*
            print '<tr>';                                                
            print '<th scope="col">***** Doctor-Name *****</th>'; 
            while ($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) 
                        {                
                            print '<th scope="col">'.$row["OPD_DATE"]. '</th>';                                                                
                            oci_bind_by_name($y,":OPDT1", $row["OPD_DATE"]);
                            oci_execute($y);
                            while ($row = oci_fetch_array($y, OCI_RETURN_NULLS+OCI_ASSOC)) 
                            {                
                                foreach ($row as $item) 
                                {                                
                                    print '<tr>'. $item. '</tr>';                                                                
                                }
                            }            
                    
                        }
*/

        }
    
        // Create connection to Oracle
        $c = oci_connect("BGH", "hpv185e", "10.143.100.36/BGH6");
        // Use bind variable to improve resuability, 
        // and to remove SQL Injection attacks.

        $query = "select distinct opd_date 
                  from 
                  bgh_opd_registration 
                  where 
                  to_char(opd_date,'YYYY-MM-DD') between :EIDBV and :EIDBV2
                  order by opd_date";

        $s = oci_parse($c, $query);
        $myeid = $stdate;
        oci_bind_by_name($s, ":EIDBV", $myeid);
        $myendt = $endate;
        oci_bind_by_name($s,":EIDBV2", $myendt);
        oci_execute($s);        
        $nrows_opddate = oci_fetch_all($s, $res);

        $query_2 = "select doctor_code, count(huid_no) 
                  from 
                  bgh_opd_registration 
                  where 
                  to_char(opd_date,'DD-MON-YY') = :OPDT1
                  group by doctor_code order by doctor_code";

        $y = oci_parse($c, $query_2);

        do_fetch($myeid, $myendt,  $res, $y);

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