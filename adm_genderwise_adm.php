<?php
    session_start();
?>

<html>
<head>
  <title>IPD: Gender Wise Admission</title>
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
 <a class="navbar-brand" href="bgh_main.php"><img src="sail-logo.jpg" width="40" height="40" alt="BGH-MAIN"></a> 
  <h6>BGH IPD GenderWise Admissions</h6>
<div class="container">
<form  class="form-inline" name="myform" action="adm_genderwise_adm.php" method="POST"> <input type="hidden" name="check_submit" value="1" />     
  
<div class="form-group">  
        <label for="stdate">Admission Start Date</label>  
        <input class="form-control mr-sm-2" type="date"   id="stdate" name="stdate" placeholder="fromDate" aria-label="stdate" value="<?php echo isset($_POST['stdate']) ? $_POST['stdate']:''; ?>">
    </div>     
         
         
    <div class="form-group">  
        <label for="endate">Admission To Date</label>  
        <input class="form-control mr-sm-2" type="date" id="endate" name="endate" placeholder="ToDate"   aria-label="todate" value="<?php echo isset($_POST['endate']) ? $_POST['endate']:''; ?>">
    </div>  
          
    <button class="btn btn-success my-2 my-sm-0" type="submit" name="submit">Get Data...</button>
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
            
    
        function do_fetch($myeid, $myendt, $qtype,  $s)
        {
//            date("d/m/Y", strtotime($str));
             
                print '<table class="table table-sm table-bordered table-striped table-dark w-auto table-hover">';            
                print '<thead class="thead-light">';
                print '<tr>'; 
                print '<td colspan="9">' . 'Gender Wise Admission From : ' . date("d-m-Y", strtotime($myeid)) .  '  To Date : ' . date("d-m-Y", strtotime($myendt)) . '</td>';
                print '</tr>';
                print '<tr>';
                if ($qtype=='g1'){
                        print '<th scope="col">Gender</th>';
                        print '<th scope="col">Total Admissions</th>';
                }
                elseif ($qtype=='g2'){
                    print '<th scope="col">Gender</th>';
                    print '<th scope="col">EntitleMent</th>';
                    print '<th scope="col">Total Admissions</th>';
                }
                print '</tr>';
                print '</thead>';
                          
                        $x = 0;
                        $gtotal = 0;
                        while ($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) 
                        {
                            $x = $x + 1;
                            $gtotal = $gtotal + $row["TOT_COUNT"];
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
                if ($qtype=='g1'){                        
                    print '<td>' . 'Total' .  '</td>';
                    print '<td>' .  $gtotal .  '</td>';
                }
                elseif($qtype=='g2'){
                    print '<td colspan="2">' . 'Total' .  '</td>';
                    print '<td>' .  $gtotal .  '</td>';

                }

                print '</tr>';   
            print '</table>';
                

                print '<br>';
        }
   
  
    
        // Create connection to Oracle
        $c = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD"); 
        $qtype = 'g1';
        $query = "select decode(pat_sex,'M','Male', 'F','Female', 'N', 'New Born') pat_sex,  count(*) tot_count
                  from WARD_ADMISSION_VW
                  where to_char(admdate,'YYYY-MM-DD') between :EIDBV and :EIDBV2 
                  group by pat_sex
                  order by 1";
    
    
        $s = oci_parse($c, $query);    
        $myeid = $stdate;
        oci_bind_by_name($s, ":EIDBV", $myeid);
    
        
        $myendt = $endate;
        oci_bind_by_name($s,":EIDBV2", $myendt);
 
       
    
        oci_execute($s);
        do_fetch($myeid, $myendt, $qtype,  $s);
        // Entitlement wise male female distribution
        $qtype = 'g2';
        $query = "select decode(pat_sex,'M','Male', 'F','Female', 'N', 'New Born') pat_sex ,decode(ent_nonent,'Y', 'Entitled', 'N', 'Non-Entitled', 'P', 'Ayushman') ent, 
                  count(*) tot_count from WARD_ADMISSION_VW
                  where to_char(admdate,'YYYY-MM-DD') between :EIDBV and :EIDBV2 
                  group by pat_sex, ent_nonent
                  order by 1";
    
    
        $s = oci_parse($c, $query);    
        $myeid = $stdate;
        oci_bind_by_name($s, ":EIDBV", $myeid);
    
        
        $myendt = $endate;
        oci_bind_by_name($s,":EIDBV2", $myendt);
 
       
    
        oci_execute($s);
        do_fetch($myeid, $myendt, $qtype, $s);

        
        
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