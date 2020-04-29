<?php

session_start();

extract($_POST);

        
if(!isset($submit))
{ 
    header('Location:login_bgh.php');
    exit;
}
else
{
/*   $rs=mysqli_query($conn,"select * from bgh_user where ucode='$uname' and upass='$psw'"); */
    
    include("ora_conn.php");
    

    
    echo $submit;
    
    echo $uname;
    echo $psw;
    
    
    $stid = oci_parse($conn, "SELECT ucode, upass FROM bgh_user where ucode='$uname' and upass='$psw'");
    oci_execute($stid);
    
    $nrows = oci_fetch_all($stid, $res);
    
   /*    echo "$nrows rows fetched<br>\n";
    var_dump($res);
   */
    
    
    echo $nrows;
    
    
    if ($nrows<1)
    {
        $found = "N";
    }
    else
    {
        $_SESSION["login"]=$uname;    
    }
}
        
if (isset($_SESSION["login"]))
{
    echo "<h1 align=center>Hye you are sucessfully login!!!</h1>";
    $_SESSION["login"]=$uname;
    header('Location: get_adm_date.php');
    exit;
}
else
{
    echo "<h1 align=center>Wrong User id or Password!!!</h1>";
    header('Location:login_bgh.php');
    exit;

}



/*    
if (isset($_SESSION["login"]))
{
echo "<h1 align=center>Hye you are sucessfully login!!!</h1>";
exit;
}    
*/


//oci_free_statement($conn);
//oci_close($conn);

?>










