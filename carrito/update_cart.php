<?php
session_start();
require_once('../reg.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_cart'])) {
    foreach ($_POST['quantities'] as $index => $new_quantity) {
        if (isset($_SESSION['cart'][$index])) {
            $producto_id = $_SESSION['cart'][$index]['producto_id'];

            $sentencia = "SELECT prod_cantidad FROM producto WHERE producto_id = ?";
            $stmt = $conn->prepare($sentencia);
            $stmt->bind_param("i", $producto_id);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $producto = $resultado->fetch_assoc();

            if ($producto && intval($new_quantity) <= $producto['prod_cantidad']) {
                $_SESSION['cart'][$index]['cantidad'] = intval($new_quantity);

                /*
                $cantidad_actualizada = intval($new_quantity);
                $sentencia_actualizar = "UPDATE producto SET prod_cantidad = ? WHERE producto_id = ?";
                $stmt_actualizar = $conn->prepare($sentencia_actualizar);
                $stmt_actualizar->bind_param("ii", $cantidad_actualizada, $producto_id);
                $stmt_actualizar->execute();
                */
            } 
        }
    }
}

header("Location: ../carrito/carrito.php");
exit();
?>
