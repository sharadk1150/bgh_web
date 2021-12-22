<?php
$tns = " 
(DESCRIPTION =
    (ADDRESS_LIST =
      (ADDRESS = (PROTOCOL = TCP)(HOST = 10.143.55.53)(PORT = 1521))
    )
    (CONNECT_DATA =
      (SERVICE_NAME = BGHWARD)
    )
  )
       ";
$db_username = "WARD";
$db_password = "hpv185e";
try
{
    $connect = new PDO("oci:dbname=".$tns,$db_username,$db_password);
    
} catch(PDOException $e) {
    echo ($e->getMessage());
}
?>



