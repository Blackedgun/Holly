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

$hor = "SELECT * FROM usuario";

$query = $conn->query($hor);

if($query){
    echo  "ID,";
    echo  "Nombres,";
    echo  "Apellidos,";
    echo  "tipo_documento,";
    echo  "no_documento,";
    echo  "email,";
    echo  "telefono,";
    echo  "Rol \n";

   while($grab = $query->fetch_object()){
         echo $grab->usuario_id. ",";
         echo $grab->nombre. ",";
         echo $grab->apellido. ",";
         echo $grab->tipo_documento. ",";
         echo $grab->no_documento. ",";
         echo $grab->email. ",";
         echo $grab->telefono. ",";
         echo $grab->rol_id. "\n";
   }
}

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="Usuarios.csv";');

?>