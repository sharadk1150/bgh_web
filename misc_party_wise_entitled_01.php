<?php
    session_start();
?>

<html>
<head>
  <title>Party Wise Entitled</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  
<style type="text/css">
        #chart-container {
            width: 800px;
            height: auto;
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
    
<!-- <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
.navbar-expand{-sm|-md|-lg|-xl}
  -->
 
 <nav class="navbar navbar-dark fixed-top bg-warning">
  <h6>BGH Party Wise Entitled Strength</h6>
  </nav>
<div class="container">

<br><br><br>

    <div id="chart-container">
        <canvas id="mycanvas"></canvas>
        
    </div>




<br><br><br>

<?php
    
global $gtotal;
$gtotal =0;    
    

    
        function do_fetch($s)
        {
//            date("d/m/Y", strtotime($str));
             
                print '<table class="table table-sm table-bordered table-striped table-dark w-auto table-hover">';            
                print '<thead class="thead-light">';
                print '<tr>'; 
                print '<td colspan="9">' . 'Employee Data'. '</td>';
                print '</tr>';
                print '<tr>';
                print '<th scope="col">Party Code</th>';
                print '<th scope="col">Party Name</th>';
                print '<th scope="col">Total Count</th>';

                print '</tr>';
                print '</thead>';
                          
                        $x = 0;
                        $gtotal = 0;
                        while ($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) 
                        {
                            $x = $x + 1;
                            $gtotal = $gtotal + $row["TOTAL"];
                            if ($x%2==0) {
                                print '<tr class="bg-primary">';}
                            else {
                                print '<tr class="bg-information">';}                                
                            
                            foreach ($row as $item) 
                            {                                
                                print '<td>'.($item?htmlentities($item):'&nbsp;').'</td>';
                                                                
                            }
                                print '</tr>';
                            }
                print '<tr>';
                        print '<td colspan="2">' . 'Total ' .  '</td>';
                        print '<td>' .  (int)$gtotal .  '</td>';
                print '</tr>';   
            print '</table>';
                

                print '<br>';
        }
   
       
    
        // Create connection to Oracle
        $c = oci_connect("BGH", "hpv185e", "10.143.100.36/BGH6"); 
        $query = "select a.party_code party_code, 
                  b.party_full_name party_name, count(*) total 
                  from bgh_mid_employee a, bgh_party_master b
                  where a.party_code=b.party_code 
                  group by a.party_code, b.party_full_name 
                  order by 1";
    
    
        $s = oci_parse($c, $query);    
    
        oci_execute($s);
        do_fetch($s);
        oci_close($c);

?>


</div>   
    
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>  
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script type="text/javascript" src="app_data_misc_party_wise.js"></script>

</body>
</html>