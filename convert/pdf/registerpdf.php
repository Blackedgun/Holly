<?php

require('fpdf.php');

class PDF extends FPDF
{
    // Page header
    function Header()
    {
        // Logo
        $this->Image('../../img/LogoHolly.png',10,2,30);
        // Arial bold 15
        $this->SetFont('Arial','B',12);
        // Move to the right
        $this->Cell(60);
        // Title
        $this->Cell(160,10,'Lista de usuarios',0,0,'C');
        // Line break
        $this->Ln(20);

        $this->Cell(10, 10, 'ID', 1, 0, 'C', 0);
        $this->Cell(35, 10, 'Nombres', 1, 0, 'C', 0);
        $this->Cell(45, 10, 'Apellidos', 1, 0, 'C', 0);
        $this->Cell(40, 10, 'Documento', 1, 0, 'C', 0);
        $this->Cell(30, 10, '# documento', 1, 0, 'C', 0);
        $this->Cell(50, 10, 'Correo', 1, 0, 'C', 0);
        $this->Cell(30, 10, utf8_decode('Teléfono'), 1, 0, 'C', 0);
        $this->Cell(30, 10, 'Rol', 1, 1, 'C', 0); // Adjust here to prevent overlap
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
    }
}

require ('../../reg.php');

$quiet = "SELECT * FROM usuario";
$query = $conn->query($quiet);

$pdf = new PDF('L', 'mm', 'A4'); // Set orientation to Landscape
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);

while($r = $query->fetch_assoc()){
    $pdf->Cell(10, 10, $r['usuario_id'], 1, 0, 'C', 0);
    $pdf->Cell(35, 10, utf8_decode($r['nombre']), 1, 0, 'C', 0);
    $pdf->Cell(45, 10, utf8_decode($r['apellido']), 1, 0, 'C', 0);
    $pdf->Cell(40, 10, utf8_decode($r['tipo_documento']), 1, 0, 'C', 0); 
    $pdf->Cell(30, 10, $r['no_documento'], 1, 0, 'C', 0); // Corrected width
    $pdf->Cell(50, 10, utf8_decode($r['email']), 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $r['telefono'], 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $r['rol_id'], 1, 1, 'C', 0); // Ensure this line starts a new row
}

$pdf->Output();
?>
