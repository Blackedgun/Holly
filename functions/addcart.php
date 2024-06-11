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

    // Verificar si el producto ya está en el carrito en la base de datos
    $sentencia_carrito = "SELECT * FROM cart WHERE producto_id = ?";
    $stmt_carrito = $conn->prepare($sentencia_carrito);
    $stmt_carrito->bind_param("i", $producto_id);
    $stmt_carrito->execute();
    $resultado_carrito = $stmt_carrito->get_result();
    $producto_en_carrito = $resultado_carrito->fetch_assoc();

    if ($producto_en_carrito) {
        // Incrementar la cantidad si ya existe
        $nueva_cantidad = $producto_en_carrito['cantidad'] + 1;
        $sentencia_actualizar = "UPDATE cart SET cantidad = ? WHERE producto_id = ?";
        $stmt_actualizar = $conn->prepare($sentencia_actualizar);
        $stmt_actualizar->bind_param("ii", $nueva_cantidad, $producto_id);
        $stmt_actualizar->execute();
    } else {
        // Agregar un nuevo producto al carrito
        $sentencia_insertar = "INSERT INTO cart (producto_id, cantidad) VALUES (?, ?)";
        $stmt_insertar = $conn->prepare($sentencia_insertar);
        $cantidad = 1; // Cantidad inicial
        $stmt_insertar->bind_param("ii", $producto_id, $cantidad);
        $stmt_insertar->execute();
    }

    // Agregar el producto al carrito en la sesión (para mantener compatibilidad)
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Verificar si el producto ya está en el carrito
    $producto_encontrado = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['producto_id'] == $producto_id) {
            $item['cantidad'] += 1;  // Incrementar la cantidad si ya existe
            $producto_encontrado = true;
            break;
        }
    }

    if (!$producto_encontrado) {
        // Agregar un nuevo producto al carrito
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
