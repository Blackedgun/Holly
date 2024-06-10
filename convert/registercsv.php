<?php 

include '../reg.php';

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