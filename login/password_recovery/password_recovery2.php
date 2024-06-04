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
  </head>
  <body style="background: url(../../img/pinkdot2.jpg)">
    <form action="login_usuario.php" class="form-register" method="POST">
      <h4>Recuperación de contraseña</h4>
      <div>
        <input
          class="controls"
          type="email"
          name="email"
          id="email"
          placeholder="Ingrese su contraseña nueva"
          required
        />
      </div>
      <div>
        <input
          class="controls"
          type="email"
          name="email"
          id="email"
          placeholder="Confirme su contraseña nueva"
          required
        />
      </div>
      <br />
      <br />
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
