<?php
 
// test_db.php
 
require('ac_db.inc.php');
 
$db = new \Oracle\Db("bgh", "hpv185e");
$sql = "SELECT name, relation FROM bgh_mid_employee where rownum < 100";
$res = $db->execFetchAll($sql, "Query Example");
// echo "<pre>"; var_dump($res); echo "</pre>\n";
 
echo "<table border='1'>\n";
echo "<tr><th>Name</th><th>Phone Number</th></tr>\n";
foreach ($res as $row) {
    $name = htmlspecialchars($row['NAME'], ENT_NOQUOTES, 'UTF-8');
    $pn   = htmlspecialchars($row['RELATION'], ENT_NOQUOTES, 'UTF-8');
    echo "<tr><td>$name</td><td>$pn</td></tr>\n";
}
echo "</table>";
 
?>