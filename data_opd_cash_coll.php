<?php
    header('Content-Type: application/json');
    $conn = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD");

    $graph="select visit_date, total 
            from VIEW_CTR_101_DAILY_CASH_TOTAL where 
            to_char(visit_date,'YYYY-MM-DD')>=to_char(trunc(sysdate-60),'YYYY-MM-DD')
            order by 1 desc"; 


    $parse=oci_parse($conn,$graph);
    
    oci_execute($parse);
    
    $data=array();
    
    while($row1 = oci_fetch_array($parse)){
    $data[]=$row1;

    }
     
     print json_encode($data);
?>


