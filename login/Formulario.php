<!DOCTYPE html>
<html lang="es">

<head class="Strengthhead">
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="../img/LogoHolly.png">
  <title>Formulario Ingreso</title>
  <link rel="stylesheet" href="../css/Style.css" />
  <link rel="stylesheet" href="../css/normalize.css" />
</head>

<body style="background: url(../img/pinkdot2.jpg)">
  <form action="login_usuario.php" class="form-register" method="POST">
    <h4>Iniciar Sesión</h4>
    <div>
      <input class="controls" type="text" name="codigo" id="codigo" placeholder="Ingrese su código" required />
    </div>
    <div>
      <input class="controls" type="email" name="email" id="email" placeholder="Ingrese su correo" required />
    </div>
    <div>
      <input class="controls" type="password" name="contrasena" id="contrasena" placeholder="Ingrese su Constraseña" required />
    </div>
    <p><a href="password_recovery/password_recovery.php">Olvide mi contraseña</a></p>
    <input class="bottom" type="submit" value="Ingresar" />
  </form>
  <script src="../js/app.js"></script>
</body>
</html>