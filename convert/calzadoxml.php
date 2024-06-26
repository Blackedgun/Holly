<?php
include '../reg.php';

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
    header('location: ../alert.php');
    exit();
  }
}

$hor = "SELECT * FROM producto WHERE cat_id = 3";

$query = $conn->query($hor);

$xml = new SimpleXMLElement('<root_contact/>');

if($query){

while ($r = $query->fetch_object()) {
    
        $contact = $xml->addChild('contact', '');
        $contact->addAttribute('ID', $r->producto_id);
        $contact->addAttribute('Producto', $r->prod_nombre);
        $contact->addAttribute('Descripción', $r->prod_descripcion);
        $contact->addAttribute('Cantidad', $r->prod_cantidad);
        $contact->addAttribute('Precio', $r->prod_precio);
        $contact->addAttribute('Categoría', $r->cat_id);
        $contact->addAttribute('Disponibilidad', $r->disponibilidad);
    

 }
}

$dom = new DOMDocument('1.0');
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->loadXML($xml->asXML());

header('Content-Type: text/xml Charset="utf8"');
header('Content-Disposition: attachment; filename="Inventario_calzado.xml";');
echo $dom->saveXML();
?>