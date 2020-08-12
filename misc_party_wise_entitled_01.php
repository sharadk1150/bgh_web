<?php
    session_start();
?>

<html>
<head>
    <title>Party Wise Entitled</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<style>    
.chart-container {
  width: 80%;
  height: 480px;
  margin: 0 auto;
}

.pie-chart-container {
  height: 360px;
  width: 360px;
  float: left;
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
<div class="container">
<h3> Entitled Patient's : </h3>
</div>
</nav>

<div class="row row-cols-1 row-cols-md-3">
<br><br><br>
<?php    
global $gtotal;
$gtotal =0;    
        function do_fetch($s)
        {
                print '<div class="col mb-2">';
                print '<div class="card" style="width:100rem;">';
//                print '<div class="card  text-white bg-primary h-100">';
                print '<div class="card-body">';
                print '<table class="table table-sm table-bordered table-striped table-dark w-auto table-hover">';            
                print '<thead class="thead-light">';
                print '<tr>'; 
                print '<td colspan="9">' . 'Party Wise Count'. '</td>';
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
            print '<div>';
            print '<div>';
            print '<div>';

                

                print '<br>';
        }
       
?>   
        <div class="col mb-2">
        <div class="card" style="width:50rem;">
<!--            <div class="card text-white bg-warning  h-100 w-100rem">           -->
            <div class="card-body">
                <div id="chart-container">
                    <canvas id="mycanvas"></canvas>        
                </div>
            </div>    
            </div>    
    </div>

<?php    
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


    
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>  
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script type="text/javascript" src="app_data_misc_party_wise.js"></script>

</body>
</html>