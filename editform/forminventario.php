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
    echo "<script language='JavaScript'>
        alert ('Usted no tiene permitido el acceso a esta vista');
        location.assign ('../Interface.php');
        </script>";
    exit();
  }
} 

?>

<!DOCTYPE html>
<html lang="es">

<head class="Strengthhead">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../img/LogoHolly.png">
  <title>Edición de producto</title>
  <link rel="stylesheet" href="../css/Style.css">
  <link rel="stylesheet" href="../css/normalize.css">
</head>

<body style="background:url(../img/pinkdot2.jpg)">
  <?php
  if (isset($_POST['enviar'])) {

    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $cantidad = $_POST["cantidad"];
    $precio = $_POST["precio"];
    $descripcion = $_POST["descripcion"];
    $categoria = $_POST["categoria"];
    $disponibilidad = $_POST["disponibilidad"];
    $pop = $_POST["popular"];
    
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
      $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
      $update_image = ", prod_image = '$imagen'";
    } else {
      $update_image = "";
    }

    $qli = "UPDATE producto SET 
            prod_nombre = '$nombre',
            prod_cantidad = '$cantidad', 
            prod_precio = '$precio', 
            prod_descripcion = '$descripcion',
            cat_id = '$categoria', 
            disponibilidad = '$disponibilidad',
            popular = '$pop'
            $update_image
            WHERE producto_id = '$id'";
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
    $sql = "SELECT * FROM producto WHERE producto_id='$id'";
    $resultado = mysqli_query($conn, $sql);

    if ($resultado) {
      $filas = mysqli_fetch_assoc($resultado);
      $nombre = $filas["prod_nombre"];
      $cantidad = $filas["prod_cantidad"];
      $precio = $filas["prod_precio"];
      $descripcion = $filas["prod_descripcion"];
      $categoria = $filas["cat_id"];
      $disponibilidad = $filas["disponibilidad"];
      $pop = $filas["popular"];
      $imagen = $filas["prod_image"];
    }

  ?>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" class="form-register" method="POST" enctype="multipart/form-data">
      <h4>Editar Producto</h4>

      <input class="controls" type="text" id="nombre" name="nombre" value="<?php echo $nombre?>" placeholder="Ingrese nombre de producto" required><br><br>

      <input class="controls" type="number" id="cantidad" name="cantidad" value="<?php echo $cantidad?>" placeholder="Ingrese la cantidad" required><br><br>

      <input class="controls" type="number" step="0.01" id="precio" name="precio" value="<?php echo $precio?>" placeholder="Ingrese el precio" required><br><br>

      <input style="height: 100px;" class="controls" type="text" id="descripcion" name="descripcion" value="<?php echo $descripcion?>" placeholder="Ingrese una descripcion (Max 200 carácteres)"  maxlength="200" required><br><br>

      <label style="color: black;" for="categoria">Categoría: </label>
      <select id="categoria" name="categoria" required>
        <?php
        $query = "SELECT cat_id, categoria FROM categoria";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
          $selected = ($row['cat_id'] == $categoria) ? 'selected' : '';
          echo '<option value="' . $row['cat_id'] . '" ' . $selected . '>' . $row['categoria'] . '</option>';
        }
        ?>
      </select><br><br>

      <label style="color: black;" for="disponibilidad">Disponibilidad: </label>
      <select id="disponibilidad" name="disponibilidad" required>
        <option value="Disponible" <?= $disponibilidad == 'Disponible' ? 'selected' : '' ?>>Disponible</option>
        <option value="Agotado" <?= $disponibilidad == 'Agotado' ? 'selected' : '' ?>>Agotado</option>
      </select><br><br>

      <label style="color: black;" for="popular">Es un producto popular?: </label>
      <select id="popular" name="popular" required>
        <option value="No" <?= $pop == 'No' ? 'selected' : '' ?>>No</option>
        <option value="Si" <?= $pop == 'Si' ? 'selected' : '' ?>>Si</option>
      </select><br><br>

      <label style="color: black;" for="imagen">Imagen:</label>
      <input type="file" id="imagen" name="imagen"><br><br>

      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <input class="bottom" type="submit" name="enviar" value="Actualizar Producto">
    </form>
  <?php
  
    mysqli_close($conn);
  }
  ?>
</body>

</html>
