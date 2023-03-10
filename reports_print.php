<?php
$sDate = $_POST['sDate'];
$eDate = $_POST['eDate'];
$cate = $_POST['category'];
$f_type = $_POST['fType'];

$table = '';
$log_table = '';
$report = '';
if($f_type == 'college') {
    $table = 'payment';
    $log_table = 'payment_log';
    $report ='College';
} else {
    $table = 'transport_payment';
    $log_table = 'transport_payment_log';
    $report = 'Transport';
}

if($cate == 'Pending') {
    require('fpdf181/fpdf.php');
    require('config.php');
    $pdf = new FPDF('P','mm','A4');
    
    $pdf->AddPage();
    /*output the result*/
    
    $da = date("Y-m-d");
    $d3=date_format(new DateTime($da),'d-m-Y');
    /*set font to arial, bold, 14pt*/
    $pdf->SetFont('Arial','B',20);
    
    $pdf->Image('./assets/logo2.jpg',10, 5, 50, 0);
    
    $pdf->Cell(190 ,20,$report,0,1 ,'C');
    
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
        $query = "SELECT * FROM $table WHERE `status` not like 'P' AND date1 BETWEEN '$sDate' AND '$eDate'";
    } else if($sDate) {
        $query = "SELECT * FROM $table WHERE `status` not like 'P' AND date1='$sDate'";
    } else {
        $query = "SELECT * FROM $table WHERE `status` not like 'P'";
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
} else if($cate == 'Paid') {
    require('fpdf181/fpdf.php');
    require('config.php');
    $pdf = new FPDF('P','mm','A4');
    
    $pdf->AddPage();
    /*output the result*/
    
    $da = date("Y-m-d");
    $d3=date_format(new DateTime($da),'d-m-Y');
    /*set font to arial, bold, 14pt*/
    $pdf->SetFont('Arial','B',20);
    
    $pdf->Image('./assets/logo2.jpg',10, 5, 50, 0);
    
    $pdf->Cell(190 ,20,$report,0,1 ,'C');

    $pdf->SetFont('Arial','B',10);
    /*Heading Of the table*/
    $pdf->Cell(50 ,6,'Date',1,0,'L');
    $pdf->Cell(50 ,6,'Name',1,0,'L');
    $pdf->Cell(50 ,6,'Roll No',1,0,'L');
    $pdf->Cell(50 ,6,'Paid',1,1,'L');
    
    $pdf->SetFont('Arial','',10);
    
    $subTotal = 0;
    $subBal = 0;
    
    if($sDate && $eDate) {
        $query = "SELECT * FROM $log_table WHERE date1 BETWEEN '$sDate' AND '$eDate'";
    } else if($sDate) {
        $query = "SELECT * FROM $log_table WHERE date1='$sDate'";
    } else {
        $query = "SELECT * FROM $log_table";
    }
    $result = mysqli_query($con,$query);
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_array($result)) {
            $rNo = $row['rollno'];
            $name = '';
            $feeAmount = 0;
            $pQ = "SELECT * FROM $table WHERE rollno='$rNo'";
            $pR = mysqli_query($con,$pQ);
            if($pR) {
                $pRow = mysqli_fetch_array($pR);
                $name = $pRow['name'];
                $feeAmount = $pRow['fee_amount'];
            }

            $pdf->Cell(50 ,6,date_format(new DateTime($row['date1']),'d-m-Y'),1,0,'L');
            $pdf->Cell(50 ,6,$name,1,0,'L');
            $pdf->Cell(50 ,6,$row['rollno'],1,0,'L');   
            $pdf->Cell(50 ,6,$row['amount'],1,1,'L');
        }
    }
    
    $pdf->Output();
}



?>