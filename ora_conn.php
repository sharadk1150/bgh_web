<!DOCTYPE html>
<html>
 <head>
 <title> Retrive data</title>
 </head>
<body>

<?php
$conn=oci_connect("BGH","HPV185e","10.143.100.36/BGH6");
if (!$conn) {
	$e = oci_error();
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
    else
    {
        
        echo "Connected";
    }
?>



</body>
</html>