<?php
/*
  This Program displays the counterwise expiry, damage and breakage entry for a fiancual year
  Same program if selected ALL in the counter list displays the consolidated List
*/
    session_start();
?>

<html>
<head>
  <title>Misc. List Of Doctor's</title>
<!--
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
-->

<link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="node_modules/datatables.net-bs4/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="node_modules/datatables.net-dt/css/jquery.dataTables.min.css">



<style>
    body 
    {
    font: 90%/1.45em "Helvetica Neue", HelveticaNeue, Verdana, Arial, Helvetica, sans-serif;
    margin: 5;
    padding: 5;
    color: #333;
    background-color: #fff;
    }

    <div class="datatable-wide">
        <table ...>
        </table>
    </div>
 
    div.datatable-wide {
        padding-left: 5px;
        padding-right: 5px;
    }
</style>




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

<nav class="navbar navbar-dark fixed-top bg-warning">
<a class="navbar-brand" href="bgh_main.php"><img src="sail-logo.jpg" width="40" height="40" alt="BGH-MAIN"></a> 
  <h6>BGH IPD Mediclaim Processing</h6>
    <div class="container">
        <h3>Online Claims Processing Status (Data From TPA's Web Site)</h3>
    </div>        
</nav>
<br><br><br>


<?php

    
        function do_fetch($s)            
            {
                print '<div class="datatable-wide">';
                print '<table class="table table-striped  table-bordered mydatatable" style="width:100%">';            
                print '<thead>';
                print  '<tr>';
                    print '<th>RepDate</th>';
                    print '<th>Under Process</th>';
                    print '<th>Under Process Amount</th>';
                    print '<th>Under ADR</th>';
                    print '<th>ADR-Amount</th>';
                    print '<th>Claims Paid</th>';
                    print '<th>Claims Paid Amount</th>';
                    print '<th>Claims Repudiated</th>';
                    print '<th>Repudiated Claim Amount</th>';
                    print '<th>Claims Pending</th>';
                    print '<th>Pending Amount </th>';
                    print '<th>Total Claims</th>';
                    print '<th>Total Claims Amount</th>';
                print  '</tr>';
                    print '</thead>';
                    print '<tfoot>';
                    print  '<tr>';
                    print '<th>RepDate</th>';
                    print '<th>Under Process</th>';
                    print '<th>Under Process Amount</th>';
                    print '<th>Under ADR</th>';
                    print '<th>ADR Amount</th>';
                    print '<th>Claims Paid</th>';
                    print '<th>Claims Paid Amount</th>';
                    print '<th>Claims Repudiated</th>';
                    print '<th>Repudiated Claim Amount</th>';
                    print '<th>Claims Pending</th>';
                    print '<th>Pending Amount </th>';
                    print '<th>Total Claims</th>';
                    print '<th>Total Claims Amount</th>';
            print  '</tr>';
                print '</tfoot>';


// Print the data in Table    
                        print '<tbody>';
                        while ($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) 
                        {      
//                            $tot_claims = $tot_claims + $row["NO_OF_CLAIM"];                      
//                            $tot_rec    = $tot_rec    + $row["CLAIM_AMT"];                      
                            print '<tr>';

                            foreach ($row as $item) 
                            { 
                                
                                print '<td>'.($item?htmlentities($item):'&nbsp;').'</td>';
                                                                
                            }
                                print '</tr>';
                            }

                print '<tbody>';

                print '</table>';
                print '</div>';
        }
    
    
        // Create connection to Oracle
        $c = oci_connect("ward", "hpv185e", "10.143.55.53/BGHWARD");
        // Use bind variable to improve resuability, 
        // and to remove SQL Injection attacks.
        $query = "  select 
                    REP_DATE, 
                    UNDER_PROCESS_NUMBER, 
                    UNDER_PROCESS_AMOUNT, 
                    ADR_NO, 
                    ADR_AMOUNT, 
                    PAID_CLAIM_NO, 
                    PAID_CLAIM_AMOUNT, 
                    REPUDIATED_CLAIM_NO, 
                    REPUDIATED_CLAIM_AMOUNT, 
                    PENDING_FOR_PAYMENT_NO, 
                    PENDING_FOR_PAYMENT_AMOUNT, 
                    TOTAL_NO, 
                    TOTAL_AMOUNT
                    from MDI_MEDICLAIM_PROCESSING
                    order by 1 desc";
    
//        $qcount = "select sum(tot_rate) TOT_VALUE from BGH_MED_STOCK_ISSUE_VW 
//        where  ctrno = '20' and to_char(issue_dt,'YYYY-MM-DD') between :EIDBV and :EIDBV2";
    
        $s = oci_parse($c, $query);
//        $scount = oci_parse($c, $qcount);
    
//        $myfinyr = $fyyr;
//        oci_bind_by_name($s, ":EIDBV", $myfinyr);
//        oci_bind_by_name($scount, ":EIDBV", $myeid);
    
        
//        $mylab = $lab;
//        oci_bind_by_name($s, ":EIDBV2", $mylab);
//        oci_bind_by_name($scount, ":EIDBV2", $myendt);
    
        oci_execute($s);
//        oci_execute($scount);
    
/*   
        while ($row_1 = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) {
            echo $row_1[0] . $row_1[1]. "<br>\n";
              echo $row_1["tot_value"];
        }
*/        
    
        do_fetch($s);
        oci_close($c);



?> 

<!--
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
-->
<!-- This was working and has been replaced with local cdn
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>  
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.bootstrap4.min.js"></script>
-->

<script src="node_modules/jquery/dist/jquery.min.js"></script>
<script src="node_modules/popper.js/dist/popper.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>





<!-- Working Fine Option 1  
<script>
        $(document).ready( function () {
        $('.mydatatable').DataTable();
    });
</script>
-->



<script>
        $(document).ready( function () {
        $('.mydatatable').DataTable({
            pagingType: 'full_numbers',
            "scrollY": "500px",
            "scrollX": true,
            "scrollCollapse": true,
            "paging": false,
            "fixedColumns":   true
        });
    });
</script>


<!-- The following is working 

<script>
        $(document).ready( function () {
        $('.mydatatable').DataTable({
            "scrollY": "500",
            "scrollX": true,

            "scrollCollapse": true,
            "paging": false
        });
    });
</script>
-->





</body>
</html>