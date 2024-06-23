<?php
include "../reg.php";

session_start();
if (empty($_SESSION['usuario'])) {
  header('location: ../Interface.php');
  exit();
}

$usuario = $_SESSION['usuario'];


$sql = "SELECT rol_id FROM usuario WHERE usuario_id = '$usuario'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  if ($row['rol_id'] != 1) {
    header('location: ../alert.php');
    exit();
  }
} 

?>

<!DOCTYPE html>
<html lang="es">

<head class="Strengthhead">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../img/LogoHolly.png">
    <title>Formulario de registro</title>
    <link rel="stylesheet" href="../css/Style.css" />
    <link rel="stylesheet" href="../css/normalize.css" />
</head>

<body style="background: url(../img/pinkdot2.jpg)">
    <form action="../functions/adduser.php" class="form-register" method="POST">
        <h4>Registrar empleado</h4>
        <div>
            <input class="controls" type="text" name="nombre" id="nombre" placeholder="Ingrese los nombres del nuevo empleado" required />
        </div>
        <div>
            <input class="controls" type="text" name="apellido" id="apellido" placeholder="Ingrese los apellidos del nuevo empleado" required />
        </div>
        <label style="color: black;" for="doc">Tipo de documento:</label>
        <select id="doc" name="doc" required>
            <option value="Cédula de Ciudadanía">Cédula de Ciudadanía</option>
            <option value="Cédula de Extranjería">Cédula de Extranjería</option>
            <option value="Pasaporte">Pasaporte</option>
        </select><br><br>
        <div>
            <input class="controls" type="number" name="doc_no" id="doc_no" placeholder="Digite el número de documento de identidad" required />
        </div>
        <div>
            <input class="controls" type="text" name="correo" id="correo" placeholder="Correo del nuevo empleado" required />
        </div>
        <div>
            <input class="controls" type="number" name="telefono" id="telefono" placeholder="Teléfono del nuevo empleado" required />
        </div>
        <div>
            <input class="controls" type="password" name="password" id="password" placeholder="No digite nada en este campo" required minlength="4" maxlength="40" readonly/>
        </div>
        <label style="color: black;" for="rol">Interfaz de usuario (pendiente): </label>
        <select id="rol" name="rol" required>
            <?php
            include '../reg.php';
            $query = "SELECT * FROM rol WHERE rol_id != 1";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' . $row['rol_id'] . '">' . $row['interfaz'] . '</option>';
            }
            ?>
        </select><br><br>
        <label style="color: black;" for="estado">Estado del usuario: </label>
        <select id="estado" name="estado" required>
            <option value="Activo">Activo</option>
            <option value="Inactivo">Inactivo</option>
        </select><br><br>
        <input class="bottom" type="submit" value="Registrar" />
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('password').value = 'just';
        });
    </script>
</body>

</html>