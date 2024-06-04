<?php
include "../reg.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="../img/LogoHolly.png" />
  <title>Holly Store</title>
  <link rel="stylesheet" href="../css/Tiendacss/Storecalzado.css" />
  <link rel="stylesheet" href="../css/storemanualslider.css" />
  <link rel="stylesheet" href="../css/normalize.css" />
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
        <li><a href="../info/informacion.php">Información</a></li>
        <li><a href="../contact.php">Contactanos</a></li>
      </ul>
    </nav>
    <div class="login-button">
      <a href="../login/Formulario.php"><button>Iniciar Sesión</button></a>
    </div>
  </header>

  <div class="slider-frame">
    <ul>
      <li><img src="../img/zapatos.jpeg" alt="" /></li>
    </ul>
    <div>
      <p class="texta">Calzado Holly Dashing</p>
    </div>
  </div>

  <div class="secondline-bottom">
    <p>Echa un vistazo a todos nuestros descuentos</p>
  </div>

  <div class="main-container">
    <div class="first_container">
      <p>Explora</p>
      <ol>
        <br /><br />
        <a href="Camisetas.php">
          <li>Camisetas</li>
        </a><br /><br />
        <a href="" style="color: rgb(241, 163, 248);">
          <li>Calzado</li>
        </a><br /><br />
        <a href="Jeans.php">
          <li>Pantalones</li>
        </a><br /><br />
        <a href="Chaquetas.php">
          <li>Chaquetas</li>
        </a><br /><br />
        <a href="Pijamas.php">
          <li>Pijamas</li>
        </a><br /><br />
        <a href="Tienda.php">
          <li>Tienda</li>
        </a><br /><br />
      </ol>
    </div>

    <div class="container-pop-items">
      <div class="secondline">
        <p>CALZADO</p>
      </div>
      
      <?php 
          $sentencia = "SELECT * FROM producto WHERE cat_id = 3";
          $listaProductos = mysqli_query($conn, $sentencia); 
      ?>

      <?php foreach($listaProductos as $row){?>
      <a href="Tienda/Jeans.html">
            <div class="picture-det">
              <img style="height: 140px;" src="data:image/jpg;base64, <?php echo base64_encode($row['prod_image']); ?>" alt="producto" />
              <ol>
                <li><?php echo $row['prod_nombre']; ?></li>
                <br />
                <li>Precio: $<?php echo $row['prod_precio']; ?></li>
              </ol>
            </div>
          </a>
      <?php } ?>
    </div>
  </div>

  <div class="secondline-bottom">
    <p>Te invitamos a que cuides, respetes y mejores tu piel con la mejor delicadeza.</p>
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
        <li><a href="../info/informacion.php">Información</a></li>
        <li><a href="../contact.php">Contactanos</a></li>
      </ul>
    </nav>
    <p>©2024 Holly Dashing | Todos los derechos reservados</p>
  </div>
  <ul class="social-icon">
    <li>
      <a href=""><img src="../img/x.png" alt="" /></a>
    </li>
    <li>
      <a href=""><img src="../img/facebook.png" alt="" /></a>
    </li>
    <li>
      <a href=""><img src="../img/instagram.png" alt="" /></a>
    </li>
    <li>
      <a href=""><img src="../img/whatsapp.png" alt="" /></a>
    </li>
  </ul>
</footer>

</html>