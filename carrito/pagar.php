<?php
include "../reg.php";
session_start();

if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

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

    if ($_POST) {
        $total = 0;
        $SID = session_id();

        if (move_uploaded_file($_FILES['comprobante']['tmp_name'], $uploadFile)) {
            $sentencia = "INSERT INTO cliente (nombre_cli, apellido_cli, correo_cli, direccion_cli, localidad, barrio, telefono, notas, comprobante) VALUES ('$nombre', '$apellido', '$correo', '$direccion', '$localidad', '$barrio', '$telefono', '$notas', '$uploadFile');";
            $result = $conn->query($sentencia);
            $clientSecret = $conn->insert_id; // Importante: Este script obtiene el id del último cliente insertado.

            if ($result) {
                foreach ($_SESSION['cart'] as $index => $item) {
                    $total += $item['prod_precio'] * $item['cantidad'];
                }

                if (!isset($pdo)) {
                    $pdo = new PDO('mysql:host=localhost;dbname=holly', 'root', '');
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }

                $sentencia = $pdo->prepare("INSERT INTO pedidos (claveTransaccion, fecha_ped, total_amount, estado, cliente_id) VALUES (:claveTransaccion, current_timestamp(), :Total, 'Pendiente', :cliente);");
                $sentencia->bindParam(":claveTransaccion", $SID);
                $sentencia->bindParam(":Total", $total);
                $sentencia->bindParam(":cliente", $clientSecret);

                if ($sentencia->execute()) {
                    $pedidoId = $pdo->lastInsertId();

                    $facturaSentencia = $pdo->prepare("INSERT INTO factura (descripcion, condiciones, fecha) VALUES ('Gracias por haber comprado en Holly Dashing esperamos vuelva pronto!', '(Esta factura se anulará automáticamente ante cualquier queja o reclamo en caso de que el comprobante de pago no coincida con el total a pagar o el archivo cargado sea incorrecto)', current_timestamp());");
                    $facturaSentencia->execute();
                    $facturaId = $pdo->lastInsertId();

                    $detalleSentencia = $pdo->prepare("INSERT INTO detalle (factura_id, producto_id, pedido_id, precio_unit, cantidad, metodo_pago, modo_envio) VALUES (:factura_id, :producto_id, :pedido_id, :precio_unit, :cantidad, 'Código QR', 'Envío');");
                    $updateProductQuantitySentencia = $pdo->prepare("UPDATE producto SET prod_cantidad = prod_cantidad - :cantidad WHERE producto_id = :producto_id");

                    foreach ($_SESSION['cart'] as $index => $item) {
                        $detalleSentencia->bindParam(":factura_id", $facturaId);
                        $detalleSentencia->bindParam(":producto_id", $item['producto_id']);
                        $detalleSentencia->bindParam(":pedido_id", $pedidoId);
                        $detalleSentencia->bindParam(":precio_unit", $item['prod_precio']);
                        $detalleSentencia->bindParam(":cantidad", $item['cantidad']);
                        $detalleSentencia->execute();

                        $updateProductQuantitySentencia->bindParam(":producto_id", $item['producto_id']);
                        $updateProductQuantitySentencia->bindParam(":cantidad", $item['cantidad']);
                        $updateProductQuantitySentencia->execute();
                    }

                    echo '<script>
                    alert("Compra Exitosa");
                    window.location = "../interface.php";
                    </script>';
                } else {
                    echo '<script>
                        alert("Algo salió mal al agregar el pedido");
                        window.location = "confirm.php";
                    </script>';
                }
            } else {
                echo '<script>
                    alert("Algo salió mal con el registro del cliente");
                    window.location = "confirm.php";
                </script>';
            }
        } else {
            echo '<script>
                alert("Error al subir el archivo.");
                window.location = "confirm.php";
            </script>';
        }
    }
} else {
    echo '<script>
        alert("Por favor seleccione un documento para continuar");
        window.location = "confirm.php";
    </script>';
}

unset($_SESSION['cart']);
exit();
?>
