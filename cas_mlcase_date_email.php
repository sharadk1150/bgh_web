<?php
//include connection file 
//include_once("connection.php");
//include_once('libs/fpdf.php');
require('.\fpdf182\fpdf.php');
require('.\phpmailer\phpmailer\src\PHPMailer.php');
require('.\phpmailer\phpmailer\src\SMTP.php');
require('.\phpmailer\phpmailer\src\Exception.php');
//-----------------------------------------------------------------

if (isset($_GET) & !empty($_GET)) {
    $refdt = $_GET['refdt'];
    
}
//-------------------------------------------------------------------------------------------------
class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    //$this->Image('bgh_logo.jpg',10,-1,30);
    //$this->Image('bgh_logo.jpg',10,5,30);
    $this->SetY(2);
    $this->SetFont('Arial','B',8);
    $this->Cell(300,10,'List of Medico Legal Cases at Bokaro General Hospital, Bokaro',0,0,'C');
    //$this->Ln(20);
    $this->Ln(8);
    $this->cell(10,8,'RefNo   Date       Hospno                       Pat-Name                                        Age Yrs M/F              Status         Prov Diag                                                 Address                                      NextTo Kin',0);  
    $this->Ln(8);
    
    
    
    
//    $display_heading= array('hospno', 'hospyr', 'reference_no', 'reference_date', 'entry_from', 'pat_name', 'pat_age', 'pat_age_yrs', 
//                    'pat_gender',
//                    'entry_by_doct', 'entry_date', 'entry_time');

}
 
// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-10);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
//---------------------------------------------------------------------------------------------- 
$c = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD"); 
$header = array('hospno', 'hospyr', 'reference_no', 'reference_date', 'entry_from', 'pat_name', 'pat_age', 'pat_age_yrs', 'pat_gender',
'entry_by_doct', 'entry_date', 'entry_time');

$query = "SELECT reference_no, reference_date, (HOSPNO||'/'||HOSPYR) HOSPNO, PAT_NAME, PAT_AGE, PAT_AGE_YRS, PAT_GENDER, 
            NVL(STATUS_DESC,STATUS_OTHERS) STATUS_DESC, PROV_DIAG,  
            (PAT_LOCAL_ADD||'-'||PAT_LOCAL_TEL) pat_local_add, 
            (PAT_NEXTTO_KIN||'-'||PAT_KIN_TELNO) PAT_NEXTTO_KIN
            FROM CASUALTY_MEDICO_LEGAL_VW
            WHERE to_char(REFERENCE_date,'DD-MON-YY')=:EIDBV
            order by reference_no asc";
$s = oci_parse($c, $query);    
$myeid = $refdt;
oci_bind_by_name($s, ":EIDBV", $myeid);

oci_execute($s);
//---------------------------------

$pdf = new PDF();

$pdf->AddPage('L');

$start_x   = $pdf->GetX(); //initial x (start of column position)
$current_y = $pdf->GetY();
$current_x = $pdf->GetX();

//foter page
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',8);

//$pdf->Cell(300,10,$refdt); 
while ($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) 
                        {     
                            $pdf->Ln(1);
                            $pdf->SetFont('Arial','',8);
                            $current_y = $pdf->GetY();
                            $current_x = $pdf->GetX();                                                   
                            foreach ($row as $item=>$value) 
                            {                                                     
                                //  print $item .'\n';
                                //  print $value . '\n';
                                if ($item=="REFERENCE_NO"){
                                    $pdf->Cell(10,8,$value,1);
                                    $current_x+=10;
                                }    
                                elseif ($item=="REFERENCE_DATE"){
                                    $pdf->Cell(15,8,$value,1);
                                    $current_x+=15;
                                }                                                                    
                                elseif ($item=="HOSPNO")
                                {
                                      $pdf->Cell(25,8,$value,1,0,'C');
                                      $current_x+=25; //calculate position for next cell
                                }
                                elseif ($item=="PAT_NAME")
                                {
                                        $pdf->Cell(50,8,$value,1);
                                        $current_x+=50; //calculate position for next cell
                                }
                                elseif ($item=="PAT_AGE")
                                {
                                        $pdf->Cell(5,8,$value,1);
                                        $current_x+=5; //calculate position for next cell
                                }
                                elseif ($item=="PAT_AGE_YRS")
                                {
                                        $pdf->Cell(5,8,$value,1);
                                        $current_x+=5; //calculate position for next cell
                                }
                                elseif ($item=="PAT_GENDER")
                                {
                                        $pdf->Cell(5,8,$value,1);
                                        $current_x+=5; //calculate position for next cell
                                }
                                elseif ($item=="PAT_AGE")
                                {
                                        $pdf->Cell(5,8,$value,1);
                                        $current_x+=5; //calculate position for next cell
                                }                                
                                elseif ($item=="STATUS_DESC") {
                                    $pdf->Cell(25,8,$value,1);
                                    $current_x+=25; //calculate position for next cell
                                }
                                elseif ($item=="PROV_DIAG") {
                                    $pdf->Cell(40,8,$value,1);
                                    $current_x+=40; //calculate position for next cell
                                }                                  
                                elseif ($item=="PAT_LOCAL_ADD") {
                                    $pdf->SetFont('Arial','',6);
                                    $pdf->MultiCell(50,8,$value,1,'C');
                                    $current_x+=50; //calculate position for next cell
                                    $pdf->SetXY($current_x, $current_y);  
                                }
                                elseif ($item=="PAT_NEXTTO_KIN") { 
                                    $pdf->SetFont('Arial','',6);
                                    $current_y = $pdf->GetY();
                                    $pdf->SetXY($current_x, $current_y);                                  
                                    $pdf->MultiCell(50,8,$value,1,'C');
                                    $current_x+=500; //calculate position for next cell
                                }                                    
                                else {
                                        $pdf->Cell(25,8,$value,1);
                                        $current_x+=50;
                                  }                                                                
                            }
                                
                        }


