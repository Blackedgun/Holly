<!DOCTYPE html>
<html lang="es">
<head class="Strengthhead">
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="../img/LogoHolly.png">
  <title>Formulario de postulantes</title>
  <link rel="stylesheet" href="../css/Style.css" />
  <link rel="stylesheet" href="../css/normalize.css" />
  <script>
    function validateForm() {
      var curriculum = document.getElementById("curriculum").value;
      if (curriculum == "") {
        alert("Por favor seleccione un documento para continuar");
        return false;
      }
      return true;
    }
  </script>
</head>
<body style="background: url(../img/pinkdot2.jpg)">
  <form action="../functions/reg_postulante.php" class="form-register" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
    <h4>Envia tus datos</h4>
    <div>
      <input class="controls" type="text" name="nombre" id="nombre" placeholder="Ingrese los nombres del nuevo empleado" required />
    </div>
    <div>
      <input class="controls" type="text" name="apellido" id="apellido" placeholder="Ingrese los apellidos del nuevo empleado" required />
    </div>
    <div>
      <input class="controls" type="number" name="edad" id="edad" placeholder="Digite su edad" required />
    </div>
    <div>
      <input class="controls" type="email" name="correo" id="correo" placeholder="Digite su dirección de correo electrónico" required />
    </div>
    <div>
      <input class="controls" type="text" name="direccion" id="direccion" placeholder="Escriba su dirección" required />
    </div>
    <div>
      <input class="controls" type="text" name="barrio" id="barrio" placeholder="Barrio en el que vive" required />
    </div>
    <div>
      <input class="controls" type="number" name="telefono" id="telefono" placeholder="Digite su teléfono de contacto" required minlength="10" maxlength="11" required />
    </div>
    <label style="color: black;" for="curriculum">Hoja de Vida (Max 4MB):</label>
    <input type="file" id="curriculum" name="curriculum" required><br><br>
    <input class="bottom" type="submit" value="Postularse ahora"/>
  </form>
</body>
<footer class="footer">
  <div class="Brand">
    <img src="../img/LogoHolly.png" alt="Holly Dashing" />
  </div>
  <div class="footercont">
    <p>©2024 Holly Dashing | Todos los derechos reservados</p>
  </div>
  <ul class="social-icon">
    <li>
      <a href="https://x.com/eldiariodedross"><img src="../img/x.png" alt="" /></a>
    </li>
    <li>
      <a href="https://www.facebook.com/Seniorwhis"><img src="../img/facebook.png" alt="" /></a>
    </li>
    <li>
      <a href="https://www.instagram.com/senior_whiiss/"><img src="../img/instagram.png" alt="" /></a>
    </li>
    <li>
      <a href="https://wa.me/3025193306"><img src="../img/whatsapp.png" alt="" /></a>
    </li>
  </ul>
</footer>
</html>


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
