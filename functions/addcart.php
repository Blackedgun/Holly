<?php
require_once('../reg.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $producto_id = $_POST['producto_id'];

    // Obtener los detalles del producto desde la base de datos
    $sentencia = "SELECT * FROM producto WHERE producto_id = ?";
    $stmt = $conn->prepare($sentencia);
    $stmt->bind_param("i", $producto_id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $producto = $resultado->fetch_assoc();

    if (!$producto) {
        echo "Producto no encontrado.";
        exit();
    }

    // Agregar el producto al carrito en la sesión (para mantener compatibilidad)
    if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Verificar si el producto ya está en el carrito
    $producto_encontrado = false;
    foreach ($_SESSION['cart'] as &$item) {
        if (is_array($item) && isset($item['producto_id'])) {
            if ($item['producto_id'] == $producto_id) {
                $item['cantidad'] += 1;  // Incrementar la cantidad si ya existe
                $producto_encontrado = true;
                break;
            }
        }
    }

    if (!$producto_encontrado) {
        $_SESSION['cart'][] = [
            'producto_id' => $producto_id,
            'prod_nombre' => $producto['prod_nombre'],
            'prod_precio' => $producto['prod_precio'],
            'prod_image' => $producto['prod_image'],
            'cantidad' => 1
        ];
    }

    header("Location: ../carrito/carrito.php");
    exit();
}
?>
