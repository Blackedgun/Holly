<?php
require_once('../reg.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $producto_id = $_POST['producto_id'];

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

    if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Verificar si el producto ya está en el carrito
    $producto_encontrado = false;
    foreach ($_SESSION['cart'] as &$item) {
        if (is_array($item) && isset($item['producto_id'])) {
            if ($item['producto_id'] == $producto_id) {
                if ($item['cantidad'] < $producto['prod_cantidad']) {
                    $item['cantidad'] += 1;
                } else {
                    echo "<script>alert('No hay suficiente cantidad de producto disponible.');</script>";
                }
                $producto_encontrado = true;
                break;
            }
        }
    }

    if (!$producto_encontrado) {
        $product = [
            'producto_id' => $producto_id,
            'prod_nombre' => $producto['prod_nombre'],
            'prod_precio' => $producto['prod_precio'],
            'prod_image' => $producto['prod_image'],
            'cantidad' => 1,
            'max_cantidad' => $producto['prod_cantidad']
        ];
        $_SESSION['cart'][] = $product;
    }

    header("Location: ../carrito/carrito.php");
    exit();
}
?>
