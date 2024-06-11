<?php
require_once('../reg.php');
session_start();

if (isset($_POST['quantities'])) {
  foreach ($_POST['quantities'] as $id => $quantity) {
    $sentencia = "UPDATE cart SET cantidad = ? WHERE id = ?";
    $stmt = $conn->prepare($sentencia);
    $stmt->bind_param("ii", $quantity, $id);
    $stmt->execute();
  }
}

header("Location: carrito.php");
exit();
?>