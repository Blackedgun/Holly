<?php 

include '../reg.php';

$hor = "SELECT * FROM producto";

$query = $conn->query($hor);

if($query){
    echo  "ID,";
    echo  "Producto,";
    echo  "Descripcion,";
    echo  "Cantidad,";
    echo  "Precio,";
    echo  "Categoría,";
    echo  "Disponibilidad \n";

   while($grab = $query->fetch_object()){
         echo $grab->producto_id. ",";
         echo $grab->prod_nombre. ",";
         echo $grab->prod_descripcion. ",";
         echo $grab->prod_cantidad. ",";
         echo $grab->prod_precio. ",";
         echo $grab->cat_id. ",";
         echo $grab->disponibilidad. "\n";
   }
}

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="Inventario.csv";');

?>