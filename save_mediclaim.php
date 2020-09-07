<?php

//    require('ac_db.inc.php');
//    $db = new \Oracle\Db("ward", "hpv185e"); 

   $db = oci_connect("BGH", "hpv185e", "10.143.100.36/BGH6");
   if ($db)
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


        // catch the error if there is problem in executing the statement
        if (false === @oci_execute($compiled))
        {
            $e = oci_error($compiled);
            if ($e['code']='ORA-00001')
            {
                //update the database
                $usql = "update bgh_mediclaim_master set 
                                add1       =  :add1,
                                name       =  :name,
                                sex        =  :gender,
                                dob        =  to_date(:dob,'YYYY-MM-DD'),
                                stno       =  :stno,
                                date_sep    = to_date(:dos,'YYYY-MM-DD'),
                                date_enrol =  to_date(:doe,'YYYY-MM-DD'),
                                ind        =  :ind,
                                pincode1   =  :pin,
                                contact_no =  :contactno 
                        where minno = :minno";
                $s = oci_parse($db, $usql);        
                        oci_bind_by_name($s, ':minno'   ,$minno);
                        oci_bind_by_name($s, ':add1'    ,$add1);
                        oci_bind_by_name($s, ':name'    ,$name);
                        oci_bind_by_name($s, ':gender'  ,$sex);
                        oci_bind_by_name($s, ':dob'    	,$dob);
                        oci_bind_by_name($s, ':stno'    ,$stno);
                        oci_bind_by_name($s, ':dos'    	,$dos);
                        oci_bind_by_name($s, ':doe'    	,$doe);
                        oci_bind_by_name($s, ':ind'    	,$ind);
                        oci_bind_by_name($s, ':pin'    	,$pin);
                        oci_bind_by_name($s, ':contactno',$contactno);
                        // updated in bgh_mediclaim_master        
                        $u= oci_execute($s);
                        if ($u)
                        {
                        //call the stored procedure here      
                        $uupd = 'BEGIN UPDATE_BGHMID_EMPLOYEE_MIN(:minno,:name,:add1,:pin,:ind,:stno, :contactno, :gender,:dob,:dos); END;';

                        $stid = oci_parse($db, $uupd);  
                        oci_bind_by_name($stid, ':minno'   ,$minno);
                        oci_bind_by_name($stid, ':add1'    ,$add1);
                        oci_bind_by_name($stid, ':name'    ,$name);
                        oci_bind_by_name($stid, ':gender'  ,$sex);
                        oci_bind_by_name($stid, ':stno'    ,$stno);
                        oci_bind_by_name($stid, ':ind'     ,$ind);
                        oci_bind_by_name($stid, ':pin'     ,$pin);
                        oci_bind_by_name($stid, ':contactno',$contactno);
                        oci_bind_by_name($stid, ':dob',     $dob);
                        oci_bind_by_name($stid, ':dos',     $dos);
                        $uu=oci_execute($stid);                        
            
                        // Stored Procedure upto here 
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

            }

        }
        // new values inserted in to bgh_mediclaim_master
        else 
        {
            //echo json_encode(array("statusCode"=>400));  
            //call the stored procedure here       
            $uupd = 'BEGIN UPDATE_BGHMID_EMPLOYEE_MIN(:minno,:name,:add1,:pin,:ind,:stno, :contactno, :gender,:dob,:dos); END;';

            $stid = oci_parse($db, $uupd);  
            oci_bind_by_name($stid, ':minno'   ,$minno);
            oci_bind_by_name($stid, ':add1'    ,$add1);
            oci_bind_by_name($stid, ':name'    ,$name);
            oci_bind_by_name($stid, ':gender'  ,$sex);
            oci_bind_by_name($stid, ':stno'    ,$stno);
            oci_bind_by_name($stid, ':ind'     ,$ind);
            oci_bind_by_name($stid, ':pin'     ,$pin);
            oci_bind_by_name($stid, ':contactno',$contactno);
            oci_bind_by_name($stid, ':dob',     $dob);
            oci_bind_by_name($stid, ':dos',     $dos);
            $uu=oci_execute($stid);                        
            //$e = oci_error($stid);
            // end of stored procedure
            $arr = array("statusCode"=> 200);
            echo json_encode($arr);
            oci_close($db);
        }





//connection issue
}
else
{
        $arr = array("statusCode"=> 201);
        echo json_encode($arr);
        oci_close($db);
}    
?>