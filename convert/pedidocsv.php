<?php 

include '../reg.php';

$hor = "SELECT * FROM pedidos";

$query = $conn->query($hor);

if($query){
    echo  "ID,";
    echo  "Fecha de pedido,";
    echo  "Total,";
    echo  "Estado,";
    echo  "Cliente,";
    echo  "Dirección,";
    echo  "Barrio \n";

   while($grab = $query->fetch_object()){
         echo $grab->pedido_id. ",";
         echo $grab->fecha_ped. ",";
         echo $grab->total_amount. ",";
         echo $grab->estado. ",";
         echo $grab->cliente_id. ",";
         echo $grab->direccion. ",";
         echo $grab->barrio. "\n";
   }
}

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="pedidos.csv";');

?>