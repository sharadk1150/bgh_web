<?php
    header('Content-Type: application/json');
    $conn = oci_connect("BGH", "hpv185e", "10.143.100.36/BGH6");

    $graph="select opd_code opd_name, count(*) total from bgh_opd_registration where 
    to_char(opd_date,'YYYY-MM-DD')=to_char(trunc(sysdate),'YYYY-MM-DD')  
    and opd_seen_status ='Y' group by opd_code";
    
    $parse=oci_parse($conn,$graph);
    
    oci_execute($parse);
    
    $data=array();
    
    while($row1 = oci_fetch_array($parse)){
    $data[]=$row1;

    }
     print json_encode($data);

    ?>