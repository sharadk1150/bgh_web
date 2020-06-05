<?php
//include connection file 
//include_once("connection.php");
//include_once('libs/fpdf.php');
require('.\fpdf182\fpdf.php');


class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    //$this->Image('bgh_logo.jpg',10,-1,30);
    $this->Image('bgh_logo.jpg',10,5,30);

    $this->SetFont('Arial','B',13);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(80,10,'List of Medico Legal Cases at Bokaro General Hospital',1,0,'C');
    // Line break
    $this->Ln(20);
}
 
// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
 
//$db = new dbObj();
//$connString =  $db->getConnstring();
//$display_heading = array('id'=>'ID', 'employee_name'=> 'Name', 'employee_age'=> 'Age','employee_salary'=> 'Salary',);
 
$c = oci_connect("WARD", "hpv185e", "10.143.55.53/BGHWARD"); 
$display_heading= array('hospno', 'hospyr', 'reference_no', 'reference_date', 'entry_from', 'pat_name', 'pat_age', 'pat_age_yrs', 
                    'pat_gender',
                    'entry_by_doct', 'entry_date', 'entry_time');

//$result = mysqli_query($connString, "SELECT id, employee_name, employee_age, employee_salary FROM employee") or die("database error:". mysqli_error($connString));
//$header = mysqli_query($connString, "SHOW columns FROM employee");

$header = array('hospno', 'hospyr', 'reference_no', 'reference_date', 'entry_from', 'pat_name', 'pat_age', 'pat_age_yrs', 'pat_gender',
'entry_by_doct', 'entry_date', 'entry_time');
 
$query = "select hospno, hospyr, reference_no, reference_date, entry_from, pat_name, pat_age, pat_age_yrs, pat_gender,
entry_by_doct, entry_date, entry_time from CASUALTY_MEDICO_LEGAL_VW";
$s = oci_parse($c, $query);    
//$myeid = $stdate;
//oci_bind_by_name($s, ":EIDBV", $myeid);

//$myendt = $endate;
//oci_bind_by_name($s,":EIDBV2", $myendt);
oci_execute($s);
/////////////


////////////


$pdf = new PDF();
//header
$pdf->AddPage('L');
//foter page
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',8);

//foreach($header as $heading) 
//{
//        $pdf->Cell(40,12,$display_heading[$heading['Field']],1);
//}


while ($row = oci_fetch_array($s, OCI_RETURN_NULLS+OCI_ASSOC)) 
                        {     
                            $pdf->Ln();                                                   
                            foreach ($row as $item) 
                            {                       
                                
                                $pdf->Cell(32,9,$item,1);
                                                                
                            }
                                
                        }


//                        $pdf->Cell(40,12,$column,1);


//$pdf->Output();
//$pdf->"a.pdf";
$nom_file="a.pdf";
$pdf->Output("I", $nom_file);
?>