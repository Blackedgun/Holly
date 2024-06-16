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
      <input class="controls" type="text" name="nombre" id="nombre" placeholder="Ingrese sus Nombres" required />
    </div>
    <div>
      <input class="controls" type="text" name="apellido" id="apellido" placeholder="Ingrese sus Apellidos" required />
    </div>
    <label style="color: black;" for="genero">Escoja su género:</label>
    <select id="genero" name="genero" required>
      <option value="Hombre">Hombre</option>
      <option value="Mujer">Mujer</option>
      <option value="Otro">Otro</option>
    </select><br><br>
    <div>
      <input class="controls" type="number" name="edad" id="edad" placeholder="Digite su edad" required />
    </div>
    <label style="color: black;" for="doc">Tipo de documento:</label>
    <select id="doc" name="doc" required>
      <option value="Cédula de Ciudadanía">Cédula de Ciudadanía</option>
      <option value="Cédula de Extranjería">Cédula de Extranjería</option>
      <option value="Pasaporte">Pasaporte</option>
    </select><br><br>
    <div>
      <input class="controls" type="number" name="doc_no" id="doc_no" placeholder="Digite su número de documento de identidad" required />
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
</html>
