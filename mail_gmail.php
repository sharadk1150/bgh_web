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
  <h6>SRM-Vendor Initial Activation Mail Send For a Specific Date</h6>
<div class="container">
<form  class="form-inline" name="myform" action="mail_gmail.php" method="POST"> <input type="hidden" name="check_submit" value="1" />     
  
<div class="form-group">  
        <label for="stdate">Received From ERP From Date</label>  
        <input class="form-control mr-sm-2" type="date"   id="stdate" name="stdate" placeholder="Date" aria-label="stdate" value="<?php echo isset($_POST['stdate']) ? $_POST['stdate']:''; ?>">
    </div>     
         
         
    <div class="form-group">  
        <label for="endate">To Date</label>  
        <input class="form-control mr-sm-2" type="date" id="endate" name="endate" placeholder="ToDate"   aria-label="todate" value="<?php echo isset($_POST['endate']) ? $_POST['endate']:''; ?>">
    </div>  
          
    <button class="btn btn-success my-2 my-sm-0" type="submit" name="getdata">Get Data...</button>
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


    require('.\phpmailer\phpmailer\src\PHPMailer.php');
    require('.\phpmailer\phpmailer\src\SMTP.php');
    require('.\phpmailer\phpmailer\src\Exception.php');

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    //$mail->IsSMTP(); 

    //$mail=new PHPMailer;

    //Enable SMTP debugging. 
    $mail->SMTPDebug = 0;                               
    //Set PHPMailer to use SMTP.
    $mail->isSMTP();            
    //Set SMTP host name                          
    $mail->Host = "smtp.gmail.com";
    //Set this to true if SMTP host requires authentication to send email
    $mail->SMTPAuth = true;                          
    //Provide username and password     
    $mail->Username = "sailbslsrm@gmail.com";                 
    $mail->Password = "sk940678";                           
    //If SMTP requires TLS encryption then set it
    $mail->SMTPSecure = "tls";                           
    //Set TCP port to connect to 
    $mail->Port = 587;                                   

    //username = 'citbgh@gmail.com'
    //password = 'citbgh@827001'


    $mail->From = "sailbslsrm@gmail.com";
    $mail->FromName = "SAIL: Bokaro Steel Plant";
    $mail->addReplyTo('bsl.srm@sail.in', 'bsl srm');
    $mail->isHTML(false);
    $mail->Subject = "SAIL: Bokro Steel Plant: SRM Credentials";
    $mail->AltBody = "This is the plain text version of the email content";


    $conn = oci_connect("bgh", "hpv185e", "10.143.100.36/BGH6");
    if (!$conn) {
        $e = oci_error();
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }

        $stid = oci_parse($conn, "SELECT v_code, v_name, v_email, init_pass 
        FROM srm_mail where pass_sent_date is null and init_pass is not null and
        to_char(recd_from_pur,'YYYY-MM-DD') between :EIDBV and :EIDBV1");

        $mystdate = $stdate;
        oci_bind_by_name($stid, ":EIDBV", $mystdate);

        $myendate = $endate;
        oci_bind_by_name($stid, ":EIDBV1", $myendate);

        oci_execute($stid);

//while (($row = oci_fetch_array($stid)) != false) 
while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS)) 
{
//    echo $row[0] . " " . $row[1] . "<br>\n";
//    $mail->addAddress("singh.sharadk@gmail.com", "Recepient Name");

    $mail->addAddress("$row[2]", "Recepient Name");
    $mail->Body = "Dear Sir/Madam". "\n".
                  "your credentials are". "\n" .
                  "Userid:". $row[0]. "\n" .
                  "Initial Password:".$row[3]. "\n".
                  "Please Change on First Log On". "\n".
                  ".........BSL/SRM";

    if(!$mail->send()) 
    {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } 
    else 
    {
        echo "Message has been sent successfully";
        $sqid = oci_parse($conn, "update srm_mail set mail_sent_date=trunc(sysdate), 
        pass_sent_date=trunc(sysdate), mail_recd_date=trunc(sysdate), SEND='Y' 
        where v_code=". "'". $row[0]. "'");
        oci_execute($sqid);
    }
}
oci_free_statement($stid);
oci_free_statement($sqid);
oci_close($conn);


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
?>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
