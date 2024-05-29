<?php

include "../reg.php";

session_start();
if (empty($_SESSION['usuario'])) {
  header('location: ../Interface.php');
}

?>


<!DOCTYPE html>
<html lang="es">
<head class="Strengthhead">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../img/LogoHolly.png">
    <title>Agregar Producto</title>
    <link rel="stylesheet" href="../css/Style.css" />
    <link rel="stylesheet" href="../css/normalize.css" />
    <script>
        function validateForm() {
            var imagen = document.getElementById("imagen").value;
            if (imagen == "") {
                alert("Por favor seleccione una imagen para continuar");
                return false;
            }
            return true;
        }
    </script>
</head>
<body style="background: url(../img/pinkdot2.jpg)">
    <form action="../functions/procesar_producto.php" class="form-register" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
        <h4>Nuevo Producto</h4>
        <input class="controls" type="text" id="nombre" name="nombre" placeholder="Ingrese nombre de producto" required><br><br>
        <input class="controls" type="number" id="cantidad" name="cantidad" placeholder="Ingrese la cantidad" required><br><br>
        <input class="controls" type="number" step="0.01" id="precio" name="precio" placeholder="Ingrese el precio" required><br><br>
        <input style="width: 618px; height: 100px;" class="controls" type="text" step="0.01" id="desc" name="descripcion" placeholder="Ingrese una descripcion" required><br><br>
        <label style="color: black;" for="categoria">Categoría: </label>
        <select id="categoria" name="categoria" required>
            <?php
            include '../reg.php';
            $query = "SELECT * FROM categoria";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' . $row['cat_id'] . '">' . $row['categoria'] . '</option>';
            }
            ?>
        </select><br><br>
        <label style="color: black;" for="disponibilidad">Disponibilidad: </label>
        <select id="disponibilidad" name="disponibilidad" required>
            <option value="Disponible">Disponible</option>
            <option value="Agotado">Agotado</option>
        </select><br><br>
        <label style="color: black;" for="imagen">Imagen:</label>
        <input type="file" id="imagen" name="imagen"><br><br>
        <input class="bottom" type="submit" value="Agregar Producto">
    </form>
</body>
</html>
