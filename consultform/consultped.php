<?php
include "../reg.php";

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
    <link rel="icon" href="../img/LogoHolly.png">
    <title>Edición de pedido</title>
    <link rel="stylesheet" href="../css/Style.css">
    <link rel="stylesheet" href="../css/normalize.css">
</head>

<body style="background:url(../img/pinkdot2.jpg)">
    <?php
    if (isset($_POST['enviar'])) {
        $estado = $_POST["estado"];
        $id = $_POST["id"];

        $qli = "UPDATE pedidos SET estado = ? WHERE pedido_id = ?";
        $stmt = $conn->prepare($qli);
        $stmt->bind_param("si", $estado, $id);
        $resultado = $stmt->execute();

        if ($resultado) {
            echo "<script language='JavaScript'>
        alert('Se cambió el estado del pedido');
        location.assign('../user/user.php');
        </script>";
        } else {
            echo "<script language='JavaScript'>
        alert('No se pudieron actualizar los datos');
        location.assign('../user/user.php');
        </script>";
        }

        mysqli_close($conn);
    } else {

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

        <form action="<?= $_SERVER['PHP_SELF'] ?>" class="form-register" method="POST" enctype="multipart/form-data">
            <h4 style="text-align: center;">Consulta de pedido</h4>
            <h3 style="text-align: center; color: black;">Pedido ID: <?php echo htmlspecialchars($pedido['pedido_id']); ?></h3>
            <h3 style="text-align: center; color: black;">Fecha: <?php echo htmlspecialchars($pedido['fecha_ped']); ?></h3>
            <h3 style="text-align: center; color: black;">Total: <?php echo htmlspecialchars($pedido['total_amount']); ?></h3>
            <br><br>

            <h4 style="text-align: center;">Detalles del Cliente</h4>
            <h3 style="text-align: center; color: black;">Nombre: <?php echo htmlspecialchars($cliente['nombre_cli']); ?></h3>
            <h3 style="text-align: center; color: black;">Apellido: <?php echo htmlspecialchars($cliente['apellido_cli']); ?></h3>
            <h3 style="text-align: center; color: black;">Correo: <?php echo htmlspecialchars($cliente['correo_cli']); ?></h3>
            <h3 style="text-align: center; color: black;">Teléfono: <?php echo htmlspecialchars($cliente['telefono']); ?></h3>
            <h3 style="text-align: center; color: black;">Dirección: <?php echo htmlspecialchars($cliente['direccion_cli']); ?></h3>
            <h3 style="text-align: center; color: black;">Localidad: <?php echo htmlspecialchars($cliente['localidad']); ?></h3>
            <h3 style="text-align: center; color: black;">Barrio: <?php echo htmlspecialchars($cliente['barrio']); ?></h3>
            <h3 style="text-align: center; color: black;">Notas: <?php echo htmlspecialchars($cliente['notas']); ?></h3>
            <?php if (!empty($cliente['comprobante'])) : ?>
                <a style="color: black;
                        text-decoration: none;
                        height: fit-content;
                        text-align: center;
                        font-size: 20px;" href="../comprobantes/<?php echo htmlspecialchars($cliente['comprobante']); ?>" target="_blank"><h3 style="background: white; width: 50%; text-align: center; margin: auto;  border-radius: 20px; padding: 10px;">Ver comprobante de pago</h3></a>
            <?php else : ?>
                No disponible
            <?php endif; ?>
            <br><br>

            <h4 style="text-align: center;">Detalles del pedido</h4>
            <?php while ($detalle = $detallesResultado->fetch_assoc()) { ?>
                <h3 style="text-align: center; color: black;">Producto: <?php echo htmlspecialchars($detalle['prod_nombre']); ?></h3>
                <h3 style="text-align: center; color: black;">Precio Unitario: <?php echo htmlspecialchars($detalle['precio_unit']); ?></h3>
                <h3 style="text-align: center; color: black;">Cantidad: <?php echo htmlspecialchars($detalle['cantidad']); ?></h3>
                <h3 style="text-align: center; color: black;">Método de Pago: <?php echo htmlspecialchars($detalle['metodo_pago']); ?></h3>
                <h3 style="text-align: center; color: black;">Tipo de Entrega: <?php echo htmlspecialchars($detalle['modo_envio']); ?></h3>
                <br><br>
            <?php } ?>

            <label style="color: black; font-size: 20px; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;" for="estado">Estado del pedido: </label>
            <select id="estado" name="estado" required>
                <option value="Pendiente" <?= $pedido['estado'] == 'Pendiente' ? 'selected' : '' ?>>Pendiente</option>
                <option value="Entregado" <?= $pedido['estado'] == 'Entregado' ? 'selected' : '' ?>>Entregado</option>
            </select><br><br>
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($pedido['pedido_id']); ?>">
            <input class="bottom" type="submit" name="enviar" value="Actualizar estado">
        </form>
    <?php

        mysqli_close($conn);
    }
    ?>
</body>

</html>