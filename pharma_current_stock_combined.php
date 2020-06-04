<?php
    session_start();
?>

<html>
<head>
  <title>Current Stock of SUbstore, Pharmacy, WMS</title>
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
  <h6>Current Stock of SubStore, All Counters and Ward Medical Store</h6>
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
                    print '<td colspan="9">' . 'Current Stock of SubStore, All Counters and Ward Medical Store' . '</td>';
                    print '</tr>';
                    print '<tr>';
                    print '<th scope="col">Drug Code</th>';            
                    print '<th scope="col">Med Gen Name</th>';
                    print '<th scope="col">Unit</th>';
                    print '<th scope="col" class="text-center bg-primary">SubStore-Stock</th>';
                    print '<th scope="col" class="text-center bg-success">AllCtr-Stock</th>';
                    print '<th scope="col" class="text-center bg-warning">WMS-Stock</th>';
                    print '<th scope="col" class="text-center bg-info">Total-Stock</th>';
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
                                print '<tr class="bg-info">';
                            }
                            $keys = array_keys($row);
                           

                            foreach ($row as $item) 
                            {     
                               
                                //print $keys[0];    
                                if ($row["SUBSTORE_STOCK"]==$item) {
                                    print '<td class="text-center bg-primary">'.($item?htmlentities($item):'&nbsp;').'</td>';
                                }
                                elseif ($row['ALL_CTR_STOCK']==$item){
                                    print '<td class="text-center bg-success">'.($item?htmlentities($item):'&nbsp;').'</td>';
                                }
                                elseif ($row['WMS_STOCK']==$item){
                                    print '<td class="text-center bg-warning">'.($item?htmlentities($item):'&nbsp;').'</td>';
                                }
                                elseif ($row['TOTAL_STOCK']==$item){
                                    print '<td class="text-center bg-info">'.($item?htmlentities($item):'&nbsp;').'</td>';
                                }
                                else {
                                    print '<td class="text-center bg-info">'.($item?htmlentities($item):'&nbsp;').'</td>';
                                }


                                                                
                            }
                                print '</tr>';
                            }
            print '</table>';
            print '</div>';
        }

    
        // Create connection to Oracle
        $c = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD"); 
        $query = "select a.drug_code, a.med_desc, a.unit, 
                  a.current_stock substore_stock, b.all_ctr_stock all_ctr_stock, c.total_stock wms_stock,
                  (a.current_stock + b.all_ctr_stock + c.total_stock) total_stock 
                  from  
                    pharma_substore_stock_view@bgh6_dblink a, 
                    pharma_allctr_stock_view@bgh6_dblink   b,
                    pharma_wms_stock_view                  c
                where a.drug_code=b.drug_code and
                      a.drug_code=c.drug_code";    
       
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