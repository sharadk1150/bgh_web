<?php
    session_start();
?>

<html>
<head>
  <title>Bill: Third Party</title>
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
<form  class="form-inline" name="myform" action="bill_cat_wise_03.php" method="POST">
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
    
    
        function do_fetch($myeid, $myendt, $s)
        {
//            date("d/m/Y", strtotime($str));
                print '<table class="table table-sm table-bordered table-striped table-dark w-auto table-hover">';            
                print '<thead class="thead-light">';
                print '<tr>'; 
                print '<td colspan="9">' . 'Billing party Wise From : '  . date("d-m-Y", strtotime($myeid)) .  '  To Date : ' . date("d-m-Y", strtotime($myendt)) . '</td>';
                print '</tr>';
                print '<tr>';
                print '<th scope="col">Group-Name</th>';            
                print '<th scope="col">Category-Name</th>';
                print '<th scope="col">Total Bill (Rs.)</th>';            
                print '</tr>';
                print '</thead>';
            
/*
$s = oci_parse($c, "select postal_code from locations");
oci_execute($s);
while ($row = oci_fetch_array($s, OCI_ASSOC)) {
 echo $row["POSTAL_CODE"] . "<br>\n";
}
*/
//            cat_name, count(*) tot_count
            
//                        while ($row_1 = oci_fetch_array($scount, OCI_RETURN_NULLS+OCI_ASSOC)) {
//                        print '<b>' . $row_1["CAT_NAME"] . " =  " . $row_1["TOT_COUNT"] . " ; " . '<b>';
//                        }
                        
            
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
    
        // Create connection to Oracle
        $c = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD");
        // Use bind variable to improve resuability, 
        // and to remove SQL Injection attacks.
    
        $query = "select hospcg, name party_name, sum(bill_grand_total) total_bill from view_wardbill_rgstrpat_01
                  where to_char(hbilldt,'YYYY-MM-DD') between :EIDBV and :EIDBV2 and hospcg='C'
                  group by hospcg, name 
                  order by hospcg, name desc";
    
//        $qcount = "select cat_name, count(*) tot_count from ward_admission_vw_grade 
//        where  to_char(admdate,'YYYY-MM-DD') between :EIDBV and :EIDBV2 group by cat_name";
    
        $s = oci_parse($c, $query);
//        $scount = oci_parse($c, $qcount);
    
        $myeid = $stdate;
        oci_bind_by_name($s, ":EIDBV", $myeid);
//        oci_bind_by_name($scount, ":EIDBV", $myeid);
    
        
        $myendt = $endate;
        oci_bind_by_name($s,":EIDBV2", $myendt);
//        oci_bind_by_name($scount, ":EIDBV2", $myeid);
 

    
        oci_execute($s);
//        oci_execute($scount);
    
    
//        while ($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) {
//            echo $row[0] . $row[1]. "<br>\n";
//              echo $row["HOSPNO"];
//        }
    
        do_fetch($myeid, $myendt,   $s);
    
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