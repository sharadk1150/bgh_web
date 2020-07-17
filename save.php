<?php



//    require('ac_db.inc.php');

//    $db = new \Oracle\Db("ward", "hpv185e"); 


   $db = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD");




	$bslemp    =  $_POST['bslemp'];
	$staffno   =  $_POST['staffno'];
	$orgname   =  $_POST['orgname'];
	$reportedby=  $_POST['reportedby'];
	$telnum    =  $_POST['telnum'];

   


/*
    $name=$_POST['name'];
    $gender=$_POST['gender'];
    $age=$_POST['age'];
    $arrstate=$_POST['arrstate'];


    $arrcity  =        $_POST['arrcity'];
    $arrdate   =       $_POST['arrdate'];
    $sympcode  =        $_POST['sympcode'];
    $sympdays           = $_POST['sympdays'];
    $sampdate           = $_POST['sampdate'];
    $hospi              = $_POST['hospi'];
    $hospname           = $_POST['hospname'];
    $remarks            = $_POST['remarks'];
    $feedback           = $_POST['feedback'];
    $curradd1           = $_POST['curradd1'];
    $curradd2           = $_POST['curradd2'];
    $curradd3           = $_POST['curradd3'];
    $areacode           = $_POST['areacode'];
    $telnum             = $_POST['telnum'];
    $emailid            = $_POST['emailid'];
    $repforother        = $_POST['repforother'];
    $reptypother        = $_POST['reptypother'];
*/

/*

   $sql = "INSERT INTO COVID_TRACKING_TRANS (bsl_emp, org_name, staff_no, reported_by, rep_for, rep_type, name, gender, age, arrival_from_state, arrival_from_city, arrival_date, symp_code, hospitalization, sample_given_date, areacode, telnum, emailid, repforother, reptypother, sympdays, sampdate, hospi, hospname, remarks, feedback, curradd1, curradd2, curradd3)
   VALUES 
   (:bslemp, :orgname, :staffno, :reportedby, :repfor, :reptype, :name, :gender, :age, :arrstate, :arrcity, :arrdate, :sympcode, :hospi, :sampdate, :areacode, :telnum, :emailid, :repforother, :reptypother, :sympdays, :sampdate, :hospi, :hospname, :remarks, :feedback, :curradd1, :curradd2, :curradd3)";
*/


   $sql = "INSERT INTO COVID_TRACKING_TRANS (bsl_emp, org_name, staff_no, reported_by, telnum)
            VALUES 
            (:bslemp, :orgname, :staffno, :reportedby, :telnum)";



   $compiled = oci_parse($db, $sql);

oci_bind_by_name($compiled, ':bslemp'    	,	$bslemp);    
oci_bind_by_name($compiled, ':staffno'   	,	$staffno);   
oci_bind_by_name($compiled, ':orgname'  	,	$orgname);   
oci_bind_by_name($compiled, ':reportedby'	,	$reportedby);
oci_bind_by_name($compiled, ':telnum'	    ,	$telnum);





/*
oci_bind_by_name($compiled, ':areacode'      ,	$areacode);         
oci_bind_by_name($compiled, ':telnum'        ,	$telnum);           


oci_bind_by_name($compiled, ':repfor'   	,	$repfor);   
oci_bind_by_name($compiled, ':reptype'  	,	$reptype);  



oci_bind_by_name($compiled, ':name'      	,	$name);      
oci_bind_by_name($compiled, ':gender'    	,	$gender);    
oci_bind_by_name($compiled, ':age'       	,	$age);       
oci_bind_by_name($compiled, ':arrstate'	    ,	$arrstate);
oci_bind_by_name($compiled, ':arrcity'	,	$arrcity);
oci_bind_by_name($compiled, ':arrdate'     	,	$arrdate);     
oci_bind_by_name($compiled, ':sympcode'        	,	$sympcode);        
oci_bind_by_name($compiled, ':sympdays'         	,	$sympdays);         
oci_bind_by_name($compiled, ':sampdate'         	,	$sampdate);         
oci_bind_by_name($compiled, ':sampdate'	,	$sampdate);
oci_bind_by_name($compiled, ':hospi'            	,	$hospi);            
oci_bind_by_name($compiled, ':hospname'         	,	$hospname);         
oci_bind_by_name($compiled, ':remarks'          	,	$remarks);          
oci_bind_by_name($compiled, ':feedback'         	,	$feedback);         
oci_bind_by_name($compiled, ':curradd1'         	,	$curradd1);         
oci_bind_by_name($compiled, ':curradd2'         	,	$curradd2);         
oci_bind_by_name($compiled, ':curradd3'         	,	$curradd3);         
oci_bind_by_name($compiled, ':areacode'         	,	$areacode);         
oci_bind_by_name($compiled, ':telnum'          	    ,	$telnum);           
oci_bind_by_name($compiled, ':emailid'          	,	$emailid);          
oci_bind_by_name($compiled, ':repforother'      	,	$repforother);      
oci_bind_by_name($compiled, ':reptypother'      	,	$reptypother);      
*/





  oci_execute($compiled);

//   echo json_encode(array("statusCode"=>400));
   
$arr = array('statusCode'=> 200);
echo json_encode($arr);

//$arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);

//echo json_encode($arr);


    oci_close($db);




   


/*

  $c = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD");
        // Use bind variable to improve resuability, 
        // and to remove SQL Injection attacks.

        $query = "select (hospno||'/'||hospyr) hospno, pat_name, pat_age,pat_sex gender, 
                  pfrom1, admdate, admtime, ent_nonent ent, medlegal,pat_local_add, pat_admit_unit, 
                  pat_provdiag 
                  from WARD_ADMISSION_VW 
                  where to_char(admdate,'YYYY-MM-DD') between :EIDBV and :EIDBV1 order by hospno";
        $s = oci_parse($c, $query);

        $mystdate = $stdate;
        oci_bind_by_name($s, ":EIDBV", $mystdate);

        $myendate = $endate;
        oci_bind_by_name($s, ":EIDBV1", $myendate);
// Execute the query
        oci_execute($s);
// fecth data
        do_fetch($mystdate, $myendate, $s);
//        do_fetch($s);
    

        // Close the Oracle connection
        oci_close($c);

*/





/*
    include 'database.php';
	$name=$_POST['name'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$city=$_POST['city'];
	$sql = "INSERT INTO `crud`( `name`, `email`, `phone`, `city`) 
	VALUES ('$name','$email','$phone','$city')";
	if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
*/

?>