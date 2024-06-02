<?php

require('fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('https://logopond.com/logos/58fef5b7f302e7d32bfc17a21f56b008.png',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',12);
    // Move to the right
    $this->Cell(60);
    // Title
    $this->Cell(70,10,'Horario',0,0,'C');
    // Line break
    $this->Ln(20);

    $this->Cell(10, 10, 'ID', 1, 0, 'C', 0);
    $this->Cell(28, 10, 'Nombre', 1, 0, 'C', 0);
    $this->Cell(28, 10, 'Lunes', 1, 0, 'C', 0);
    $this->Cell(28, 10, 'Martes', 1, 0, 'C', 0);
    $this->Cell(28, 10,utf8_decode('Miercoles'), 1, 0, 'C', 0);
    $this->Cell(28, 10, 'Jueves', 1, 0, 'C', 0);
    $this->Cell(28, 10, 'Viernes', 1, 0, 'C', 0);
    $this->Cell(17, 10, 'Emp...', 1, 1, 'C', 0);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,utf8_decode('Pagína ').$this->PageNo().'/{nb}',0,0,'C');
}
}

require ('reg.php');

$quiet = "SELECT * FROM horario";
$query = $conn->query($quiet);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);


while($r = $query->fetch_assoc()){
    $pdf->Cell(10, 10, $r['Hor_id'], 1, 0, 'C', 0);
    $pdf->Cell(28, 10, $r['Hor_name'], 1, 0, 'C', 0);
    $pdf->Cell(28, 10, $r['Hor_lunes'], 1, 0, 'C', 0);
    $pdf->Cell(28, 10, $r['Hor_martes'], 1, 0, 'C', 0);
    $pdf->Cell(28, 10, $r['Hor_miercoles'], 1, 0, 'C', 0);
    $pdf->Cell(28, 10, $r['Hor_jueves'], 1, 0, 'C', 0);
    $pdf->Cell(28, 10, $r['Hor_viernes'], 1, 0, 'C', 0);
    $pdf->Cell(17, 10, $r['emp_id'], 1, 1, 'C', 0);

}

$pdf->Output();

?>