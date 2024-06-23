<?php
include "../reg.php";
include "../functions/addcart.php";



if ((isset($_SESSION['cart']) && !empty($_SESSION['cart']))) {
    foreach ($_SESSION['cart'] as $index => $item) {
        $subtotal = $item['prod_precio'] * $item['cantidad'];
        $total += $subtotal;
    }

     echo "<h3>" .number_format($subtotal, 2). "<h3>";

    echo "<h3>". $total. "<h3>";
}


/*
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$correo = $_POST['correo'];
$direccion = $_POST['direccion'];
$localidad = $_POST['localidad'];
$barrio = $_POST['barrio'];
$telefono = $_POST['telefono'];
$notas = $_POST['order_notes'];


if (isset($_FILES['comprobante']) && $_FILES['comprobante']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = '../comprobantes/';
    $uploadFile = $uploadDir . basename($_FILES['comprobante']['name']);

    if (move_uploaded_file($_FILES['comprobante']['tmp_name'], $uploadFile)) {
        $sentencia = "INSERT INTO cliente ('nombre_cli', 'correo_cli', 'direccion_cli', 'localidad', 'barrio', 'telefono', 'notas', 'comprobante') VALUES ('$nombre', '$apellido', '$correo', '$direccion', '$localidad', '$barrio', '$telefono', '$notas', '$uploadFile');";
        $clientSecret = $conn->query($sentencia);

        if ($clientSecret) {
            echo '<script>
                alert("Cliente agregado con éxito");
                window.location = "../interface.php";
            </script>';
        } else {
            echo '<script>
                alert("Algo salió mal con el registro");
                window.location = "postulante.php";
            </script>';
        }
    } else {
        echo '<script>
            alert("Error al subir el archivo.");
            window.location = "postulante.php";
        </script>';
    }
} else {
    echo '<script>
        alert("Por favor seleccione un documento para continuar");
        window.location = "postulante.php";
    </script>';
}
    */
