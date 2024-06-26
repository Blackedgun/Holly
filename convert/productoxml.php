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

ob_start(); // Iniciar almacenamiento en búfer de salida

$invXML = "SELECT producto.*, categoria.categoria AS categoria FROM producto LEFT JOIN categoria ON producto.cat_id = categoria.cat_id";
if (isset($_GET['enviar']) && !empty($_GET['busqueda'])) {
    $busqueda = $_GET['busqueda'];
    $invXML .= " WHERE producto_id LIKE '%$busqueda%' OR prod_nombre LIKE '%$busqueda%' OR categoria LIKE '%$busqueda%' OR prod_cantidad LIKE '%$busqueda%' OR prod_precio LIKE '%$busqueda%' OR disponibilidad LIKE '%$busqueda%'";
}

$query = $conn->query($invXML);

$xml = new SimpleXMLElement('<Inventario/>');

if ($query) {
    while ($r = $query->fetch_object()) {
        $producto = $xml->addChild('Producto');
        $producto->addChild('ID', $r->producto_id);
        $producto->addChild('Nombre', $r->prod_nombre);
        $producto->addChild('Categoría', $r->categoria);
        $producto->addChild('Cantidad', $r->prod_cantidad);
        $producto->addChild('Precio', $r->prod_precio);
        $producto->addChild('Disponibilidad', $r->disponibilidad);
        $producto->addChild('Popular', $r->popular);
    }
}

$dom = new DOMDocument('1.0', 'UTF-8');
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->loadXML($xml->asXML());

header('Content-Type: text/xml; charset=utf-8');
header('Content-Disposition: attachment; filename="Inventario.xml"');

echo $dom->saveXML();

ob_end_flush();
?>
