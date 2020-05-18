<?php
    session_start();
?>

<html>
<head>
  <title>Radilogy: Report.</title>
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
  <h6>BGH Radiology</h6>
<div class="container">
<form  class="form-inline" name="myform" action="radiology_report_02.php" method="POST">
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
                            
    function do_fetch_xray($myeid, $myendt, $s)
        {
//            date("d/m/Y", strtotime($str));
             
                print '<table class="table table-sm table-bordered table-striped table-dark w-auto table-hover">';            
                print '<thead class="thead-light">';
                print '<tr>'; 
                print '<td colspan="9">' . 'Xray Done From : ' . date("d-m-Y", strtotime($myeid)) .  '  To Date : ' . date("d-m-Y", strtotime($myendt)) . '</td>';
                print '</tr>';
                print '<tr>';
                print '<th scope="col">XRAY For</th>';            
                print '<th scope="col">Total Xray Done</th>';
                print '</tr>';
                print '</thead>';
                          
                        $x = 0;
                        while ($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) 
                        {
                            $x = $x + $row["TOTAL_XRAY"];
                            
                            print '<tr class="bg-primary">';
                            foreach ($row as $item) 
                            {                                
                                print '<td style="text-align:right">'.($item?htmlentities($item):'&nbsp;').'</td>';
                                                                
                            }
                                print '</tr>';
                            }
                print '<tr>';
                        print '<td>' . 'Total Xray Done' .  '</td>';
//                        print '<td>' .  number_format($x,2,".",",") .  '</td>';
                        print '<td style="text-align:right">' .  $x .  '</td>';

            print '</tr>';   
                        $GLOBALS['gtotal'] = $GLOBALS['gtotal']  + $x;
            print '</table>';
//                print '<br>';
        }

    function do_fetch_ct($myeid, $myendt, $s)
        {
//            date("d/m/Y", strtotime($str));
             
                print '<table class="table table-sm table-bordered table-striped table-dark w-auto table-hover">';            
                print '<thead class="thead-light">';
                print '<tr>'; 
                print '<td colspan="9">' . 'CT Done From : ' . date("d-m-Y", strtotime($myeid)) .  '  To Date : ' . date("d-m-Y", strtotime($myendt)) . '</td>';
                print '</tr>';
                print '<tr>';
                print '<th scope="col">CT For</th>';            
                print '<th scope="col">Total CT Done</th>';
                print '</tr>';
                print '</thead>';
                          
                        $x = 0;
                        while ($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) 
                        {
                            $x = $x + $row["TOTAL_CT"];
                            
                            print '<tr class="bg-primary">';
                            foreach ($row as $item) 
                            {                                
                                print '<td style="text-align:right">'.($item?htmlentities($item):'&nbsp;').'</td>';
                                                                
                            }
                                print '</tr>';
                            }
                print '<tr>';
                        print '<td>' . 'Total CT Done' .  '</td>';
//                        print '<td>' .  number_format($x,2,".",",") .  '</td>';
                        print '<td style="text-align:right">' .  $x .  '</td>';

            print '</tr>';   
                        $GLOBALS['gtotal'] = $GLOBALS['gtotal']  + $x;
            print '</table>';
//                print '<br>';
        }

    function do_fetch_mri($myeid, $myendt, $s)
        {
//            date("d/m/Y", strtotime($str));
             
                print '<table class="table table-sm table-bordered table-striped table-dark w-auto table-hover">';            
                print '<thead class="thead-light">';
                print '<tr>'; 
                print '<td colspan="9">' . 'MRI Done From : ' . date("d-m-Y", strtotime($myeid)) .  '  To Date : ' . date("d-m-Y", strtotime($myendt)) . '</td>';
                print '</tr>';
                print '<tr>';
                print '<th scope="col">CT For</th>';            
                print '<th scope="col">Total CT Done</th>';
                print '</tr>';
                print '</thead>';
                          
                        $x = 0;
                        while ($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) 
                        {
                            $x = $x + $row["TOTAL_MRI"];
                            
                            print '<tr class="bg-primary">';
                            foreach ($row as $item) 
                            {                                
                                print '<td style="text-align:right">'.($item?htmlentities($item):'&nbsp;').'</td>';
                                                                
                            }
                                print '</tr>';
                            }
                print '<tr>';
                        print '<td>' . 'Total MRI Done' .  '</td>';
//                        print '<td>' .  number_format($x,2,".",",") .  '</td>';
                        print '<td style="text-align:right">' .  $x .  '</td>';

            print '</tr>';   
                        $GLOBALS['gtotal'] = $GLOBALS['gtotal']  + $x;
            print '</table>';
//                print '<br>';
        }

    function do_fetch_sono($myeid, $myendt, $s)
        {
//            date("d/m/Y", strtotime($str));
             
                print '<table class="table table-sm table-bordered table-striped table-dark w-auto table-hover">';            
                print '<thead class="thead-light">';
                print '<tr>'; 
                print '<td colspan="9">' . 'USG Done From : ' . date("d-m-Y", strtotime($myeid)) .  '  To Date : ' . date("d-m-Y", strtotime($myendt)) . '</td>';
                print '</tr>';
                print '<tr>';
                print '<th scope="col">USG For</th>';            
                print '<th scope="col">Total USG Done</th>';
                print '</tr>';
                print '</thead>';
                          
                        $x = 0;
                        while ($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) 
                        {
                            $x = $x + $row["TOTAL_SONO"];
                            
                            print '<tr class="bg-primary">';
                            foreach ($row as $item) 
                            {                                
                                print '<td style="text-align:right">'.($item?htmlentities($item):'&nbsp;').'</td>';
                                                                
                            }
                                print '</tr>';
                            }
                print '<tr>';
                        print '<td>' . 'Total MRI Done' .  '</td>';
//                        print '<td>' .  number_format($x,2,".",",") .  '</td>';
                        print '<td style="text-align:right">' .  $x .  '</td>';

            print '</tr>';   
                        $GLOBALS['gtotal'] = $GLOBALS['gtotal']  + $x;
            print '</table>';
//                print '<br>';
        }
    
    
        // Create connection to Oracle
        $c = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD"); 
        $query = "select io_status, count(distinct xray_no) total_xray 
                  from bgh_xray_forbill_vw
                  where to_char(xray_date,'YYYY-MM-DD') between :EIDBV and :EIDBV2
                  group by io_status";    
       
        $s = oci_parse($c, $query);    
        
        $myeid = $stdate;
        oci_bind_by_name($s, ":EIDBV", $myeid);    
        
        $myendt = $endate;
        oci_bind_by_name($s, ":EIDBV2", $myendt);       
    
        oci_execute($s);

        do_fetch_xray($myeid, $myendt, $s);
        oci_close($c);

    // for CT
        $c = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD"); 
        $query = "select io_status, count(distinct ct_no) total_ct 
                  from bgh_ct_forbill_vw
                  where to_char(ct_date,'YYYY-MM-DD') between :EIDBV and :EIDBV2
                  group by io_status";    
       
        $s = oci_parse($c, $query);    
        
        $myeid = $stdate;
        oci_bind_by_name($s, ":EIDBV", $myeid);    
        
        $myendt = $endate;
        oci_bind_by_name($s, ":EIDBV2", $myendt);       
    
        oci_execute($s);

        do_fetch_ct($myeid, $myendt, $s);
        oci_close($c);

       // for MRI
        $c = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD"); 
        $query = "select io_status, count(distinct mri_no) total_mri 
                  from bgh_mri_forbill_vw
                  where to_char(mri_date,'YYYY-MM-DD') between :EIDBV and :EIDBV2
                  group by io_status";    
       
        $s = oci_parse($c, $query);    
        
        $myeid = $stdate;
        oci_bind_by_name($s, ":EIDBV", $myeid);    
        
        $myendt = $endate;
        oci_bind_by_name($s, ":EIDBV2", $myendt);       
    
        oci_execute($s);

        do_fetch_mri($myeid, $myendt, $s);
        oci_close($c);
       // for SONO
        $c = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD"); 
        $query = "select io_status, count(distinct sono_no) total_sono 
                  from bgh_sono_forbill_vw
                  where to_char(sono_date,'YYYY-MM-DD') between :EIDBV and :EIDBV2
                  group by io_status";    
       
        $s = oci_parse($c, $query);    
        
        $myeid = $stdate;
        oci_bind_by_name($s, ":EIDBV", $myeid);    
        
        $myendt = $endate;
        oci_bind_by_name($s, ":EIDBV2", $myendt);       
    
        oci_execute($s);

        do_fetch_sono($myeid, $myendt, $s);
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