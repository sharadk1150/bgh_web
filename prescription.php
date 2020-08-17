<?php
if(isset($_GET) & !empty($_GET)){
    $mid_no = $_GET['mid_no'];
    $name   = $_GET['name'];

}
else {
    echo '<h1>There is some problem</h1>';
}
?>

<html>
<head>
  <title>OPD: Prescription</title>



<link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="DataTables/datatables.min.css" rel="stylesheet" type="text/css" />
<script src="node_modules/jquery/dist/jquery.min.js"></script>
<script src="node_modules/popper.js/dist/popper.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="node_modules/datatables.net/js/jquery.dataTables.min.js"></script>




<style>
			#header{
				background-color: lightblue;
				width:100%;
				height:50px;
				text-align: center;
			}

			#sidebar-left{
				float:left;
				width:40%;
				background-color: lightgreen;
			}

			#main{
				float:left;
				width:60%;
				background-color: lightblue;
                
			}

			#sidebar-right{
				float:left;
				width:0%;
				background-color: red;
			}

			#footer{
				clear:both;
				height: 50px;
				width: 100%;
				text-align: center;
				background-color: lightblue;
			}

			#sidebar-left, #main, #sidebar-right{
				min-height: 100%				
			}

		</style>
</head>
<body>


<!-- Nav Bar for position at the top of page-->  
<nav class="navbar navbar-dark fixed-top bg-warning">
 <a class="navbar-brand" href="bgh_main.php"><img src="sail-logo.jpg" width="40" height="40" alt="BGH-MAIN"></a> 
  <h6>Quick Prescription</h6>
<div class="container">
 
 
<!--<form  class="form-inline" name="myform" action="bgh_quick_prescription.php" method="POST">
                <input type="hidden" name="check_submit" value="1" />
-->                
    <form class="form-inline">   
        <div class="form-group row">
            <label for="stno" class="mr-sm-3 col-form-label">HUID</label> 
                <div class="mr-sm-2">
                    <input type="text" class="form-control" id="stno" name="stno" 
                    value="<?php echo isset($_GET['mid_no']) ? $_GET['mid_no']:''; ?>">
                </div>                       


            <label for="stno" class="mr-sm-3 col-form-label">Name</label> 
                <div class="mr-sm-4">
                    <input type="text" class="form-control" id="name" name="name" 
                    value="<?php echo isset($_GET['name']) ? $_GET['name']:''; ?>">
            </div>                       


<!--         <button type="submit" name="submit" class="btn btn-primary">Get Details.</button>  -->                     
<!--         <button type="button" onclick="myFunction()" name="btngraph" class="btn btn-success">Show Graph.</button> -->

        </div>
    </form>            
 <!-- </form> -->
</div>  
</nav>

<br><br><br>


<!--        <div id="header">Header</div> -->
		<div id="sidebar-left">
<!--                <button type="button" onclick="myFunction()" name="btngraph" class="btn btn-success">All.</button>  -->
                <?php
                    do_fetch_meds();
                ?>



        </div>




<!-- Side Bat having List of Medicines -->

		<div id="main">Main
        </div>
<!--		<div id="sidebar-right">Right</div> -->
		<div id="footer">Footer
              <h6> Footer Area .. Footer Area </h6>  
        </div>



 
 
<script>
function myFunction() {
    alert("Demo Alert");
    location.replace("opd_daily_cash_collgr01.html");
}  
</script>  




<?php   
    global $gtotal;
    $gtotal =0;    
    
        function do_fetch_meds()
        {


        // Create connection to Oracle
        $c = oci_connect("BGH", "hpv185e", "10.143.100.36/BGH6"); 
        $query = "select 
                b.old_cat_no, 
                b.med_gen_name,
                A.ALL_CTR_STK 
                from 
                    bgh_allctr_stk  a,  
                    bgh_med_master  b,
                    bgh_med_minlvl c
                where a.old_cat_no = b.old_cat_no and
                    a.old_cat_no = c.old_cat_no and
                    b.disp_in_form = 'Y'        and
                    a.all_ctr_stk >=0 
                order by b.med_desc";

        $s = oci_parse($c, $query);        
        oci_execute($s);
             
                print '<div class="table-responsive">';
                print '<table class="table table-hover table-striped table-bordered mydatatable" style="width:100%">';            
                print '<thead>';
                print  '<tr>';
                    print '<th>CatNo</th>';
                    print '<th>MedName</th>';
                    print '<th>AllStk</th>';
                print  '</tr>';
                print '</thead>';
                print '<tfoot>';
                print  '<tr>';
                print '<th>CatNo</th>';
                print '<th>MedName</th>';
                print '<th>AllStk</th>';
            print  '</tr>';
                print '</tfoot>';        
                print '<tbody>';
                while ($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) 
                {      
                    print '<tr>';
                    foreach ($row as $item => $tvalue) 
                    { 
                        if ($item!='CODE') 
                            {
                                print '<td>'.($tvalue?htmlentities($tvalue):'&nbsp;').'</td>';
                            }
                        elseif ($item=='CODE') 
                            {            
                                print '<td><a href="#" class="hover" id='.($tvalue?htmlentities($tvalue):'&nbsp;').'>'.
                                ($tvalue?htmlentities($tvalue):'&nbsp;').'</a></td>';
                            }                                        
                    }
                        print '</tr>';
    }

            print '<tbody>';
            print '</table>';
            print '</div>';


    }

?>

    
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="node_modules/datatables.net/js/jquery.dataTables.min.js"></script>


<script>  
      $(document).ready(function(){  
        $('.mydatatable').DataTable({
            "scrollY": "600",
            "scrollX": true,
            "scrollCollapse": true,
            "paging": false
        });


           
      });  
 </script>  



</body>
</html>