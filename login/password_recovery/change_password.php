<?php 
require_once('../../reg.php');

$id = $_POST['id'];
$pass = md5($_POST['new_password']);

$query = "UPDATE usuario SET contrasena = '$pass' WHERE usuario_id = $id";
$conn->query($query);

$conn->close();

echo '<script>
         alert("Su contraseña se ha actualizado con éxito");
         window.location = "../Formulario.php";
    </script>';
?>
