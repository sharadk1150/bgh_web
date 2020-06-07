<?php

require('.\phpmailer\phpmailer\src\PHPMailer.php');
require('.\phpmailer\phpmailer\src\SMTP.php');
require('.\phpmailer\phpmailer\src\Exception.php');


$mail = new PHPMailer\PHPMailer\PHPMailer();

//----------------------------------------
$mail = new PHPMailer\PHPMailer\PHPMailer();
//$mail->IsSMTP(); 


//$mail=new PHPMailer;

//Enable SMTP debugging. 
$mail->SMTPDebug = 3;                               
//Set PHPMailer to use SMTP.
$mail->isSMTP();            
//Set SMTP host name                          
$mail->Host = "smtp.gmail.com";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;                          
//Provide username and password     
$mail->Username = "citbgh@gmail.com";                 
$mail->Password = "citbgh@827001";                           
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = "tls";                           
//Set TCP port to connect to 
$mail->Port = 587;                                   

//username = 'citbgh@gmail.com'
//password = 'citbgh@827001'


$mail->From = "citbgh@gmail.com.com";
$mail->FromName = "Computer and Information Technology BGH";

$mail->addAddress("singh.sharadk@gmail.com", "Recepient Name");

//Provide file path and name of the attachments
//$mail->addAttachment("file.txt", "File.txt");        
$mail->addAttachment("README.MD"); //Filename is optional


$mail->isHTML(true);

$mail->Subject = "Subject Text";
$mail->Body = "<i>Mail body in HTML</i>";
$mail->AltBody = "This is the plain text version of the email content";

if(!$mail->send()) 
{
    echo "Mailer Error: " . $mail->ErrorInfo;
} 
else 
{
    echo "Message has been sent successfully";
}



//---------------------------------------

/*

$mail->From = "from@yourdomain.com";
$mail->FromName = "Full Name";

$mail->addAddress("recipient1@example.com", "Recipient Name");

//Provide file path and name of the attachments
$mail->addAttachment("file.txt", "File.txt");        
$mail->addAttachment("images/profile.png"); //Filename is optional

$mail->isHTML(true);

$mail->Subject = "Subject Text";
$mail->Body = "<i>Mail body in HTML</i>";
$mail->AltBody = "This is the plain text version of the email content";

if(!$mail->send()) 
{
    echo "Mailer Error: " . $mail->ErrorInfo;
} 
else 
{
    echo "Message has been sent successfully";
}
*/
