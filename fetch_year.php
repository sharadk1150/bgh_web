<?php

//fetch.php

include('pdo_db_connections.php');

if(isset($_POST["year"]))
{
 //$query = "
 //SELECT * FROM chart_data 
 //WHERE year = '".$_POST["year"]."' 
 //ORDER BY id ASC
 //";


$query = "
 SELECT to_char(admdate,'MM') MNTH, to_char(admdate,'MON') MONTH, count(*) PROFIT 
 FROM WARD_ADMISSION_VW 
 WHERE to_char(admdate,'RRRR') = '".$_POST["year"]."' 
 group by to_char(admdate,'MM'), to_char(admdate,'MON')
 ORDER BY 1 ASC
 ";



/*
 SELECT to_char(admdate,'MM') MNTH, to_char(admdate,'MON') MONTH, count(*) PROFIT 
 FROM WARD_ADMISSION_VW 
 WHERE to_char(admdate,'RRRR') = '2020' 
 group by to_char(admdate,'MM'), to_char(admdate,'MON')
 ORDER BY 1  ASC
*/




 //select to_char(admdate,'MON'), count(*)  from ward_admission_vw where to_char(admdate,'RRRR')='2019' group by to_char(admdate,'MON') order by 1



 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output[] = array(
   'month'   => $row["MONTH"],
   'profit'  => floatval($row["PROFIT"])
  );
 }
 echo json_encode($output);
}

?>