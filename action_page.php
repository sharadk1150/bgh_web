<?php

session_start();
extract($_POST);

 echo $uname;
    echo "\n";

    echo $psw;
    echo "\n";

if(!isset($submit))
{ 
     echo "<h1 align=center>SUBMIT!</h1>";
    header('Location:login_bgh.php');
    exit;
}
else
{
    include("ora_conn.php");
    $stid = oci_parse($conn, "SELECT ucode, upass FROM bgh_user where ucode='$uname' and upass='$psw'");
    oci_execute($stid);    
    $nrows = oci_fetch_all($stid, $res); 
    echo $nrows;

    if ($nrows<1)
    {
        $found = "N";
        $_SESSION["loggedIn"] = false; 
        header('Location: login_bgh.php');
        
    }
    else
    {
        $_SESSION["loggedIn"] = true; 
        $_SESSION["login"]=$uname;    
    }
}
        
if ( (isset($_SESSION["login"])) &&  ($_SESSION["loggedIn"] = true)  )
{
//    echo "<h1 align=center>Hye you are sucessfully login!!!</h1>";
    $_SESSION["login"]=$uname;
    $_SESSION["loggedIn"] = true; 
//    header('Location: get_adm_date.php');
    if ($uname=='mediclaim') 
    {
        header('Location: bgh_mediclaim_master.php');
        exit;
    }
    elseif ($uname=='bgh1234') {
        header('Location: bgh_main.php');
        exit;        
    }
}
else
{
//  echo "<h1 align=center>Wrong User id or Password!!!</h1>";
    $_SESSION['loggedIn'] = false; 
    header('Location:login_bgh.php');
    exit;
}