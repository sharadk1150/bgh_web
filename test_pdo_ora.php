<?php
$tns = " 
(DESCRIPTION =
    (ADDRESS_LIST =
      (ADDRESS = (PROTOCOL = TCP)(HOST = 10.143.100.36)(PORT = 1521))
    )
    (CONNECT_DATA =
      (SERVICE_NAME = BGH6)
    )
  )
       ";
$db_username = "BGH";
$db_password = "hpv185e";
try
{
    $conn = new PDO("oci:dbname=".$tns,$db_username,$db_password);
}
catch(PDOException $e)
{
    echo ($e->getMessage());
}
?>