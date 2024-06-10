<?php 

include '../reg.php';

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