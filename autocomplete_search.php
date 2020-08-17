<?php

if(isset($_GET['q']) and (strlen($_GET['q']) >= 3)){

$c = oci_connect("BGH", "hpv185e", "10.143.100.36/BGH6"); 
        
/*
$query = "select name, relation, birth_dt, stno, srl, mid_no, dep_stat, sex, 
                  emp_stat, pat_stat, party_code, gradep, roll_stat, desdescp, retention_till, 
                 last_update
                 from bgh_mid_employee where mid_no like (:EIDBV)
                 order by mid_no";
    
    echo  $row['NAME']. ':'.$row['MID_NO']. "\n";          
  */

        $query = "SELECT med_gen_name from BGH_MED_MASTER where upper(med_gen_name) like upper((:EIDBV))";

        $s = oci_parse($c, $query);    
        $myeid = $_GET['q'];
        $param_term = '%'. $myeid . '%';  
        oci_bind_by_name($s, ":EIDBV", $param_term);
        
        oci_execute($s);
        while ($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) 
                        {
                
                         
                            echo  $row['MED_GEN_NAME']. "\n";    
                                
                        }

       
        oci_close($c);

}

?>







