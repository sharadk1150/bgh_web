<?php

// No HTML required by this script!
// Validate that the page received $_GET['email']:
if (isset($_GET['mainminno'])) 
{
	// Connect to the database.
	// Assumes you are using PHP 5, 
	// see the PHP manual for PHP 4 examples. 

    //	$c = oci_pconnect ('bgh', 'hpv185e', 'bgh6') OR die('Unable to connect to the database. Error: <pre>' . //print_r(oci_error(),1) . '</pre>');
	
    //  $c = oci_connect("BGH", "hpv185e", "10.143.100.36/BGH6"); 
      $c = oci_connect("bgh", "hpv185e", "10.143.100.36/BGH6");
	  if ($c) 
	{	
    	$q = "select minno, name, add1, pincode1, ind, stno, 
    	to_char(eff_date,'YYYY-MM-DD') eff_date, 
    	to_char(dob,'YYYY-MM-DD') dob, 
    	to_char(date_sep,'YYYY-MM-DD') date_sep, 
    	to_char(date_enrol,'YYYY-MM-DD') date_enrol,
    	contact_no, sex
		from bgh_mediclaim_master where minno='{$_GET['mainminno']}'";

		// Parse the query.
		$s = oci_parse($c, $q);
		// Initialize the PHP variable:
    	$rows = 0;
		$vname="";
		$vmidno="";
		// Bind the output to $rows: 
		oci_define_by_name($s, "MINNO",     $vminno);
		oci_define_by_name($s, "NAME",      $vname);
		oci_define_by_name($s, "ADD1",      $vadd1);
		oci_define_by_name($s, "PINCODE1",  $vpincode1);
		oci_define_by_name($s, "IND",       $vind);
		oci_define_by_name($s, "STNO",      $vstno);
		oci_define_by_name($s, "EFF_DATE",  $veffdate);
		oci_define_by_name($s, "DOB",       $vdob);
		oci_define_by_name($s, "DATE_SEP",  $vdatesep);
		oci_define_by_name($s, "DATE_ENROL", $vdateenrol);
		oci_define_by_name($s, "CONTACT_NO", $contactno);
		oci_define_by_name($s, "SEX",        $vsex);
    
		// Execute the query.
		oci_execute($s);
	
		// Fetch the results.
		oci_fetch($s);
	
		// Close the connection.
		oci_close($c);

		$array["statusCode"] =  '200';    
    	$array["MINNO"]     =   $vminno;
		$array["NAME"]      =   $vname;
		$array["ADD1"]      =   $vadd1;
		$array["PINCODE1"]  =   $vpincode1;
		$array["IND"]       =   $vind;
		$array["STNO"]      =   $vstno;
		$array["EFF_DATE"]  =   $veffdate;
		$array["DOB"]       =   $vdob;
		$array["DATE_SEP"]  =   $vdatesep;
		$array["DATE_ENROL"]=   $vdateenrol;
		$array["CONTACT_NO"]=   $contactno;
		$array["SEX"]       =   $vsex;

    	if ($vminno != '')
    	{
			//print_r($array);  working okay
			echo json_encode($array);
    	}
    	else 
    	{			
			$array["statusCode"] =  '201';   
			// data not found in med master so setting the code as 201
			$nfmednast = $array["statusCode"];
			echo json_encode($array);
    	}
	
	}
	else
	{
		echo "Connection Failed Exiting <br>\n";
		$e = oci_error();	
		$array["statusCode"] =  '203';   
		echo json_encode($array);
 	}
}
//   echo json_encode(array("statusCode"=>400));  
// $arr = array("statusCode"=> 200);
// echo json_encode($arr);
// oci_close($db);
?>