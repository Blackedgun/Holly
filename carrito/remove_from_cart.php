<?php
require_once('../reg.php');

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sentencia = "DELETE FROM cart WHERE id = ?";
  $stmt = $conn->prepare($sentencia);
  $stmt->bind_param("i", $id);
  $stmt->execute();
}

header("Location: carrito.php");
exit();
?>