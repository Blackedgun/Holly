<?php

include '../reg.php';

$hor = "SELECT * FROM pedidos";

$query = $conn->query($hor);

$xml = new SimpleXMLElement('<root_contact/>');

if($query){

while ($r = $query->fetch_object()) {
    
        $contact = $xml->addChild('contact', '');
        $contact->addAttribute('ID', $r->pedido_id);
        $contact->addAttribute('Fecha', $r->inv);
        $contact->addAttribute('Total', $r->inv_precio);
        $contact->addAttribute('Estado', $r->inv_cantidad);
        $contact->addAttribute('Descripcion', $r->inv_descripcion);
        $contact->addAttribute('Empleado_que_registró', $r->emp_id);
    

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