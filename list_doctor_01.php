<?php
/*
  This Program displays the counterwise expiry, damage and breakage entry for a fiancual year
  Same program if selected ALL in the counter list displays the consolidated List
*/
    session_start();
?>

<html>
<head>
<title>Misc. List Of Doctor's</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<style>
.table-hover tbody tr:hover td, 
.table-hover tbody tr:hover th 
{
  background-color: yellow;
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
<h3> List of Doctor's: </h3>
</div>
</nav>
<br><br><br>


<?php

    
        function do_fetch($s)            
            {
//                print '<div class="container mb-3 mt-3">';
//                print '<div class="datatable-wide">';
                print '<div class="table-responsive">';

//                print '<table class="table table-striped  table-bordered mydatatable" style="width:100%">';            
                print '<table class="table table-hover table-striped table-bordered mydatatable" style="width:100%">';            

                print '<thead>';
                print  '<tr>';
                    print '<th>Title</th>';
                    print '<th>Name</th>';
                    print '<th>Code</th>';
                    print '<th>Department</th>';
                    print '<th>Grade</th>';
                    print '<th>Design</th>';
                    print '<th>Mobile</th>';
                    print '<th>E-mail</th>';
                print  '</tr>';
                print '</thead>';
                print '<tfoot>';
                print  '<tr>';
                    print '<th>Title</th>';
                    print '<th>Name</th>';
                    print '<th>Code</th>';
                    print '<th>Department</th>';
                    print '<th>Grade</th>';
                    print '<th>Design</th>';
                    print '<th>Mobile</th>';
                    print '<th>E-mail</th>';
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
//                            Print '<tr>';
//                                    print '<td colspan="3">' . 'Totals' . '</td>';
//                                    print '<td>' . $tot_claims . '</td>';
//                                    print '<td>' . $tot_rec . '</td>';
//                            print '</tr'>

                print '<tbody>';

                print '</table>';
                print '</div>';
  //              print '</div>';
        }
    
    
        // Create connection to Oracle
        $c = oci_connect("bgh", "hpv185e", "10.143.100.36/BGH6");
        // Use bind variable to improve resuability, 
        // and to remove SQL Injection attacks.

    
        $query = "select a.title, a.name, a.code,a.department, b.gradep, b.desdescp,  b.mob, b.email
                  from bgh_doctdic a, emp_master b
                  where 
                  a.blocked='N' and 
                  a.staff=b.stno order by name";
    
//        $qcount = "select sum(tot_rate) TOT_VALUE from BGH_MED_STOCK_ISSUE_VW 
//        where  ctrno = '20' and to_char(issue_dt,'YYYY-MM-DD') between :EIDBV and :EIDBV2";
    
        $s = oci_parse($c, $query);
//        $scount = oci_parse($c, $qcount);
    
//        $myfinyr = $fyyr;
//        oci_bind_by_name($s, ":EIDBV", $myfinyr);
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
    
        do_fetch($s);
        oci_close($c);



?> 


<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.bootstrap4.min.js"></script>
<script>  
      $(document).ready(function(){  
        $('.mydatatable').DataTable({
            "scrollY": "500",
            "scrollX": true,
            "scrollCollapse": true,
            "paging": false
        });


           $('.hover').popover({  
                title:fetchData,  
                html:true,  
                placement:'right'  

           });  
           function fetchData(){  
                var fetch_data = '';  
                var element = $(this);  
                var id = element.attr("id");  
                $.ajax({  
                     url:"fetch.php",  
                     method:"POST",  
                     async:false,  
                     data:{id:id},  
                     success:function(data){  
                          fetch_data = data;  
                     }  
                });  
                return fetch_data;  
           }  
      });  
 </script>  
</body>
</html>