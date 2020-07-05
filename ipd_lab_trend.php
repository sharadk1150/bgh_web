<!DOCTYPE html>
<html>
  <head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />


<style>
    body 
    {
    font: 90%/1.45em "Helvetica Neue", HelveticaNeue, Verdana, Arial, Helvetica, sans-serif;
    margin: 0;
    padding: 0;
    color: #333;
    background-color: #fff;
    }

    <div class="datatable-wide">
        <table ...>
        </table>
    </div>
 
    div.datatable-wide {
        padding-left:  0;
        padding-right: 0;
    }
</style>

    <meta charset=utf-8 />
    <title>IPD - Investigations Monthly Report</title>
    </head>
    <body>




    <!--<div class="container"> -->
<nav class="navbar navbar-light fixed-top" style="background-color: powderblue; height:50px; position: absolute;">
<form  class="form-inline" name="myform" action="ipd_lab_trend.php" method="POST"> <input type="hidden" name="check_submit" value="1" />     
<!--  
<div class="form-group">  
        <label for="stdate">Report Year</label>  
        <input class="form-control mr-sm-2" type="date"   id="stdate" name="stdate" placeholder="fromDate" aria-label="stdate" value="<?php echo isset($_POST['stdate']) ? $_POST['stdate']:''; ?>">
</div>     
-->
      <h3> Monthly Lab Investigation Report for IPD </h3>

      <select name="rep_year" id="rep_year">
          <?php 
              $conn = oci_connect("bgh", "hpv185e", "10.143.100.36/BGH6");
              $sql = 'select rep_year_code, rep_year_value from rep_year';
              $stid = oci_parse($conn, $sql);
              oci_execute($stid);
              while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC))
              {                  
                  echo "<option value=" . $row['REP_YEAR_CODE'] . ">" . $row['REP_YEAR_VALUE'] . "</option>";
              }
          ?>
      </select>

      <select name="lab_code" id="lab_code">
          <?php 
              $conn = oci_connect("wardlab", "wardlab", "10.143.55.53/BGHWARD");
              $sql = 'select lab_code, lab_desc from lab_code_master where lab_code in (01, 02,03,04,10)';
              $stid = oci_parse($conn, $sql);
              oci_execute($stid);
              while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC))
              {                
                  echo "<option value=" . $row['LAB_CODE'] . ">" . $row['LAB_DESC'] . "</option>";
              }
          ?>
      </select>




    <button class="btn btn-success my-2 my-sm-0" type="submit" name="submit">Get Data...</button>
</form>
</nav>
<br><br><br>


