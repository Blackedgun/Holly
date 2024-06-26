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

// Consulta a la base de datos
$hor = "SELECT * FROM usuario";
$query = $conn->query($hor);

// Crear un nuevo objeto SimpleXMLElement
$xml = new SimpleXMLElement('<root_contact/>');

if ($query) {
    while ($r = $query->fetch_object()) {
        // Añadir cada registro como un nuevo elemento 'contact' con sus atributos
        $contact = $xml->addChild('contact');
        $contact->addAttribute('ID', $r->usuario_id);
        $contact->addAttribute('Nombres', $r->nombre);
        $contact->addAttribute('Apellidos', $r->apellido);
        $contact->addAttribute('TipoDocumento', $r->tipo_documento);
        $contact->addAttribute('NumeroDocumento', $r->no_documento);
        $contact->addAttribute('Correo', $r->email);
        $contact->addAttribute('Teléfono', $r->telefono);
        $contact->addAttribute('Rol', $r->rol_id);
    }
}

// Crear un nuevo objeto DOMDocument y cargar el XML generado por SimpleXMLElement
$dom = new DOMDocument('1.0', 'UTF-8');
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->loadXML($xml->asXML());

// Enviar las cabeceras HTTP adecuadas para la descarga del archivo XML
header('Content-Type: application/xml; charset=utf-8');
header('Content-Disposition: attachment; filename="Usuarios.xml"');

// Imprimir el XML formateado
echo $dom->saveXML();
?>
