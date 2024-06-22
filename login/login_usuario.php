<?php
session_start();

include '../reg.php';

$correo = $_POST['email'];
$password = md5($_POST['contrasena']);

// Preparar la consulta para prevenir inyección SQL
$stmt = $conn->prepare("SELECT * FROM usuario WHERE email = ? AND contrasena = ? AND status = 'Activo'");
$stmt->bind_param("ss", $correo, $password);
$stmt->execute();
$result = $stmt->get_result();

if (!$stmt) {
    die('Error en la consulta: ' . $conn->error);
}

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
    $_SESSION['usuario'] = $usuario['usuario_id'];

    if ($usuario['rol_id'] == 1) {
        header("location: ../user/user.php");
        exit();
    } elseif ($usuario['rol_id'] == 2) {
        session_destroy();
        header("location: ../pendiente.php");
        exit();
    } elseif ($usuario['rol_id'] == 3) {
        header("location: ../user/empleado/useremp.php");
        exit();
    }

    if (!$stmt) {
        die('Error en la consulta: ' . $conn->error);
    }
} else {
    echo '<script>
         alert("El usuario no existe o ha sido desactivado por administración");
         window.location = "Formulario.php";
    </script>';
    exit();
}

$stmt->close();
$conn->close();
