<?php
error_reporting(E_ALL);

#$link = mysqli_connect("localhost", "root", "", "demo");
//    $db = '(DESCRIPTION =(ADDRESS =(PROTOCOL = TCP)(Host = xxxxxx)(Port = 1521))(CONNECT_DATA = (SERVICE_NAME = xxxxx) ))';
//    $dbuser = 'xxxxx';
//    $pass = 'xxxxx';
//   $conn = oci_connect($dbuser, $pass, $db);

    $conn = oci_connect("BGH", "hpv185e", "10.143.100.36/BGH6"); 


    if(isset($_REQUEST['term']) and (strlen($_REQUEST['term']) >= 3)){
        if($stmt = oci_parse($conn, "SELECT med_gen_name from BGH_MED_MASTER where upper(med_gen_name) 
        like  upper(:s)")){
        $param_term = '%' . $_REQUEST['term'] . '%';    
        oci_bind_by_name( $stmt , ":s" , $param_term, -1);                                                                  
            if(oci_execute($stmt)){                                                                                         
                    while(($row = oci_fetch_array($stmt, OCI_BOTH)) != false) {                                                         
                        echo "<p>" . $row['MED_GEN_NAME'] . "</p>"; # "
                    }
            } else{
                echo "ERROR: Could not able to execute" . $param_term; 
            }
        }
    }
    // Close statement
    #mysqli_stmt_close($stmt); 
//    oci_free_statement($stmt);
// close connection
#mysqli_close($conn);
oci_close($conn);
?>