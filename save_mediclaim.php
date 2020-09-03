<?php

//    require('ac_db.inc.php');
//    $db = new \Oracle\Db("ward", "hpv185e"); 

    alert($nfmedmaster);
   $db = oci_connect("BGH", "hpv185e", "10.143.100.36/BGH6");
   if ($c)
   { 
        $mainminno = $_POST['mainminno'];
        $minno     = $_POST['minno'];
        $name      = $_POST['name'];
        $sex       = $_POST['sex'];
        $dob       = $_POST['dob'];
        $stno      = $_POST['stno'];
        $dos       = $_POST['dos'];
        $doe       = $_POST['doe'];
        $ind       = $_POST['ind'];
        $add1      = $_POST['add1'];
        $pin       = $_POST['pin'];
        $contactno = $_POST['contactno'];

        $sql = "INSERT INTO BGH_MEDICLAIM_MASTER (minno,name,add1,pincode1,ind,eff_date,stno,dob, date_sep,date_enrol,contact_no,sex)
        VALUES (:minno,:name,:add1,:pin,:ind,to_date(:doe,'YYYY-MM-DD'),:stno,
                to_date(:dob,'YYYY-MM-DD'),to_date(:dos,'YYYY-MM-DD'),to_date(:doe,'YYYY-MM-DD'),:contactno,:gender)";
        $compiled = oci_parse($db, $sql);
        oci_bind_by_name($compiled, ':minno'    ,$minno);
        oci_bind_by_name($compiled, ':name'    	,$name);
        oci_bind_by_name($compiled, ':gender'   ,$sex);
        oci_bind_by_name($compiled, ':dob'    	,$dob);
        oci_bind_by_name($compiled, ':stno'    	,$stno);
        oci_bind_by_name($compiled, ':dos'    	,$dos);
        oci_bind_by_name($compiled, ':doe'    	,$doe);
        oci_bind_by_name($compiled, ':ind'    	,$ind);
        oci_bind_by_name($compiled, ':add1'    	,$add1);
        oci_bind_by_name($compiled, ':pin'    	,$pin);
        oci_bind_by_name($compiled, ':contactno',$contactno);

        oci_execute($compiled);

        //echo json_encode(array("statusCode"=>400));  
        $arr = array("statusCode"=> 200);
        echo json_encode($arr);
        oci_close($db);
   }    
    else
    {
        $arr = array("statusCode"=> 201);
        echo json_encode($arr);
        oci_close($db);
    }    
?>