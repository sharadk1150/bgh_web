<?php
    session_start();
?>

<html>
<head>
  <title>Pharma Medicine Master for OPD</title>
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
  <h6>BGH Pharmacy Substore Current Stock</h6>
</nav>
<br><br>
<?php

    function do_fetch_med($s)
        {
//            date("d/m/Y", strtotime($str));
             
                print '<table class="table table-sm table-bordered table-striped table-dark w-auto table-hover">';   
                    print '<thead class="thead-light">';
        
                    print '<tr>'; 
                    print '<td colspan="9">' . 'Medicine Master List' . '</td>';
                    print '</tr>';
                    print '<tr>';
                    print '<th scope="col">Drug Code</th>';            
                    print '<th scope="col">Med Gen Name</th>';
                    print '<th scope="col">Unit</th>';
                    print '<th scope="col">Current Stock</th>';
                    print '</tr>';
                    print '</thead>';
              
                          
                        $x = 0;
                        while ($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) 
                        {
                            $x = $x + 1;
                            
                            if ($x%2==0) 
                            {                            
                                print '<tr class="bg-primary">';
                            }
                            else
                            {
                                print '<tr class="bg-information">';
                            }
                            foreach ($row as $item) 
                            {                                
                                print '<td>'.($item?htmlentities($item):'&nbsp;').'</td>';
                                                                
                            }
                                print '</tr>';
                            }
            print '</table>';
        }

    
        // Create connection to Oracle
        $c = oci_connect("BGH", "hpv185e", "10.143.100.36/BGH6"); 
        $query = "select drug_code, med_desc, unit, current_stock from pharma_substore_stock_view
        order by med_desc";    
       
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