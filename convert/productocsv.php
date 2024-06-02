<?php 

include '../reg.php';

$hor = "SELECT * FROM inventario";

$query = $conn->query($hor);

if($query){
    echo  "I.D,";
    echo  "Producto,";
    echo  "Precio,";
    echo  "Cantidad,";
    echo  "Descripcion,";
    echo  "Empleado que registró \n";

   while($grab = $query->fetch_object()){
         echo $grab->inv_id. ",";
         echo $grab->inv_producto. ",";
         echo $grab->inv_precio. ",";
         echo $grab->inv_cantidad. ",";
         echo $grab->inv_descripcion. ",";
         echo $grab->emp_id. "\n";
   }
}

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="Inventario.csv";');

?>