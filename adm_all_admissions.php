<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>

<!-- working
<script>
    $(document).ready( function () {
        var table = $('#example').DataTable();
      } );
</script>      
-->
<script>
    $(document).ready( function () {
        var table = $('#example').DataTable({ fixedHeader: true});
      } );
</script>      


<!--
$('#myTable').DataTable( {
    fixedHeader: true
} );
-->

<style>
    body 
    {
        font: 90%/1.45em "Helvetica Neue", HelveticaNeue, Verdana, Arial, Helvetica, sans-serif;
        margin: 0;
        padding: 0;
        color: #333;
        background-color: #fff;
    }
</style>

    <meta charset=utf-8 />
    <title>IPD - Admissions Between Two Dates</title>
  </head>
  <body>




<!--<div class="container"> -->
<nav class="navbar navbar-dark fixed-top" style="background-color: #0040ff; height:50px; position: absolute;">
<form  class="form-inline" name="myform" action="adm_all_admissions.php" method="POST"> <input type="hidden" name="check_submit" value="1" />     
  
<div class="form-group">  
        <label for="stdate">----------->Admission Start Date</label>  
        <input class="form-control mr-sm-2" type="date"   id="stdate" name="stdate" placeholder="fromDate" aria-label="stdate" value="<?php echo isset($_POST['stdate']) ? $_POST['stdate']:''; ?>">
    </div>     
         
    <div class="form-group">  
        <label for="endate">----------->Admission To Date</label>  
        <input class="form-control mr-sm-2" type="date" id="endate" name="endate" placeholder="ToDate"   aria-label="todate" value="<?php echo isset($_POST['endate']) ? $_POST['endate']:''; ?>">
    </div>  
          
    <button class="btn btn-success my-2 my-sm-0" type="submit" name="submit">Get Data...</button>
</form>
</nav>
<br><br><br>


<?php
if (array_key_exists('check_submit', $_POST)) 
{
  if (isset($_POST['stdate'])){$stdate    =  $_POST['stdate'];}
  if (isset($_POST['endate'])){$endate    =  $_POST['endate'];}
         
        function do_fetch($mystdate, $myendate, $s)
        {
            //Fetch the results in an associative array
            //print '<p>$myeid is ' . $myeid . '</p>';
            //print '<p>Data Showing For the Date:' . $myeid . '</p>';
            // <table class="table table-dark">
            // print '<table class="table table-sm table-bordered table-striped table-dark w-auto"  border="1">';
            
//            print '<table id="example" class="display" style="width:100%">';
//            print '<table id="example" class="table table-striped table-bordered" style="width:100%">';                
            print '<table id="example" class="display nowrap table-bordered" width="100%">';          
//            print '<tr>'; 
//              print '<td  colspan="9">' . 'Admission Data From : ' . date('d-m-Y', strtotime($mystdate)) . ' To '. date('d-m-Y', strtotime($myendate)) .  '</td>';
//            print '</tr>';  
            print '<thead>';           
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

            print '<tfoot>';           
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
            print '</tfoot>';   
            
            
            print '<tbody>';    
                        while ($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) 
                        {
                            print '<tr>';
                            foreach ($row as $item) 
                            {
                                print '<td>'.($item?htmlentities($item):'&nbsp;').'</td>';
                                
                            }
                                print '</tr>';
                            }
                print '</tbody>';            
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
//        do_fetch($s);
    

        // Close the Oracle connection
        oci_close($c);

} 
else 
{
    
}
?> 


<!--
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
-->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>  

<!-- </div> -->   
</body>
</html>