<?php
include '../reg.php';

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$doc = $_POST['doc'];
$docno = $_POST['doc_no'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$password = md5($_POST['password']);
$rol = $_POST['rol'];

// Verificar si el correo o el teléfono ya está registrado
$verificacion_correo_telefono = mysqli_query($conn, "SELECT * FROM usuario WHERE email = '$correo' OR telefono = '$telefono' OR no_documento = '$docno'");

if (mysqli_num_rows($verificacion_correo_telefono) > 0) {
    echo '<script>
         alert("Este correo, teléfono y/o documento ya ha sido registrado, intente de nuevo");
         window.location = "../registro/postulante.php";
    </script>';
    mysqli_close($conn);
    exit();
}
        
$query = "INSERT INTO usuario (nombre, apellido, tipo_documento, no_documento, email, telefono, contrasena, rol_id) VALUES ('$nombre', '$apellido', '$doc', '$docno', '$correo', '$telefono', '$password', '$rol')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo '<script>
                alert("Registro agregado con éxito");
                window.location = "../user/registros.php";
            </script>';
        } else {
            echo '<script>
                alert("Algo salió mal con el registro");
                window.location = "../user/registros.php";
            </script>';
        }
    
?>
