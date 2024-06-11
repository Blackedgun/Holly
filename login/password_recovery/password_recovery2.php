<!DOCTYPE html>
<html lang="es">

<head class="Strengthhead">
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="../../img/LogoHolly.png" />
  <title>Recuperar contraseña</title>
  <link rel="stylesheet" href="../../css/Style.css" />
  <link rel="stylesheet" href="../../css/normalize.css" />
  <script>
    function validatePasswords() {
      const newPassword = document.getElementById('newPassword').value;
      const confirmPassword = document.getElementById('confirmPassword').value;

      if (newPassword !== confirmPassword) {
        alert('Las contraseñas no coinciden. Por favor, inténtalo de nuevo.');
        return false;
      }
      return true;
    }
  </script>
</head>

<body style="background: url(../../img/pinkdot2.jpg)">
  <form action="change_password.php" class="form-register" method="POST" onsubmit="return validatePasswords()">
    <h4>Recuperación de contraseña</h4>
    <div>
      <input class="controls" type="password" id="newPassword" name="new_password" placeholder="Ingrese su contraseña nueva" minlength="8" maxlength="40" required />
    </div>
    <div>
      <input class="controls" type="password" id="confirmPassword" placeholder="Confirme su contraseña nueva" minlength="8" maxlength="40" required />
    </div>
    <br />
    <br />
    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
    <input class="bottom" type="submit" value="Recuperar contraseña" />
  </form>
</body>
<footer class="footer">
  <div class="Brand">
    <img src="../../img/LogoHolly.png" alt="Holly Dashing" />
  </div>
  <div class="footercont">
    <p>©2024 Holly Dashing | Todos los derechos reservados</p>
  </div>
  <ul class="social-icon">
  </ul>
</footer>

</html>