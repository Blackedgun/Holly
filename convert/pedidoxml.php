<?php
include "../reg.php";

session_start();
if (empty($_SESSION['usuario'])) {
  header('location: ../Interface.php');
  exit();
}
?>

<?php

include '../reg.php';

$hor = "SELECT pedidos.pedido_id, pedidos.fecha_ped, pedidos.total_amount, pedidos.estado, cliente.nombre_cli FROM pedidos INNER JOIN cliente ON pedidos.cliente_id = cliente.cliente_id";

$query = $conn->query($hor);

$xml = new SimpleXMLElement('<root_contact/>');

if($query){

while ($r = $query->fetch_object()) {

        $contact = $xml->addChild('contact', '');
        $contact->addAttribute('ID', $r->pedido_id);
        $contact->addAttribute('Fecha', date('Y-m-d H:i:s', strtotime($r->fecha_ped)));
        $contact->addAttribute('Total', $r->total_amount);
        $contact->addAttribute('Estado', $r->estado);
        $contact->addAttribute('Cliente', $r->nombre_cli); 

 }
}

$dom = new DOMDocument('1.0');
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->loadXML($xml->asXML());

header('Content-Type: text/xml Charset="utf8"');
header('Content-Disposition: attachment; filename="Pedidos.xml";');
echo $dom->saveXML();
?>