<?php
if (array_key_exists('check_submit', $_POST)) 
{
  if (isset($_POST['rep_year'])){$repyear=$_POST['rep_year'];}
  if (isset($_POST['lab_code'])){$labcode=$_POST['lab_code'];}
  

         
        function do_fetch($s, $repyear, $labcode)
        {
            
            print '<div class="datatable-wide">';
            print '<table class="table table-striped  table-bordered mydatatable" style="width:100%">'; 
            print '<thead>';        
            print '<tr>';               
                print '<th scope="col">Year</th>';
                print '<th scope="col">LabCode</th>';
                print '<th scope="col">TestCode</th>';
                print '<th scope="col">TestDesc</th>';
                print '<th scope="col">Jan</th>';
                print '<th scope="col">Feb</th>';            
                print '<th scope="col">Mar</th>';
                print '<th scope="col">Apr</th>';
                print '<th scope="col">May</th>';
                print '<th scope="col">Jun</th>';            
                print '<th scope="col">Jul</th>';
                print '<th scope="col">Aug</th>';
                print '<th scope="col">Sep</th>';            
                print '<th scope="col">Oct</th>';            
                print '<th scope="col">Nov</th>';            
                print '<th scope="col">Dec</th>';    
                print '<th scope="col">Total</th>';    
            print '</tr>';
            print '</thead>';   
            print '<tfoot>';           
            print '<tr>';
            print '<th scope="col">Year</th>';
            print '<th scope="col">LabCode</th>';
            print '<th scope="col">TestCode</th>';
            print '<th scope="col">TestDesc</th>';
            print '<th scope="col">Jan</th>';
            print '<th scope="col">Feb</th>';            
            print '<th scope="col">Mar</th>';
            print '<th scope="col">Apr</th>';
            print '<th scope="col">May</th>';
            print '<th scope="col">Jun</th>';            
            print '<th scope="col">Jul</th>';
            print '<th scope="col">Aug</th>';
            print '<th scope="col">Sep</th>';            
            print '<th scope="col">Oct</th>';            
            print '<th scope="col">Nov</th>';            
            print '<th scope="col">Dec</th>';    
            print '<th scope="col">Total</th>';    
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

                print '<tbody>';
                print '</table>';
                print '</div>';
                
        
        
            }
        
        // Create connection to Oracle
        $c = oci_connect("wardlab", "wardlab", "10.143.55.53/BGHWARD");
        
           

        if ($labcode=='01')
        {
        $query = "select  a.year, a.lab_code, a.test_code, b.test_desc, 
        a.jan, a.feb, a.mar, a.apr, a.may, a.jun, a.jul, a.aug, a.sep,a.oct, a.nov, a.dec,
        (nvl(a.jan,0)+nvl(a.feb,0)+nvl(a.mar,0)+nvl(a.apr,0)+nvl(a.may,0)+nvl(a.jun,0)+nvl(a.jul,0)+nvl(a.aug,0)+nvl(a.sep,0)+nvl(a.oct,0)+nvl(a.nov,0)+nvl(a.dec,0)) total
        from bgh_wardlab_trend a, lab_blood_bank b
        where 
        (nvl(a.jan,0)+nvl(a.feb,0)+nvl(a.mar,0)+nvl(a.apr,0)+nvl(a.may,0)+nvl(a.jun,0)+nvl(a.jul,0)+nvl(a.aug,0)+nvl(a.sep,0)+nvl(a.oct,0)+nvl(a.nov,0)+nvl(a.dec,0))>0 and
        a.year=:EIDBV and a.lab_code=:EIDBV1 and 
        a.lab_code= b.lab_code and
        a.test_code= b.test_code 
        order by 4 desc";
       
        }
        elseif ($labcode=='02') 
        {
            $query = "select  a.year, a.lab_code, a.test_code, b.test_desc, 
            a.jan, a.feb, a.mar, a.apr, a.may, a.jun, a.jul, a.aug, a.sep,a.oct, a.nov, a.dec,
            (nvl(a.jan,0)+nvl(a.feb,0)+nvl(a.mar,0)+nvl(a.apr,0)+nvl(a.may,0)+nvl(a.jun,0)+nvl(a.jul,0)+nvl(a.aug,0)+nvl(a.sep,0)+nvl(a.oct,0)+nvl(a.nov,0)+nvl(a.dec,0)) total
            from bgh_wardlab_trend a, lab_bchm b
            where 
            (nvl(a.jan,0)+nvl(a.feb,0)+nvl(a.mar,0)+nvl(a.apr,0)+nvl(a.may,0)+nvl(a.jun,0)+nvl(a.jul,0)+nvl(a.aug,0)+nvl(a.sep,0)+nvl(a.oct,0)+nvl(a.nov,0)+nvl(a.dec,0))>0 and
            a.year=:EIDBV and a.lab_code=:EIDBV1 and 
            a.lab_code= b.lab_code and
            a.test_code= b.test_code 
            order by 4 desc";                    
            
        }
        elseif ($labcode=='03') 
        {
            $query = "select  a.year, a.lab_code, a.test_code, b.test_desc, 
            a.jan, a.feb, a.mar, a.apr, a.may, a.jun, a.jul, a.aug, a.sep,a.oct, a.nov, a.dec,
            (nvl(a.jan,0)+nvl(a.feb,0)+nvl(a.mar,0)+nvl(a.apr,0)+nvl(a.may,0)+nvl(a.jun,0)+nvl(a.jul,0)+nvl(a.aug,0)+nvl(a.sep,0)+nvl(a.oct,0)+nvl(a.nov,0)+nvl(a.dec,0)) total
            from bgh_wardlab_trend a, lab_path b
            where 
            (nvl(a.jan,0)+nvl(a.feb,0)+nvl(a.mar,0)+nvl(a.apr,0)+nvl(a.may,0)+nvl(a.jun,0)+nvl(a.jul,0)+nvl(a.aug,0)+nvl(a.sep,0)+nvl(a.oct,0)+nvl(a.nov,0)+nvl(a.dec,0))>0 and
            a.year=:EIDBV and a.lab_code=:EIDBV1 and 
            a.lab_code= b.lab_code and
            a.test_code= b.test_code 
            order by 4 desc";                    
           
        }
        elseif ($labcode=='04') 
        {
            $query = "select  a.year, a.lab_code, a.test_code, b.test_desc, 
            a.jan, a.feb, a.mar, a.apr, a.may, a.jun, a.jul, a.aug, a.sep,a.oct, a.nov, a.dec,
            (nvl(a.jan,0)+nvl(a.feb,0)+nvl(a.mar,0)+nvl(a.apr,0)+nvl(a.may,0)+nvl(a.jun,0)+nvl(a.jul,0)+nvl(a.aug,0)+nvl(a.sep,0)+nvl(a.oct,0)+nvl(a.nov,0)+nvl(a.dec,0)) total
            from bgh_wardlab_trend a, lab_bctr b
            where 
            (nvl(a.jan,0)+nvl(a.feb,0)+nvl(a.mar,0)+nvl(a.apr,0)+nvl(a.may,0)+nvl(a.jun,0)+nvl(a.jul,0)+nvl(a.aug,0)+nvl(a.sep,0)+nvl(a.oct,0)+nvl(a.nov,0)+nvl(a.dec,0))>0 and
            a.year=:EIDBV and a.lab_code=:EIDBV1 and 
            a.lab_code= b.lab_code and
            a.test_code= b.test_code 
            order by 4 desc";                    
           
        }
        elseif ($labcode=='10') 
        {
            $query = "select  a.year, a.lab_code, a.test_code, b.test_desc, 
            a.jan, a.feb, a.mar, a.apr, a.may, a.jun, a.jul, a.aug, a.sep,a.oct, a.nov, a.dec,
            (nvl(a.jan,0)+nvl(a.feb,0)+nvl(a.mar,0)+nvl(a.apr,0)+nvl(a.may,0)+nvl(a.jun,0)+nvl(a.jul,0)+nvl(a.aug,0)+nvl(a.sep,0)+nvl(a.oct,0)+nvl(a.nov,0)+nvl(a.dec,0)) total
            from bgh_wardlab_trend a, lab_bctr b
            where 
            (nvl(a.jan,0)+nvl(a.feb,0)+nvl(a.mar,0)+nvl(a.apr,0)+nvl(a.may,0)+nvl(a.jun,0)+nvl(a.jul,0)+nvl(a.aug,0)+nvl(a.sep,0)+nvl(a.oct,0)+nvl(a.nov,0)+nvl(a.dec,0))>0 and
            a.year=:EIDBV and a.lab_code=:EIDBV1 and 
            a.lab_code= b.lab_code and
            a.test_code= b.test_code 
            order by 4 desc";                    
            
        }




        $s = oci_parse($c, $query);
        $myrepyear = $repyear;
        oci_bind_by_name($s, ":EIDBV", $myrepyear);

        $mylabcode = $labcode;
        oci_bind_by_name($s, ":EIDBV1", $mylabcode);
// Execute the query
        oci_execute($s);
// fecth data
//        do_fetch($mystdate, $myendate, $s);
        do_fetch($s, $repyear, $labcode);
    

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
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.bootstrap4.min.js"></script>


<!-- Working Fine Option 1  
<script>
        $(document).ready( function () {
        $('.mydatatable').DataTable();
    });
</script>
-->


<script>
        $(document).ready( function () {
        $('.mydatatable').DataTable({
            order:[[3, 'desc']],
            pagingType: 'full_numbers',
            "scrollY": "500px",
            "scrollX": true,
            "scrollCollapse": true,
            "paging": false,
            "fixedColumns":   true
        });
    });
</script>


</body>
</html>