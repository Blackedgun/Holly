<?php
require_once('../reg.php');
session_start();

if (isset($_GET['id'])) {
  $producto_id = $_GET['id'];
  $sentencia = "SELECT * FROM producto WHERE producto_id = ?";
  $stmt = $conn->prepare($sentencia);
  $stmt->bind_param("i", $producto_id);
  $stmt->execute();
  $resultado = $stmt->get_result();
  $row = $resultado->fetch_assoc();
} else {
  echo "Producto no encontrado.";
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="../img/LogoHolly.png" />
  <title>Holly Store</title>
  <link rel="stylesheet" href="../css/Tiendacss/showcase.css" />
  <link rel="stylesheet" href="../css/storemanualslider.css" />
  <link rel="stylesheet" href="../css/normalize.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&display=swap" rel="stylesheet" />
</head>
<body style="background: url(../img/pinkdot2.jpg)">
  <header class="header">
    <div class="Brand">
      <img src="../img/LogoHolly.png" alt="Holly Dashing" />
    </div>
    <nav>
      <ul>
        <li><a href="../Interface.php">Inicio</a></li>
        <li><a href="Tienda.php">Tienda</a></li>
        <li><a href="../contact.php">Contactanos</a></li>
      </ul>
    </nav>
    <div class="login-button">
    <a href="../carrito/carrito.php">
    <i style="transform: translate(-40px); color: white;" class="fas fa-shopping-cart fa-2x"></i>
        <span class="nav-item" style="color: beige;"></span>
      </a>
      <a href="../login/Formulario.php"><button>Iniciar Sesión</button></a>
    </div>
  </header>

  <div class="main-container">
    <div class="container-pop-items">
      <div class="secondline">
        <p>DETALLES DE PRODUCTO</p>
      </div>
      <img src="data:image/jpg;base64, <?php echo base64_encode($row['prod_image']); ?>" alt="producto" />
      <div style="width: 300px;" class="picture-det">
        <h4>DESCRIPCIÓN</h4>
        <br><br>
        <ol>
          <h2>Producto</h2>
          <li><?php echo $row['prod_nombre']; ?></li>
          <br /><br>
          <h2>Descripción</h2>
          <li><?php echo $row['prod_descripcion'] ?></li>
          <br /><br>
          <h2>Precio</h2>
          <li>$<?php echo $row['prod_precio']; ?></li>
          <br /><br>
          <h2>Cantidad Disponible</h2>
          <li><?php echo $row['prod_cantidad']; ?></li>
          <br /><br>
          <h2>Estado</h2>
          <li><?php echo $row['disponibilidad'] ?></li>
        </ol>
        <br>
        <form action="../functions/addcart.php" method="POST">
          <input type="hidden" name="producto_id" value="<?php echo $producto_id; ?>">
          <button type="submit" <?php echo $row['disponibilidad'] == 'Agotado' ? 'disabled' : ''; ?>>Añadir al carrito</button>
        </form>
      </div>
    </div>
  </div>

  <div class="secondline-bottom">
    <p>
      Te invitamos a que cuides, respetes y mejores tu piel con la mejor
      delicadeza.
    </p>
  </div>
</body>

<footer class="footer">
  <div class="Brand">
    <img src="../img/LogoHolly.png" alt="Holly Dashing" />
  </div>
  <div class="footercont">
    <nav>
      <ul>
        <li><a href="../Interface.php">Inicio</a></li>
        <li><a href="Tienda.php">Tienda</a></li>
        <li><a href="../contact.php">Contactanos</a></li>
      </ul>
    </nav>
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
