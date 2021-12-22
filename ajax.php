<?php

// No HTML required by this script!
// Validate that the page received $_GET['email']:
if (isset($_GET['email'])) 
{
	// Connect to the database.
	// Assumes you are using PHP 5, 
	// see the PHP manual for PHP 4 examples. 

    //	$c = oci_pconnect ('bgh', 'hpv185e', 'bgh6') OR die('Unable to connect to the database. Error: <pre>' . //print_r(oci_error(),1) . '</pre>');
	
    //  $c = oci_connect("BGH", "hpv185e", "10.143.100.36/BGH6"); 
      $c = oci_connect("bgh", "hpv185e", "10.143.100.36/BGH6");
    
    
	// Define the query.
	///$q = "SELECT COUNT(*) AS NUM_ROWS FROM bgh_mid_employee WHERE mid_no='{$_GET['email']}'";

	// Parse the query.
	///$s = oci_parse($c, $q);
	
	// Initialize the PHP variable:
	///$rows = 0;

	// Bind the output to $rows:
	///oci_define_by_name($s, "NUM_ROWS", $rows);

	// Define the query.
	$q = "SELECT NAME AS ENAME, MID_NO AS EMIDNO  FROM bgh_mid_employee WHERE mid_no='{$_GET['email']}'";


	
	$q = "select name, relation, birth_dt, srl, stno, mid_no, dep_stat, sex, idnt_mark, blood, ret_dt, emp_stat, pat_stat, gradep, 
	roll_stat, desdescp
	from bgh_mid_employee where mid_no='{$_GET['email']}'";


	// Parse the query.
	$s = oci_parse($c, $q);
	// Initialize the PHP variable:
    $rows = 0;
	$vname="";
	$vmidno="";
	// Bind the output to $rows: 
	oci_define_by_name($s, "NAME",     $vname);
	oci_define_by_name($s, "MID_NO",    $vmidno);
	oci_define_by_name($s, "RELATION", $relation);
	oci_define_by_name($s, "BIRTH_DT", $birth_dt);
	oci_define_by_name($s, "SRL", $srl);
	oci_define_by_name($s, "STNO", $stno);
	oci_define_by_name($s, "DEP_STAT", $dep_stat);
	oci_define_by_name($s, "SEX", $sex);
	oci_define_by_name($s, "IDNT_MARK", $idnt_mark);
	oci_define_by_name($s, "BLOOD", $blood);
	oci_define_by_name($s, "RET_DT", $ret_dt);
	oci_define_by_name($s, "EMP_STAT", $emp_stat);
	oci_define_by_name($s, "PAT_STAT", $pat_stat);
	oci_define_by_name($s, "GRADEP", $gradep);
	oci_define_by_name($s, "EOLL_STAT", $roll_stat);
	oci_define_by_name($s, "DESDESCP", $desdescp);
    
	// Execute the query.
	oci_execute($s);
	
	// Fetch the results.
	oci_fetch($s);
	
	// Close the connection.
	oci_close($c);

	// Return a message indicating the status.
	//if ($rows > 0) {
	//	echo e_name;
	//} else {
	//	echo 'Invalid Staff No.';
	//}

		$array = array();
		$array["name"]     = $vname;
		$array["midno"]    = $vmidno;
		$array["relation"] =  $relation;
		$array["birth_dt"] = $birth_dt;
		$array["srl"] 	   = $srl;
		$array["stno"] 	   = $stno;
		$array["dep_stat"] = $dep_stat;
		$array["sex"] 	   = $sex;
		$array["idnt_mark"] = $idnt_mark;
		$array["blood"] 	= $blood;
		$array["ret_dt"] 	= $ret_dt;
		$array["emp_stat"] 	= $emp_stat;
		$array["pat_stat"] 	= $pat_stat;
		$array["gradep"] 	= $gradep;
		$array["roll_stat"] = $roll_stat;
		$array["desdescp"] 	=$desdescp;
	

		//print_r($array);  working okay
		echo json_encode($array);
	
	}


?>