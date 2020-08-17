<?php
    session_start();
?>

<html>
<head>
  <title>WMS Current Stock</title>
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
    
<nav class="navbar navbar-dark fixed-top bg-warning">
 <a class="navbar-brand" href="bgh_main.php"><img src="sail-logo.jpg" width="40" height="40" alt="BGH-MAIN"></a> 
 <div class="container">
    <h2>BGH Pharmacy Ward Medical Store Stock</h3>
 </div>   
</nav>
<br><br>

<?php

    function do_fetch_med($s)
        {
//            date("d/m/Y", strtotime($str));
                    print '<div class="container">';
                    print '<table class="table table-sm table-bordered table-striped table-dark w-auto table-hover">';   
                    print '<thead class="thead-light">';
        
                    print '<tr>'; 
                    print '<td colspan="9">' . 'WMS Stock' . '</td>';
                    print '</tr>';
                    print '<tr>';
                    print '<th scope="col">Drug Code</th>';            
                    print '<th scope="col">Med Gen Name</th>';
                    print '<th scope="col">Unit</th>';
                    print '<th scope="col">MedGroup</th>';
                    print '<th scope="col">WMS Stock</th>';
                    print '</tr>';
                    print '</thead>';
              
                          
                        $x = 0;
                        while ($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) 
                        {
                            $x = $x + 1;
                            
                            if ($x%2==0) 
                            {                            
                                print '<tr class="bg-success">';
                            }
                            else
                            {
                                print '<tr class="bg-primary">';
                            }
                            foreach ($row as $item) 
                            {                                
                                print '<td>'.($item?htmlentities($item):'&nbsp;').'</td>';
                                                                
                            }
                                print '</tr>';
                            }
            print '</table>';
            print '</div>';
        }

    
        // Create connection to Oracle
        $c = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD"); 
        $query = "select a.item_code, b.med_gen_name, unit, med_group, 
                  (a.total_rcv+a.yr_corr)-(a.total_issue+a.total_damage) total_stock 
                   from wms_stock a,
                   bgh_med_master b 
                   where a.item_code=substr(old_cat_no,7)";    
       
        $s = oci_parse($c, $query);    
    
        oci_execute($s);

        do_fetch_med($s);
        oci_close($c);
?> 
   
<script src="node_modules/jquery/dist/jquery.min.js"></script>
<script src="node_modules/popper.js/dist/popper.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>