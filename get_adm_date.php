<html>
<head>
  <title>Process the HTML form data with the POST method</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>


<nav class="navbar navbar-dark fixed-top bg-warning">
 <a class="navbar-brand" href="bgh_main.php"><img src="sail-logo.jpg" width="40" height="40" alt="BGH-MAIN"></a> 
  <h6>BGH IPD Admissions Data</h6>
<div class="container">
<form  class="form-inline" name="myform" action="get_adm_date.php" method="POST"> <input type="hidden" name="check_submit" value="1" />     
  
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
if (array_key_exists('check_submit', $_POST)) 
{
  if (isset($_POST['stdate'])){$stdate    =  $_POST['stdate'];}
  if (isset($_POST['endate'])){$endate    =  $_POST['endate'];}
         
   //Let's now print out the received values in the browser
   //   echo "Your name: {$_POST['Name']}<br />";
   //   echo "Selected Date : {$_POST['stdate']}<br />";
   //echo $stdate;

        function do_fetch($mystdate, $myendate, $s)
        {
            //Fetch the results in an associative array
            //print '<p>$myeid is ' . $myeid . '</p>';
            //print '<p>Data Showing For the Date:' . $myeid . '</p>';
            // <table class="table table-dark">
                print '<table class="table table-sm table-bordered table-striped table-dark w-auto"  border="1">';
            
            print '<thead>';
            
            print '<tr>'; 
                print '<td  colspan="9">' . 'Admission Data From : ' . date('d-m-Y', strtotime($mystdate)) . ' To '. date('d-m-Y', strtotime($myendate)) .  '</td>';
            print '</tr>';
            
            print '<tr>';
                print '<th scope="col">HospNo</th>';
                print '<th scope="col">PatName</th>';
                print '<th scope="col">Age</th>';
                print '<th scope="col">Gender</th>';            
                print '<th scope="col">From</th>';
                print '<th scope="col">AdmDate</th>';
                print '<th scope="col">Time</th>';
                print '<th scope="col">Ent</th>';            
                print '<th scope="col">ML</th>';
                print '<th scope="col">Address</th>';
                print '<th scope="col">Unit</th>';            
                print '<th scope="col">ProvDiag</th>';            


            print '</tr>';
            print '</thead>';
            
            
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

        $query = "select (hospno||'/'||hospyr) hospno, pat_name, pat_age,pat_sex gender, 
                  pfrom1, admdate, admtime, ent_nonent ent, medlegal,pat_local_add, pat_admit_unit, 
                  pat_provdiag 
                  from WARD_ADMISSION_VW 
                  where to_char(admdate,'YYYY-MM-DD') between :EIDBV and :EIDBV1 order by hospno";
        $s = oci_parse($c, $query);

        $mystdate = $stdate;
        oci_bind_by_name($s, ":EIDBV", $mystdate);

        $myendate = $endate;
        oci_bind_by_name($s, ":EIDBV1", $myendate);
// Execute the query
        oci_execute($s);
// fecth data
        do_fetch($mystdate, $myendate, $s);
    

        // Close the Oracle connection
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