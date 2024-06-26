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

$hor = "SELECT * FROM pedidos";

$query = $conn->query($hor);

if($query){
    echo  "ID,";
    echo  "Fecha de pedido,";
    echo  "Total,";
    echo  "Estado,";
    echo  "Cliente \n";

   while($grab = $query->fetch_object()){
         echo $grab->pedido_id. ",";
         echo $grab->fecha_ped. ",";
         echo $grab->total_amount. ",";
         echo $grab->estado. ",";
         echo $grab->cliente_id. "\n";
   }
}

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="pedidos.csv";');

?>