$pdf->Output();
$attachment='BGH_ML_CASE.pdf';
$pdf->output("F", $attachment);

//-------------------- Sending mail from here ------------------------------
$mail = new PHPMailer\PHPMailer\PHPMailer();
//Enable SMTP debugging. 
$mail->SMTPDebug = 0;                               
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

$mail->From = "citbgh@gmail.com.com";
$mail->FromName = "Computer and Information Technology BGH";

$mail->addAddress("singh.sharadk@gmail.com", "Recepient Name");

//Provide file path and name of the attachments
//$mail->addAttachment("file.txt", "File.txt");        
//$mail->addAttachment("README.MD"); //Filename is optional
$mail->addAttachment($attachment); //Filename is optional

$mail->isHTML(true);

$mail->Subject = "Subject Text";
$mail->Body = "<i>Dear Sir, Please Find attached the intimtion Of Medico Legal Cases at Bokaro General Hospital, Bokaro</i>";
$mail->AltBody = "This is the plain text version of the email content";

if(!$mail->send()) 
{
    echo "Mailer Error: " . $mail->ErrorInfo;
} 
else 
{
    echo "Message has been sent successfully, Close the Browser Please";
}


//--------------------- sending mail as attachement up to here --------------------


//$pdf->"a.pdf";
//$nom_file="a.pdf";
//$pdf->Output("I", $nom_file);

// $file_name = md5(rand()) . '.pdf';
// $html_code = '<link rel="stylesheet" href="bootstrap.min.css">';
// $html_code .= fetch_customer_data($connect);
// $pdf = new Pdf();
// $pdf->load_html($html_code);
// $pdf->render();
// $file = $pdf->output();
// file_put_contents($file_name, $file);
/*
require 'class/class.phpmailer.php';
 $mail = new PHPMailer;
 $mail->IsSMTP();        //Sets Mailer to send message using SMTP
 $mail->Host = 'smtpout.secureserver.net';  //Sets the SMTP hosts of your Email hosting, this for Godaddy
 $mail->Port = '80';        //Sets the default SMTP server port
 $mail->SMTPAuth = true;       //Sets SMTP authentication. Utilizes the Username and Password variables
 $mail->Username = 'xxxxxxxxxx';     //Sets SMTP username
 $mail->Password = 'xxxxxxxxxx';     //Sets SMTP password
 $mail->SMTPSecure = '';       //Sets connection prefix. Options are "", "ssl" or "tls"
 $mail->From = 'info@webslesson.info';   //Sets the From email address for the message
 $mail->FromName = 'Webslesson.info';   //Sets the From name of the message
 $mail->AddAddress('web-tutorial@programmer.net', 'Name');  //Adds a "To" address
 $mail->WordWrap = 50;       //Sets word wrapping on the body of the message to a given number of characters
 $mail->IsHTML(true);       //Sets message type to HTML    
 $mail->AddAttachment($file_name);         //Adds an attachment from a path on the filesystem
 $mail->Subject = 'Customer Details';   //Sets the Subject of the message
 $mail->Body = 'Please Find Customer details in attach PDF File.';    //An HTML or plain text message body
 if($mail->Send())        //Send an Email. Return true on success or false on error
 {
  $message = '<label class="text-success">Customer Details has been send successfully...</label>';
 }
 unlink($file_name);
}
https://www.webslesson.info/2018/08/create-dynamic-pdf-send-as-attachment-with-email-in-php.html

*/



?>