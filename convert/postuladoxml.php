<?php

include '../reg.php';

// Consulta a la base de datos
$hor = "SELECT * FROM postulantes";
$query = $conn->query($hor);

// Crear un nuevo objeto SimpleXMLElement
$xml = new SimpleXMLElement('<root_contact/>');

if ($query) {
    while ($r = $query->fetch_object()) {
        // Añadir cada registro como un nuevo elemento 'contact' con sus atributos
        $contact = $xml->addChild('contact');
        $contact->addAttribute('ID', $r->post_id);
        $contact->addAttribute('Nombres', $r->Nombres);
        $contact->addAttribute('Apellidos', $r->Apellidos);
        $contact->addAttribute('Genero', $r->Genero);
        $contact->addAttribute('Edad', $r->Edad);
        $contact->addAttribute('TipoDocumento', $r->tipo_documento);
        $contact->addAttribute('NumeroDocumento', $r->no_documento);
        $contact->addAttribute('Correo', $r->Correo);
        $contact->addAttribute('Direccion', $r->Direccion);
        $contact->addAttribute('Barrio', $r->Barrio);
        $contact->addAttribute('Telefono', $r->Telefono);
    }
}

// Crear un nuevo objeto DOMDocument y cargar el XML generado por SimpleXMLElement
$dom = new DOMDocument('1.0', 'UTF-8');
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->loadXML($xml->asXML());

// Enviar las cabeceras HTTP adecuadas para la descarga del archivo XML
header('Content-Type: application/xml; charset=utf-8');
header('Content-Disposition: attachment; filename="Postulados.xml"');

// Imprimir el XML formateado
echo $dom->saveXML();
?>
