<?php
require('fpdf/fpdf.php');

$mysqli = new mysqli('localhost', 'root', '', 'capstone') or die (mysqli_error($mysqli));

$pdf = new FPDF();
///var_dump(get_class_methods($pdf));

$pdf->AddPage();
$pdf->Image('pictures/logo.jpg',5,8,40,24,'JPG');
$pdf->Image('pictures/asean.jpg',165,8,30,25,'JPG');
$pdf->SetFont('Arial','',12);
$pdf->Cell(50,80,'Date:'.date('d-m-Y').'',0,"R");
$pdf->Multicell(80,5,"Republic of the Philippines\nCEBU TECHNOLOGICAL UNIVERSITY\nNaga Extension Campus\nMEDICAL CLINIC",0,"C");
$pdf->Ln(25);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(190,10,'Medicines Inventory',1,1,"C");
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,8,'No.',1);

$pdf->Cell(30,8,'Medicine Name',1);
$pdf->Cell(30,8,'Prescription',1);
$pdf->Cell(30,8,'Expiration Date',1);
$pdf->Cell(30,8,'Requested Date',1);
$pdf->Cell(20,8,'Quantity',1);
$pdf->Cell(20,8,'Available',1);
$pdf->Cell(20,8,'Dispense',1);



$query="SELECT medicine_name,prescription, expiration_date, requested_date, SUM(quantity), SUM(available), SUM(quantity)-SUM(available) AS dispense FROM medicines GROUP BY medicine_name";
$result = mysqli_query($mysqli, $query);
$no=0;
while($row = mysqli_fetch_array($result)){
	$no=$no+1;
	$pdf->Ln(8);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(10,8,$no,1);
	$pdf->Cell(30,8,$row['medicine_name'],1);
	$pdf->Cell(30,8,$row['prescription'],1);
	$pdf->Cell(30,8,$row['expiration_date'],1);
	$pdf->Cell(30,8,$row['requested_date'],1);
	$pdf->Cell(20,8,$row['SUM(quantity)'],1);
	$pdf->Cell(20,8,$row['SUM(available)'],1);
    $pdf->Cell(20,8,$row['dispense'],1);
}
$pdf->Output();
?>