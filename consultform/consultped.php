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
        $user = $_POST["usuario"];
        $id = $_POST["id"];

        $qli = "UPDATE pedidos SET estado = ?, usuario_id = ? WHERE pedido_id = ?";
        $stmt = $conn->prepare($qli);
        $stmt->bind_param("sii", $estado, $user, $id);
        $resultado = $stmt->execute();

        if ($resultado) {
            echo "<script language='JavaScript'>
        alert('El estado del pedido ha cambiado');
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
        //$user = $pedidoResultado->fetch_assoc();

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
                        font-size: 20px;" href="../comprobantes/<?php echo htmlspecialchars($cliente['comprobante']); ?>" target="_blank">
                    <h3 style="background: white; width: 50%; text-align: center; margin: auto;  border-radius: 20px; padding: 10px;">Ver comprobante de pago</h3>
                </a>
            <?php else : ?>
                No disponible
            <?php endif; ?>
            <br><br>

            <h4 style="text-align: center;">Detalles del pedido</h4>
            <?php while ($detalle = $detallesResultado->fetch_assoc()) { ?>
                <div style="background: white; width: fit-content; padding: 30px; height: fit-content; border: 1px solid black; margin: auto;">
                <h3 style="text-align: center; color: black;">Producto: <?php echo htmlspecialchars($detalle['prod_nombre']); ?></h3>
                <h3 style="text-align: center; color: black;">Precio Unitario: <?php echo htmlspecialchars($detalle['precio_unit']); ?></h3>
                <h3 style="text-align: center; color: black;">Cantidad: <?php echo htmlspecialchars($detalle['cantidad']); ?></h3>
                <h3 style="text-align: center; color: black;">Método de Pago: <?php echo htmlspecialchars($detalle['metodo_pago']); ?></h3>
                <h3 style="text-align: center; color: black;">Tipo de Entrega: <?php echo htmlspecialchars($detalle['modo_envio']); ?></h3>
                </div>
                <br><br>
            <?php } ?>

            <label style="color: black; font-size: 20px; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;"" for=" usuario">Empleado que entrega: </label>
            <select id="usuario" name="usuario" required>
                <?php
                $query = "SELECT usuario_id, nombre FROM usuario WHERE usuario_id > 5";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    $selected = ($row['usuario_id'] == $pedido['usuario_id']) ? 'selected' : '';
                    echo '<option value="' . $row['usuario_id'] . '" ' . $selected . '>' . $row['nombre'] . '</option>';
                }
                ?>
            </select><br><br>

            <label style="color: black; font-size: 20px; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;" for="estado">Estado del pedido: </label>
            <select id="estado" name="estado" required>
                <option value="Pendiente" <?= $pedido['estado'] == 'Pendiente' ? 'selected' : '' ?>>Pendiente</option>
                <option value="Entregado" <?= $pedido['estado'] == 'Entregado' ? 'selected' : '' ?>>Entregado</option>
            </select><br><br>
            <div style="background: white; width: fit-content; padding: 1px 20px 5px; border-radius: 20px; margin: auto;">
                <h2 style="color: black; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">Factura:</h2>
                <a style="padding: 2px; text-decoration: none;color:#fff; height:fit-content; font-size:1.1rem; width:60px; margin-left:28px; background-color:crimson" class='footer__title' href="../facturas/factura_<?php echo htmlspecialchars($pedido['pedido_id']); ?>.pdf" target="_blank">PDF</a>
            </div><br>
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($pedido['pedido_id']); ?>">
            <input class="bottom" type="submit" name="enviar" value="Actualizar estado">
        </form>
    <?php

        mysqli_close($conn);
    }
    ?>
</body>

</html>