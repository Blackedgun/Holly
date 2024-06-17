<?php

require_once('../reg.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_index'])) {
  $delete_index = $_GET['delete_index'];

  // Verificar si el índice está en el carrito
  if (isset($_SESSION['cart'][$delete_index])) {
    // Eliminar el producto del carrito en la sesión
    unset($_SESSION['cart'][$delete_index]);

    // Redireccionar de vuelta al carrito después de eliminar
    header("Location: ../carrito/carrito.php");
    exit();
  } else {
    echo "Producto no encontrado en el carrito.";
    exit();
  }
}
