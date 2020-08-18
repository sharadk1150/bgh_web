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
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">

  <style>
     .hgp{
         text-align: center;
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
  <h6>BGH Employees's </h6>
        <input class="form-control mr-sm-2" type="date"   id="stdate" name="stdate" placeholder="fromDate" aria-label="stdate" value="<?php echo isset($_POST['stdate']) ? $_POST['stdate']:''; ?>">
    </div>     
         
         
    <div class="form-group">  
        <label for="endate">To Date</label>  
        <input class="form-control mr-sm-2" type="date" id="endate" name="endate" placeholder="ToDate"   aria-label="todate" value="<?php echo isset($_POST['endate']) ? $_POST['endate']:''; ?>">
    </div>  
          
    <button class="btn btn-success my-2 my-sm-0" type="submit" name="submit">Get Data...</button>
</form>
</div>
</nav>
<br><br><br>

</div>    
</nav>

<!-- Nav Bar for position at the top of page-->      

<br><br><br>
<?php

if (array_key_exists('check_submit', $_POST)) 
{
    
                
                if (isset($_POST['gradep'])){$gradep    =  $_POST['gradep'];}



        function do_fetch($mygradep, $s)            
            {
                print '<table class="table table-sm table-bordered table-striped table-dark w-auto table-hover">';            
                print '<thead class="thead-light">';
                print '<tr>'; 
                print '<td class="hgp" colspan="9">' . '<h3>' . 'BGH On Roll Staff  For Grade ' .  $mygradep .  '</h3>' . '</td>';
                print '</tr>';
                print '<tr>';
                print '<th scope="col">Name</th>';
                print '<th scope="col">StNo</th>';
                print '<th scope="col">Gradep</th>';
                print '<th scope="col">Desig</th>';
                print '<th scope="col">Mobile</th>';
                print '<th scope="col">Email</th>';
                print '<th scope="col">Blood</th>';
                print '</thead>';
            
//                        $tot_claims=0;
//                        $tot_rec=0;
// Print the data in Table            
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
//                            Print '<tr>';
//                                    print '<td colspan="3">' . 'Totals' . '</td>';
//                                    print '<td>' . $tot_claims . '</td>';
//                                    print '<td>' . $tot_rec . '</td>';
//                            print '</tr'>

                print '</table>';
        }
    
    
        // Create connection to Oracle
        $c = oci_connect("bgh", "hpv185e", "10.143.100.36/BGH6");
        // Use bind variable to improve resuability, 
        // and to remove SQL Injection attacks.

    
        $query = "select name, stno, gradep, desdescp, mob, email, blood
                  from bgh_employee_view 
                  where gradep=:EIDBV
                  order by name";
    
//        $qcount = "select sum(tot_rate) TOT_VALUE from BGH_MED_STOCK_ISSUE_VW 
//        where  ctrno = '20' and to_char(issue_dt,'YYYY-MM-DD') between :EIDBV and :EIDBV2";
    
        $s = oci_parse($c, $query);
//        $scount = oci_parse($c, $qcount);
    
         $mygradep = $gradep;
        oci_bind_by_name($s, ":EIDBV", $mygradep);
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
    
        do_fetch($mygradep, $s);
        oci_close($c);


    }
?> 
 
<script src="node_modules/jquery/dist/jquery.min.js"></script>
<script src="node_modules/popper.js/dist/popper.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>