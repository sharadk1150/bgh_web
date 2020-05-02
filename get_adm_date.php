<?php
    session_start();
?>

<html>
<head>
  <title>Process the HTML form data with the POST method</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<-- Check if the the login ha sbeen successfull -->
<?php
          
         $login_name = $_SESSION["login"];
        
//        echo $_SESSION["login"];
//        echo $_SESSION['loggedIn'];
        
//          print_r($_SESSION);
//        on the second page you check if that session is true, else redirect to the login page  
//        if (!isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]="")
        if (!isset($_SESSION["loggedIn"]))
        {  
            header('Location:/login_bgh.php'); 
        }
        else
        {
            ;
//            echo "all Good";
            
        }
    ?>
    


<form  name="myform" action="get_adm_date.php" method="POST">
                <input type="hidden" name="check_submit" value="1" />
<!--        Name: <input type="text" name="Name" /><br /> -->
<!--        Date:   <input type="date" name="stdate"   /> -->
<!--                <input type="submit" name="submit" value="Show Admission Data:"/> -->

<!--  <div class="form-group"> -->
<!--    <input type="date" class="form-control" name="stdate" id="stdate" aria-describedby="dateHelp"> -->
<!--    <small id="dateHelp" class="form-text text-muted">The Date for Which Admission Details are Required</small> -->
<!--    <button type="submit" name="submit" class="btn btn-primary">Show Admission Data</button> -->
<!--  </div> -->
 
<form class="form-horizontal">   
    <div class="form-group row">
        <label for="stdate" class="col-sm-2 col-form-label">Date</label> 
        <div class="col-sm-4">
            <input type="date" class="form-control" id="stdate" name="stdate">
            <button type="submit" name="submit" class="btn btn-primary">Get Data....</button>     
          
        </div>
    </div>             
</form>            
             
                 
 <!--

                
                        
        Password: <input type="password" name="Password" maxlength="10" /><br />
        Select something from the list: <select name="Seasons">
          <option value="Spring" selected="selected">Spring</option>
          <option value="Summer">Summer</option>
          <option value="Autumn">Autumn</option>
          <option value="Winter">Winter</option>
        </select><br /><br />
        Choose one:
          <input type="radio" name="Country" value="USA" /> USA
          <input type="radio" name="Country" value="Canada" /> Canada
          <input type="radio" name="Country" value="Other" /> Other
            <br />
        Choose the colors:
          <input type="checkbox" name="Colors[]" value="green" checked="checked" /> Green
          <input type="checkbox" name="Colors[]" value="yellow" /> Yellow
          <input type="checkbox" name="Colors[]" value="red" /> Red
          <input type="checkbox" name="Colors[]" value="gray" /> Gray
          <br /><br />
        Comments:<br />
         <textarea name="Comments" rows="10" cols="60">Enter your comments here</textarea><br />
-->
                 
         
  </form>




<?php
if (array_key_exists('check_submit', $_POST)) 
{
    $stdate =  $_POST['stdate'];
         
   //Let's now print out the received values in the browser
   //   echo "Your name: {$_POST['Name']}<br />";
   //   echo "Selected Date : {$_POST['stdate']}<br />";
   //echo $stdate;

        function do_fetch($myeid, $s)
        {
            //Fetch the results in an associative array
            //print '<p>$myeid is ' . $myeid . '</p>';
            //print '<p>Data Showing For the Date:' . $myeid . '</p>';
            // <table class="table table-dark">
                print '<table class="table table-sm table-bordered table-striped table-dark w-auto">';
            
                print '<thead>';
            
                print '<tr>'; 
                print '<td  colspan="4">' . 'Data For Date: ' . $myeid . '</td>';
                print '</tr>';
            
                print '<tr>';
                print '<th scope="col">Hospno</th>';
                print '<th scope="col">HospYr</th>';
                print '<th scope="col">Patient</th>';
                print '<th scope="col">AdmDate</th>';   
                print '<th scope="col">AdmTime</th>';   
                print '<th scope="col">Age</th>';   
                print '<th scope="col">Gender</th>';   
                print '<th scope="col">Unit</th>';   
            
            

            
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
        $query = "select hospno, hospyr, pat_name, admdate,admtime, pat_age, pat_sex gender, pat_admit_unit from ward_admission_vw where to_char(admdate,'YYYY-MM-DD') = :EIDBV order by pat_name";
        $s = oci_parse($c, $query);
        $myeid = $stdate;
        //$myeid =  date("d-m-Y", $stdate);
        //$myeid = '28-APR-2020';    
        //echo 'value of $myeid' . $myeid;    
        oci_bind_by_name($s, ":EIDBV", $myeid);
        oci_execute($s);
        do_fetch($myeid, $s);


    
        

    
    
    
        // Redo query without reparsing SQL statement
        //$myeid = 104;
        //oci_execute($s);
        //do_fetch($myeid, $s);

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