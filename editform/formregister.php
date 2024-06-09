<?php
include "../reg.php";

session_start();
if (empty($_SESSION['usuario'])) {
  header('location: ../Interface.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head class="Strengthhead">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../img/LogoHolly.png">
  <title>Edición de usuarios</title>
  <link rel="stylesheet" href="../css/Style.css">
  <link rel="stylesheet" href="../css/normalize.css">
</head>

<body style="background:url(../img/pinkdot2.jpg)">
  <?php
  if (isset($_POST['enviar'])) {

    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $apellido =$_POSTs["apellido"];
    $doc = $_POST["doc"];
    $docno = $_POST["doc_no"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $rol = $_POST["rol"];
    

    $qli = "UPDATE usuario SET 
            usuario_id = '$id',
            nombre = '$nombre', 
            apellido = '$apellido', 
            tipo_documento = '$doc',
            no_documento = '$docno', 
            email = '$correo'
            telefono = '$telefono'
            rol_id = '$rol'
            WHERE usuario_id = '$id'";
    $resultado = mysqli_query($conn, $qli);

    if ($resultado) {
      echo "<script language='JavaScript'>
        alert ('Los datos se han actualizado correctamente');
        location.assign ('../user/inventory.php');
        </script>";
    } else {
      echo "<script language='JavaScript'>
        alert ('No se pudieron actualizar los datos');
        location.assign ('../user/inventory.php');
        </script>";
    }

    mysqli_close($conn);
    
  } else {
    $id = $_GET["id"];
    $sql = "SELECT * FROM usuario WHERE usuario_id='$id'";
    $resultado = mysqli_query($conn, $sql);

    if ($resultado) {
      $filas = mysqli_fetch_assoc($resultado);
      $id = $filas["usuario_id"];
      $nombre = $filas["nombre"];
      $apellido = $filas["apellido"];
      $doc = $filas["tipo_documento"];
      $docno = $filas["no_documento"];
      $correo = $filas["email"];
      $telefono = $filas["telefono"];
      $rol = $filas["rol_id"];
    }

  ?>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" class="form-register" method="POST" enctype="multipart/form-data">
    <h4>Edición de usuarios</h4>
        <div>
            <input class="controls" type="text" name="nombre" id="nombre" placeholder="Corrija los nombres del empleado" required />
        </div>
        <div>
            <input class="controls" type="text" name="apellido" id="apellido" placeholder="Corrija los apellidos del empleado" required />
        </div>
        <label style="color: black;" for="doc">Tipo de documento:</label>
        <select id="doc" name="doc" required>
            <option value="Cédula de Ciudadanía">Cédula de Ciudadanía</option>
            <option value="Cédula de Extranjería">Cédula de Extranjería</option>
            <option value="Pasaporte">Pasaporte</option>
        </select><br><br>
        <div>
            <input class="controls" type="number" name="doc_no" id="doc_no" placeholder="Corrija el número de documento" required />
        </div>
        <div>
            <input class="controls" type="text" name="correo" id="correo" placeholder="Correo actualizado del empleado" required />
        </div>
        <div>
            <input class="controls" type="number" name="telefono" id="telefono" placeholder="Teléfono nuevo empleado" required />
        </div>
        <label style="color: black;" for="rol">Interfaz nueva de usuario </label>
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

      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <input class="bottom" type="submit" name="enviar" value="Actualizar usuario">
    </form>
  <?php
  
    mysqli_close($conn);
  }
  ?>
</body>

</html>
