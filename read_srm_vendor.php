<?php
$c = oci_connect("BGH", "hpv185e", "10.143.100.36/BGH6");



$row = 1;
if (($handle = fopen("eactivation.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
    { 
//        echo 'Data is ' . $data[2] . ' ' . $data[4];
          $vendor           =        'X'.$data[0];
          $name1            =        $data[1];
          $name2            =        $data[2];
          $city             =        $data[3];
          $pin              =        $data[4];
          $tel1             =        $data[5];
          $tel2             =        $data[6];
          $email            =        $data[7];
          $firstname        =        $data[8];
          $lname            =        $data[9];
          $pan              =        $data[10];
          $resend           =        'N';
          $rp1              =        'N';


          $query = "insert into srm_mail(v_code, v_name, v_mobile, v_email, newv_code, resend_initail_mail, rp1_updated,
          recd_from_pur) 
          values(:vendor, :name1, :tel2, :email, :vendor, :resend, :rp1, trunc(sysdate))";
          $s = oci_parse($c, $query);
          oci_bind_by_name($s, ':vendor'        ,$vendor);
          oci_bind_by_name($s, ':name1'         ,$name1);
          oci_bind_by_name($s, ':tel2'          ,$tel2);
          oci_bind_by_name($s, ':email'         ,$email);
          oci_bind_by_name($s, ':vendor'        ,$vendor);
          oci_bind_by_name($s, ':resend'        ,$resend);
          oci_bind_by_name($s, ':rp1'           ,$rp1);

          $u = oci_execute($s);
          if ($u)
          {  
//          $uupd = 'BEGIN UPDATE_BGHMID_EMPLOYEE_MIN(:minno,:name,:add1,:pin,:ind,:stno, :contactno, :gender,:dob,:dos); END;';
//          $uupd = 'BEGIN srm_initial_activation_email(trunc(sysdate)); END;';  
//          $stid = oci_parse($c, $uupd);  
//          oci_bind_by_name($stid, ':minno'   ,$minno);
//          oci_bind_by_name($stid, ':add1'    ,$add1);
//          oci_bind_by_name($stid, ':name'    ,$name);
//          oci_bind_by_name($stid, ':gender'  ,$sex);
//          oci_bind_by_name($stid, ':stno'    ,$stno);
//          oci_bind_by_name($stid, ':ind'     ,$ind);
//          oci_bind_by_name($stid, ':pin'     ,$pin);
//          oci_bind_by_name($stid, ':contactno',$contactno);
//          oci_bind_by_name($stid, ':dob',     $dob);
//          oci_bind_by_name($stid, ':dos',     $dos);
//            $uu=oci_execute($stid);    
            echo 'Okay';
          }                    







    }
    fclose($handle);
}
?>