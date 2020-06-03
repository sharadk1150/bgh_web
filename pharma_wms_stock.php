<?php
    session_start();
?>

<html>
<head>
  <title>WMS Current Stock</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

>    

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
  <h6>WMS Current Stock</h6>
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
   
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>  
</body>
</html>