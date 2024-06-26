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

$hor = "SELECT * FROM postulantes";

$query = $conn->query($hor);

if($query){
    echo  "ID,";
    echo  "Nombres,";
    echo  "Apellidos,";
    echo  "Genero,";
    echo  "Edad,";
    echo  "tipo_documento,";
    echo  "no_documento,";
    echo  "Correo,";
    echo  "Direccion,";
    echo  "Barrio,";
    echo  "Telefono \n";

   while($grab = $query->fetch_object()){
         echo $grab->post_id. ",";
         echo $grab->Nombres. ",";
         echo $grab->Apellidos. ",";
         echo $grab->Genero. ",";
         echo $grab->Edad. ",";
         echo $grab->tipo_documento. ",";
         echo $grab->no_documento. ",";
         echo $grab->Correo. ",";
         echo $grab->Direccion. ",";
         echo $grab->Barrio. ",";
         echo $grab->Telefono. "\n";
   }
}

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="Postulantes.csv";');

?>