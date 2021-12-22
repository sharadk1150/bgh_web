<?php

//fetch.php


include('pdo_db_connections.php');

$column = array('HOSPNO', 'HOSPYR', 'ADMDATE', 'PAT_NAME', 'PAT_AGE', 'STAFF_NO');

$query = "SELECT HOSPNO, HOSPYR, ADMDATE, PAT_NAME, PAT_AGE, STAFF_NO FROM WARD_BSL WHERE ADMDATE=TRUNC(SYSDATE)";

/*
if(isset($_POST['search']['value']))
{
 $query .= '
 WHERE CustomerName LIKE "%'.$_POST['search']['value'].'%" 
 OR Gender LIKE "%'.$_POST['search']['value'].'%" 
 OR Address LIKE "%'.$_POST['search']['value'].'%" 
 OR City LIKE "%'.$_POST['search']['value'].'%" 
 OR PostalCode LIKE "%'.$_POST['search']['value'].'%" 
 OR Country LIKE "%'.$_POST['search']['value'].'%" 
 ';
}
*/

if(isset($_POST['search']['value']))
{
 $query .= ' AND PAT_NAME LIKE ' . "'". '%' . $_POST['search']['value']. '%' . "'";
}


if(isset($_POST['order']))
{
 $query .= ' ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= ' ORDER BY HOSPNO DESC';
}

/*
$query1 = '';
if($_POST['length'] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
*/




$statement = $connect->prepare($query);

$statement->execute();

$number_filter_row = $statement->rowCount();


//$statement = $connect->prepare($query . $query1);
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();

foreach($result as $row)
{
 $sub_array = array();
 $sub_array[] = $row['HOSPNO'];
 $sub_array[] = $row['HOSPYR'];
 $sub_array[] = $row['ADMDATE'];
 $sub_array[] = $row['PAT_NAME'];
 $sub_array[] = $row['PAT_AGE'];
 $sub_array[] = $row['STAFF_NO'];
 $data[] = $sub_array;
}


function count_all_data($connect)
{
 $query = "SELECT * FROM WARD_BSL";
 $statement = $connect->prepare($query);
 $statement->execute();
 return $statement->rowCount();
}

$output = array(
 'draw'    => intval($_POST['draw']),
 'recordsTotal'  => count_all_data($connect),
 'recordsFiltered' => $number_filter_row,
 'data'    => $data
);



echo json_encode($output);




?>
