<?php
include "../../reg.php";

session_start();
if (empty($_SESSION['usuario'])) {
    header('location: ../../Interface.php');
    exit();
}


$id = $_GET['id'];

$pedidoSql = "SELECT * FROM pedidos WHERE pedido_id = ?";
$pedidoStmt = $conn->prepare($pedidoSql);
$pedidoStmt->bind_param("i", $id);
$pedidoStmt->execute();
$pedidoResultado = $pedidoStmt->get_result();
$pedido = $pedidoResultado->fetch_assoc();


$clienteSql = "SELECT * FROM cliente WHERE cliente_id = ?";
$clienteStmt = $conn->prepare($clienteSql);
$clienteStmt->bind_param("i", $pedido['cliente_id']);
$clienteStmt->execute();
$clienteResultado = $clienteStmt->get_result();
$cliente = $clienteResultado->fetch_assoc();


$detallesSql = "SELECT detalle.*, producto.prod_nombre 
                FROM detalle 
                JOIN producto ON detalle.producto_id = producto.producto_id 
                WHERE detalle.pedido_id = ?";
$detallesStmt = $conn->prepare($detallesSql);
$detallesStmt->bind_param("i", $id);
$detallesStmt->execute();
$detallesResultado = $detallesStmt->get_result();

?>

<!DOCTYPE html>
<html lang="es">

<head class="Strengthhead">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../img/LogoHolly.png">
    <title>Consulta de pedido</title>
    <link rel="stylesheet" href="../../css/Style.css">
    <link rel="stylesheet" href="../../css/normalize.css">
</head>

<body style="background:url(../../img/pinkdot2.jpg)">
    <?php

    $id = $_GET["id"];
    $pedidoSql = "SELECT * FROM pedidos WHERE pedido_id = ?";
    $pedidoStmt = $conn->prepare($pedidoSql);
    $pedidoStmt->bind_param("i", $id);
    $pedidoStmt->execute();
    $pedidoResultado = $pedidoStmt->get_result();
    $pedido = $pedidoResultado->fetch_assoc();

    $clienteSql = "SELECT * FROM cliente WHERE cliente_id = ?";
    $clienteStmt = $conn->prepare($clienteSql);
    $clienteStmt->bind_param("i", $pedido['cliente_id']);
    $clienteStmt->execute();
    $clienteResultado = $clienteStmt->get_result();
    $cliente = $clienteResultado->fetch_assoc();

    $detallesSql = "SELECT detalle.*, producto.prod_nombre 
                    FROM detalle 
                    JOIN producto ON detalle.producto_id = producto.producto_id 
                    WHERE detalle.pedido_id = ?";
    $detallesStmt = $conn->prepare($detallesSql);
    $detallesStmt->bind_param("i", $id);
    $detallesStmt->execute();
    $detallesResultado = $detallesStmt->get_result();
    ?>

    <div style="margin: auto; height: auto; border: 5px solid black; background: pink; width: fit-content; display: flex; flex-direction: column; padding: 40px 150px 40px;">
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
            <h4 style="text-align: center; font-size: 27px;
                        margin-bottom: 20px;
                        font-family: Passion One, sans-serif;
                        font-style: normal;
                        color: rgb(255, 255, 255);
                        text-shadow: 
                        -1px -1px 0 #000,  
                        1px -1px 0 #000,  
                        -1px 1px 0 #000,  
                        2px 2px 0 #000;">Consulta de pedido</h4>
            <h3 style="text-align: center; color: black;">Pedido ID: <?php echo htmlspecialchars($pedido['pedido_id']); ?></h3>
            <h3 style="text-align: center; color: black;">Fecha: <?php echo htmlspecialchars($pedido['fecha_ped']); ?></h3>
            <h3 style="text-align: center; color: black;">Total: <?php echo htmlspecialchars($pedido['total_amount']); ?></h3>
            <br><br>

            <h4 style="text-align: center; font-size: 27px;
                        margin-bottom: 20px;
                        font-family: Passion One, sans-serif;
                        font-style: normal;
                        color: rgb(255, 255, 255);
                        text-shadow: 
                        -1px -1px 0 #000,  
                        1px -1px 0 #000,  
                        -1px 1px 0 #000,  
                        2px 2px 0 #000;">Detalles del Cliente</h4>
            <h3 style="text-align: center; color: black;">Nombre: <?php echo htmlspecialchars($cliente['nombre_cli']); ?></h3>
            <h3 style="text-align: center; color: black;">Apellido: <?php echo htmlspecialchars($cliente['apellido_cli']); ?></h3>
            <h3 style="text-align: center; color: black;">Correo: <?php echo htmlspecialchars($cliente['correo_cli']); ?></h3>
            <h3 style="text-align: center; color: black;">Teléfono: <?php echo htmlspecialchars($cliente['telefono']); ?></h3>
            <h3 style="text-align: center; color: black;">Dirección: <?php echo htmlspecialchars($cliente['direccion_cli']); ?></h3>
            <h3 style="text-align: center; color: black;">Localidad: <?php echo htmlspecialchars($cliente['localidad']); ?></h3>
            <h3 style="text-align: center; color: black;">Barrio: <?php echo htmlspecialchars($cliente['barrio']); ?></h3>
            <h3 style="text-align: center; color: black;">Notas: <?php echo htmlspecialchars($cliente['notas']); ?></h3>
            <br><br>

            <h4 style="text-align: center; font-size: 27px;
                        margin-bottom: 20px;
                        font-family: Passion One, sans-serif;
                        font-style: normal;
                        color: rgb(255, 255, 255);
                        text-shadow: 
                        -1px -1px 0 #000,  
                        1px -1px 0 #000,  
                        -1px 1px 0 #000,  
                        2px 2px 0 #000;">Detalles del pedido</h4>
            <?php while ($detalle = $detallesResultado->fetch_assoc()) { ?>
                <div style="background: white; width: fit-content; padding: 30px; height: fit-content; border: 1px solid black; margin: auto;">
                <h3 style="text-align: center; color: black;">Producto: <?php echo htmlspecialchars($detalle['prod_nombre']); ?></h3>
                <h3 style="text-align: center; color: black;">Precio Unitario: <?php echo htmlspecialchars($detalle['precio_unit']); ?></h3>
                <h3 style="text-align: center; color: black;">Cantidad: <?php echo htmlspecialchars($detalle['cantidad']); ?></h3>
                <h3 style="text-align: center; color: black;">Método de Pago: <?php echo htmlspecialchars($detalle['metodo_pago']); ?></h3>
                <h3 style="text-align: center; color: black;">Tipo de Entrega: <?php echo htmlspecialchars($detalle['modo_envio']); ?></h3>
                </div>
                <br>
        </form>
    <?php
            }
    ?>
    <a href="useremp.php" style="background-color: white; border: 2px solid black; border-radius: 20px; width: fit-content; height: auto;padding: 10px; text-decoration: none; margin: auto; font-size: 23px; color: black;">Entendido!</a>
    </div>
</body>

</html>