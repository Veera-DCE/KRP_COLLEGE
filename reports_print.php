<?php
$sDate = $_POST['sDate'];
$eDate = $_POST['eDate'];

require('fpdf181/fpdf.php');
require('config.php');
$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();
/*output the result*/

$da = date("Y-m-d");
$d3=date_format(new DateTime($da),'d-m-Y');
/*set font to arial, bold, 14pt*/
$pdf->SetFont('Arial','B',20);

/*Cell(width , height , text , border , end line , [align] )*/

// $pdf->SetFont('Arial','B',15);
// $pdf->Cell(195 ,10,'SENTHIL JEWELLERY MART','T L R',1,'L');
// $pdf->SetFont('Arial','',9);
// $pdf->Cell(145 ,5,'31 , KASUKADAI STREET','L',0, 'L');
// $pdf->Cell(50,5,'GST IN : 33AFTPB7361M1Z1','R',1, 'L');
// $pdf->Cell(195 ,5,'VIRUDHUNAGAR','L R B',1,'L');
// $pdf->SetFont('Arial','B',14);
$pdf->Image('./assets/logo2.jpg',60, 5, 90, 0);

$pdf->Cell(190 ,30,'',0,1 ,'C');

$pdf->SetFont('Arial','B',10);
/*Heading Of the table*/
$pdf->Cell(50 ,6,'Name',1,0,'L');
$pdf->Cell(50 ,6,'Roll No',1,0,'L');
$pdf->Cell(50 ,6,'Amount',1,0,'L');
$pdf->Cell(50 ,6,'Balance',1,1,'L');

$pdf->SetFont('Arial','',10);

$subTotal = 0;
$subBal = 0;

if($sDate && $eDate) {
    $query = "SELECT * FROM payment WHERE date1 BETWEEN '$sDate' AND '$eDate'";
} else if($sDate) {
    $query = "SELECT * FROM payment WHERE date1='$sDate'";
} else {
    $query = "SELECT * FROM payment WHERE `status` not like 'P'";
}
$result = mysqli_query($con,$query);
if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result)){
        $pdf->Cell(50 ,6,$row['name'],1,0,'L');
        $pdf->Cell(50 ,6,$row['rollno'],1,0,'L');
        $pdf->Cell(50 ,6,$row['fee_amount'],1,0,'L');
        $pdf->Cell(50 ,6,$row['balance'],1,1,'L');
    }
}


$pdf->Output();

?>