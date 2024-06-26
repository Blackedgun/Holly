<?php
include '../../reg.php';

session_start();
if (empty($_SESSION['usuario'])) {
  header('location: ../Interface.php');
  exit();
}

$usuario = $_SESSION['usuario'];

$sql = "SELECT rol_id FROM usuario WHERE usuario_id = '$usuario'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  if ($row['rol_id'] != 1) {
    header('location: ../../alert.php');
    exit();
  }
}

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
    $this->Cell(70,10,'Camisetas',0,0,'C');
    // Line break
    $this->Ln(20);

    $this->Cell(20, 10, 'ID', 1, 0, 'C', 0);
    $this->Cell(70, 10, 'Producto', 1, 0, 'C', 0);
    $this->Cell(30, 10, 'Cantidad', 1, 0, 'C', 0);
    $this->Cell(30, 10, 'Precio', 1, 0, 'C', 0);
    $this->Cell(30, 10, utf8_decode('Categoría'), 1, 1, 'C', 0);
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

require ('../../reg.php');

$quiet = "SELECT * FROM producto WHERE cat_id = 2";
$query = $conn->query($quiet);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);


while($r = $query->fetch_assoc()){
    $pdf->Cell(20, 10, $r['producto_id'], 1, 0, 'C', 0);
    $pdf->Cell(70, 10, utf8_decode($r['prod_nombre']), 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $r['prod_cantidad'], 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $r['prod_precio'], 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $r['cat_id'], 1, 1, 'C', 0);

}

$pdf->Output();

?>