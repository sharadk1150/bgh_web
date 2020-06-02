<?php
    header('Content-Type: application/json');
    $conn = oci_connect("BGH", "hpv185e", "10.143.100.36/BGH6");

    $graph="select a.party_code party_code, 
            b.party_full_name party_name, count(*) total 
            from bgh_mid_employee a, bgh_party_master b
            where a.party_code=b.party_code 
            group by a.party_code, b.party_full_name 
            order by 1"; 


    $parse=oci_parse($conn,$graph);
    
    oci_execute($parse);
    
    $data=array();
    
    


    while($row1 = oci_fetch_array($parse)){
    $data[]=$row1;

    }
     
     print json_encode($data);
?>
