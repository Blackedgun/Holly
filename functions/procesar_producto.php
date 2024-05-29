<?php
include '../reg.php';

$nombre = $_POST['nombre'];
$cantidad = $_POST['cantidad'];
$precio = $_POST['precio'];
$descripcion = $_POST['descripcion'];
$categoria = $_POST['categoria'];
$disponi = $_POST['disponibilidad'];

if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));

    $query = "INSERT INTO producto (prod_nombre, prod_cantidad, prod_precio, prod_descripcion, cat_id, disponibilidad, prod_image) VALUES ('$nombre', '$cantidad', '$precio', '$descripcion', '$categoria', '$disponi', '$imagen')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header('location: ../user/inventory.php');
    } else {
        echo 'Error al agregar el producto.';
    }
} else {
    echo 'Por favor seleccione una imagen para continuar.';
}
?>
