<?php
session_start();
require_once('../reg.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_cart'])) {
    foreach ($_POST['quantities'] as $index => $new_quantity) {
        // Validar y actualizar la cantidad en la sesión del carrito
        if (isset($_SESSION['cart'][$index])) {
            $_SESSION['cart'][$index]['cantidad'] = intval($new_quantity);

            // Actualizar también en la base de datos si fuera necesario
            $producto_id = $_SESSION['cart'][$index]['producto_id'];
            $cantidad_actualizada = intval($new_quantity);

            $sentencia_actualizar = "UPDATE producto SET prod_cantidad = ? WHERE producto_id = ?";
            $stmt_actualizar = $conn->prepare($sentencia_actualizar);
            $stmt_actualizar->bind_param("ii", $cantidad_actualizada, $producto_id);
            $stmt_actualizar->execute();
            
        }
    }
}

header("Location: ../carrito/carrito.php");
exit();
?>



