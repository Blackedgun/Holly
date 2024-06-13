<?php
session_start();

// Validar si ya hay una sesión iniciada
if (isset($_SESSION['usuario']) && $_SESSION['usuario'] === true) {
    echo '<script>
    alert("Hay una sesión en ejecución, por favor cierre sesión para continuar");
    window.location = "Formulario.php";
    </script>';
    exit;
}

include '../reg.php';

$codigo = $_POST['codigo'];
$correo = $_POST['email'];
$password = md5($_POST['contrasena']);


// Preparar la consulta para prevenir inyección SQL
$stmt = $conn->prepare("SELECT * FROM usuario WHERE email = ? AND contrasena = ? AND usuario_id = ? AND status = 'Activo'");
$stmt->bind_param("sss", $correo, $password, $codigo);
$stmt->execute();
$result = $stmt->get_result();

if (!$stmt) {
    die('Error en la consulta: ' . $conn->error);
}

if ($result->num_rows > 0) {
    $_SESSION['usuario'] = $codigo;

    while ($filadelfia = $result->fetch_assoc()) {
        if ($filadelfia['rol_id'] == 1) {
            header("location: ../user/user.php");
            exit();
        } elseif ($filadelfia['rol_id'] == 2) {
            session_destroy();
            header("location: ../pendiente.php");
            exit();
        } elseif ($filadelfia['rol_id'] == 3) {
            header("location: ../user/empleado/useremp.php");
            exit();
        }
    }

    if (!$stmt) {
        die('Error en la consulta: ' . $conn->error);
    }
} else {
    echo '<script>
         alert("El usuario no existe o a sido desactivado por administración");
         window.location = "Formulario.php";
    </script>';
    exit;
}

$stmt->close();
$conn->close();
