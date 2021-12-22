<?php
    $c = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD"); 
    $dcode      =$_GET['id'];
    $medname    =$_POST['med_desc'];
    $medgname   =$_POST['med_gen_name'];
    $medbname   =$_POST['bname'];



$query5 = "update bgh_med_master set med_desc='$medname', med_gen_name='$medgname',
           bname='$medbname '  where substr(old_cat_no,7,11)='$dcode";       
$s5 = oci_parse($c, $query5);    

oci_execute($s5);
header('location:crud_index.php');

?>

<!--

$query4 = "select substr(old_cat_no,7,11) drug_code, med_Desc, med_gen_name,bname  
           from bgh_med_master where substr(old_cat_no,7,11)=".$row['DRUG_CODE'];       
$s4 = oci_parse($c, $query4);    
oci_define_by_name($s3, 'DRUG_CODE',    $drug_code);
oci_define_by_name($s3, 'MED_DESC',     $med_desc);
oci_define_by_name($s3, 'MED_GEN_NAME', $med_gen_name);
oci_define_by_name($s3, 'BNAME',        $bname);
oci_execute($s3);
oci_fetch($s3);
-->