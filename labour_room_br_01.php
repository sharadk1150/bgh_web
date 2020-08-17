<?php
/*
  This Program displays the counterwise expiry, damage and breakage entry for a fiancual year
  Same program if selected ALL in the counter list displays the consolidated List
*/
    session_start();
?>

<html>
<head>
  <title>Birth Report Summary</title>
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
<style> 
    .navbar 
       { 
            position: absolute; 
            height: 50px;
            background-color: bisque;
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

    
<nav class="navbar navbar-dark fixed-top">

<div class="container">  
<form  name="myform" action="labour_room_br_01.php" method="POST"> <input type="hidden" name="check_submit" value="1" />     
<form class="form-inline">   
 
     <div class="form-group row">         
           
      <label for="fyyr" class="mr-sm-3 col-form-label">Birth Report for the Year:</label>
      <div class="mr-sm-4">
      <select id="fyyr" name="fyyr" class="form-control">       
<?php
          
            $c = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD");
            $sql = "select distinct year from labour_room_stats_yearly_vw order by 1";  
            echo $sql;
            $stid = oci_parse($c, $sql);  
            $success = oci_execute($stid);
                while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)){
                print '<option> ' . $row["YEAR"] . '</option>';
            }  
            oci_close($c);  
?>                    
      </select>
      </div> 
       
        <button type="submit" name="submit" class="btn btn-primary">Get Data....</button>     
               
    
    </div>
    
    </form>
</form>
 </div>  
</nav>
 

<br><br><br>

<?php
if (array_key_exists('check_submit', $_POST)) 
{
    
                
                if (isset($_POST['fyyr'])){$fyyr    =  $_POST['fyyr'];}
    
        function do_fetch($myfinyr,  $s)            
            {
                print '<table class="table table-sm table-bordered table-striped table-dark w-auto table-hover">';            
                print '<thead class="thead-light">';
                print '<tr>'; 
                print '<td colspan="9">' . 'Birth Summary For : ' . $myfinyr . '</td>';
                print '</tr>';
                print '<tr>';
                print '<th scope="col">Year</th>';
                print '<th scope="col">Gender</th>';
                print '<th scope="col">Total Count</th>';
                print '</thead>';
            

// Print the data in Table            
                        while ($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) 
                        {                            
                            print '<tr>';

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

  
    
        $query = "select year, baby_gender, total_count
                  from labour_room_stats_yearly_vw where year=:EIDBV order by 2";
    
//        $qcount = "select sum(tot_rate) TOT_VALUE from BGH_MED_STOCK_ISSUE_VW 
//        where  ctrno = '20' and to_char(issue_dt,'YYYY-MM-DD') between :EIDBV and :EIDBV2";
    
        $s = oci_parse($c, $query);
//        $scount = oci_parse($c, $qcount);
    
        $myfinyr = $fyyr;
        oci_bind_by_name($s, ":EIDBV", $myfinyr);
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
    
        do_fetch($myfinyr,  $s);
        oci_close($c);

} 
else 
{
    
}
?> 
 
<script src="node_modules/jquery/dist/jquery.min.js"></script>
<script src="node_modules/popper.js/dist/popper.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>