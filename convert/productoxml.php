<?php

include '../reg.php';

$hor = "SELECT * FROM producto";

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
header('Content-Disposition: attachment; filename="Inventario.xml";');
echo $dom->saveXML();
?>