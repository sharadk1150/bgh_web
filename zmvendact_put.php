<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/popper.js/dist/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <style>
    body 
    {
        font: 90%/1.45em "Helvetica Neue", HelveticaNeue, Verdana, Arial, Helvetica, sans-serif;
        margin: 0;
        padding: 0;
        color: #333;
        background-color: #fff;
    }

    label,h6 {
        color:blue;
        text-align: left;
        margin-top: 5px;
        padding: 0px;
        font-weight: bold;
        font-style: normal;        
    }
    </style>


</head>
<body>
<!--<div class="container"> -->

<nav class="navbar navbar-dark fixed-top bg-warning">
 <a class="navbar-brand" href="srm_vendor_main.php"><img src="sail-logo.jpg" width="40" height="40" alt="BGH-MAIN"></a> 
  <h6>SRM-Vendor ZMVENDACT Updation</h6>
<div class="container">
<form  class="form-inline" name="myform" action="zmvendact_put.php" method="POST"> <input type="hidden" name="check_submit" value="1" />     
  
<div class="form-group">  
        <label for="stdate">Received From ERP From Date</label>  
        <input class="form-control mr-sm-2" type="date"   id="stdate" name="stdate" placeholder="Date" aria-label="stdate" value="<?php echo isset($_POST['stdate']) ? $_POST['stdate']:''; ?>">
    </div>     
         
         
    <div class="form-group">  
        <label for="endate">To Date</label>  
        <input class="form-control mr-sm-2" type="date" id="endate" name="endate" placeholder="ToDate"   aria-label="todate" value="<?php echo isset($_POST['endate']) ? $_POST['endate']:''; ?>">
    </div>  
          
    <button class="btn btn-success my-2 my-sm-0" type="submit" name="getdata">ZMVENDACT DATA..</button>
    <button class="btn btn-warning my-2 my-sm-0" type="submit" name="sendmail">Send Mail...</button>

    
</form>
</div>
</nav>

<?php
//if (array_key_exists('check_submit', $_POST)) 
if (isset($_POST['getdata'])) 
{

  if (isset($_POST['stdate'])){$stdate    =  $_POST['stdate'];}
  if (isset($_POST['endate'])){$endate    =  $_POST['endate'];}

    $conn = oci_connect("bgh", "hpv185e", "10.143.100.36/BGH6");
    if (!$conn) {
        $e = oci_error();
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }


        $stid = oci_parse($conn, 
        "SELECT 
        substr(v_code,2) v_code, 
        v_name, 
        v_email, 
        v_mobile, 
        nvl(v_slno,'1') v_slno, 
        send, 
        to_char(recd_from_pur, 'YYYYMMDD') recd_from_pur,
        to_char(MAIL_SENT_DATE,'YYYYMMDD'),
        to_char(MAIL_RECD_DATE,'YYYYMMDD'),
        to_char(PASS_SENT_DATE,'YYYYMMDD'), 
        nvl(to_char(mail_bounce_dt, 'YYYYMMDD'),' ') mail_bounce_dt,
        INIT_PASS,
        NEWV_CODE 
        FROM srm_mail WHERE 
        to_char(recd_from_pur,'YYYY-MM-DD') between :EIDBV and :EIDBV1");

        $mystdate = $stdate;
        oci_bind_by_name($stid, ":EIDBV", $mystdate);

        $myendate = $endate;
        oci_bind_by_name($stid, ":EIDBV1", $myendate);

        oci_execute($stid);


        $myfile = fopen("zmvendact.txt", "w") or die("Unable to Open File");
//        fwrite($myfile, "v_code, v_name, v_email, v_mobile, v_slno, send, recd_from_pur, bounce_dt\n");
        
        while(($row = oci_fetch_array($stid, OCI_RETURN_NULLS)) != false)
        {
            fwrite($myfile, $row[0] . '|' . $row[1] . '|' . $row[2] . '|' . $row[3] . '|' . $row[4] . '|' . $row[5] . '|' . $row[6] . '|' . $row[7] . '|' . $row[8]. '|' . $row[9]. '|' . $row[10]. '|'. $row[11] . '|' . $row[12] . '|' . "\n");
        }
        oci_free_statement($stid);
        oci_close($conn);
        
        echo "<h1>Data Exported To the file</h1>";
        fclose($myfile);
         // Function call
        ftp_file_put_contents('zmvendact.txt');

}
else if (isset($_POST['sendmail']))
{
    
    echo "<h1>PHP is Fun</h1>";
    echo "<h1>PHP is Fun</h1>";
    echo "<h1>PHP is Fun</h1>";
    echo "<h1>PHP is Fun</h1>";
    echo "<h1>PHP is Fun</h1>";
    echo "<h1>PHP is Fun</h1>";
    echo "<h1>PHP is Fun</h1>";
    echo "<h1>PHP is Fun</h1>";
    echo "<h1>PHP is Fun</h1>";
    echo "<h1>PHP is Fun</h1>";


}


function ftp_file_put_contents($remote_file) 
{
    echo('<p>Inside the Function .....</p>');
    // FTP login details
    $ftp_server='10.143.100.72'; 
    $ftp_user_name='clc'; 
    $ftp_user_pass='clc123';
    
    // Create temporary file
    //$local_file=fopen('php://temp', 'r+');
    //fwrite($local_file, $file_string);
    //rewind($local_file);       
    $local_file='zmvendact.txt';
    $remote_file='zmvendact.txt';

    // FTP connection
    $ftp_conn=ftp_connect($ftp_server); 
    
    // FTP login
    @$login_result=ftp_login($ftp_conn, $ftp_user_name, $ftp_user_pass); 
    
    // FTP upload
    if($login_result) $upload_result=ftp_put($ftp_conn, $remote_file, $local_file, FTP_ASCII);
    
    // Error handling
    if(!$login_result or !$upload_result)
    {
        echo('<p>FTP error: The file could not be written to the FTP server.</p>');
    }
    
    // Close FTP connection
    ftp_close($ftp_conn);
    echo('<p>File Transferred To The Server.</p>');

    // Close file handle
    //fclose($local_file); 
}
?>

<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>