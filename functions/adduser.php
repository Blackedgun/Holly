<?php
include '../reg.php';

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$genero = $_POST['genero'];
$edad = $_POST['edad'];
$correo = $_POST['correo'];
$direccion = $_POST['direccion'];
$barrio = $_POST['barrio'];
$telefono = $_POST['telefono'];

// Verificar si el correo o el teléfono ya está registrado
$verificacion_correo_telefono = mysqli_query($conn, "SELECT * FROM postulantes WHERE Correo = '$correo' OR Telefono = '$telefono'");

if (mysqli_num_rows($verificacion_correo_telefono) > 0) {
    echo '<script>
         alert("Este correo o teléfono ya ha sido registrado");
         window.location = "../registro/postulante.php";
    </script>';
    mysqli_close($conn);
    exit();
}

if (isset($_FILES['curriculum']) && $_FILES['curriculum']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = '../curriculums/'; // Asegúrate de que esta carpeta existe y tiene permisos de escritura
    $uploadFile = $uploadDir . basename($_FILES['curriculum']['name']);

    if (move_uploaded_file($_FILES['curriculum']['tmp_name'], $uploadFile)) {
        $query = "INSERT INTO postulantes (Nombres, Apellidos, Genero, Edad, Correo, Direccion, Barrio, Telefono, Curriculum) VALUES ('$nombre', '$apellido', '$genero', '$edad', '$correo', '$direccion', '$barrio', '$telefono', '$uploadFile')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo '<script>
                alert("Postulación agregada con éxito");
                window.location = "../interface.php";
            </script>';
        } else {
            echo '<script>
                alert("Algo salió mal con la postulación");
                window.location = "postulante.php";
            </script>';
        }
    } else {
        echo '<script>
            alert("Error al subir el archivo.");
            window.location = "postulante.php";
        </script>';
    }
} else {
    echo '<script>
        alert("Por favor seleccione un documento para continuar");
        window.location = "postulante.php";
    </script>';
}
?>
