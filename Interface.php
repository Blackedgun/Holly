<?php

include "reg.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="img/LogoHolly.png">
  <title>Holly Dashing</title>
  <link rel="stylesheet" href="css/Interface.css" />
  <link rel="stylesheet" href="css/myslides.css" />
  <link rel="stylesheet" href="css/manualslider.css" />
  <link rel="stylesheet" href="css/normalize.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&display=swap" rel="stylesheet" />
</head>

<body style="background: url(img/pinkdot2.jpg)">
  <header class="header">
    <div class="Brand">
      <img src="img/LogoHolly.png" alt="Holly Dashing" />
    </div>
    <nav>
      <ul>
        <li><a href="Tienda/Tienda.php">Tienda</a></li>
        <li><a href="info/informacion.php">Información</a></li>
        <li><a href="contact.php">Contactanos</a></li>
      </ul>
    </nav>

    <div class="login-button">
      <a href="login/Formulario.php"><button>Iniciar Sesión</button></a>
    </div>
  </header>
  <div class="slider-frame">
    <ul> 
      <li><img src="img/Jeans.jpg" alt="" /></li>
      <li><img src="img/Camisas.jpg" alt="" /></li>
      <li><img src="img/Crocs.jpg" alt="" /></li>
      <li><img src="img/Pijamas.jpg" alt="" /></li>
    </ul>
    <div>
      <p class="texta">Bienvenido a Holly Colombia</p>
      <a class="explore" href="docs/Catálogo de ropa Holly Dashing.pdf"><button>Catálogo</button></a>
    </div>
  </div>
  <div class="secondline-bottom">
    <p>Echa un vistazo a todos nuestros descuentos</p>
  </div>
  <div class="main-container">
  <div class="container-pop-items">
      <div class="secondline">
        <p>PRODUCTOS POPULARES</p>
      </div>
      <?php
      $sentencia = "SELECT * FROM producto WHERE popular = 'Si'";
      $listaProductos = mysqli_query($conn, $sentencia);
      ?>

      <?php foreach ($listaProductos as $row) { ?>
        <a href="Tienda/showcasing.php?id=<?php echo $row['producto_id']; ?>">
          <div class="picture-det">
            <img src="data:image/jpg;base64, <?php echo base64_encode($row['prod_image']); ?>" alt="producto" />
            <ol>
              <li><?php echo $row['prod_nombre']; ?></li>
              <br />
              <li><?php echo $row['disponibilidad']; ?></li>
              <br />
              <li>Precio: $<?php echo $row['prod_precio']; ?></li>
            </ol>
          </div>
        </a>
      <?php } ?>
    </div>
  </div>
  <div class="slider_img"></div>
  </div>
  <div class="secondline-bottom">
    <p>Para que cuides tu piel con la admiración que merece</p>
  </div>
  <div class="slider">
    <!-- list Items -->
    <div class="list">
      <div class="item active">
        <img src="img/jeanmodel.jpg" />
        <div class="content">
          <p>marcas</p>
          <h2>Jeans</h2>
          <p>
            Jeans de la mejor calidad y precio, para conservar una piel tersa
            y lucir íncreible.
          </p>
        </div>
      </div>
      <div class="info-container">
        <div class="item">
          <img src="img/pijamamodel.jpeg" />
          <div class="content">
            <p>modelos</p>
            <h2>Pijamas</h2>
            <p>
              Pijamas de tus personajes favoritos y personalizadas, pide la
              tuya ya.
            </p>
          </div>
        </div>
        <div class="item">
          <img src="img/camisasmodel.jpeg" />
          <div class="content" style="width: 700px">
            <p>marcas</p>
            <h2>Camisetas</h2>
            <p>
              Gran variedad de camisetas, camisas y blusas para dama y
              caballero con grandes promociones.
            </p>
          </div>
        </div>
        <div class="item">
          <img src="img/crocs2.jpeg" />
          <div class="content">
            <p>diseños</p>
            <h2>Calzado</h2>
            <p>
              Manejamos todo tipo de diseños y modelos en calzado, zapatos y sandalias para toda la familia.
            </p>
          </div>
        </div>
        <div class="item">
          <img src="img/chaquetamodel.jpeg" />
          <div class="content" style="width: 700px">
            <p>marcas</p>
            <h2>Chaquetas</h2>
            <p>
              Admira tu proxima nueva chaqueta y luce como una estrella
              consulta nuestro Catálogo y ve por la tuya.
            </p>
          </div>
        </div>
      </div>
    </div>
    <!-- button arrows -->
    <div class="arrows">
      <button id="prev">
        < <button id="next">>
      </button>
    </div>
    <!-- thumbnail -->
    <div class="thumbnail">
      <div class="item active">
        <img src="img/Jeans1.jpg" />
        <div class="content">Pantalones</div>
      </div>
      <div class="item">
        <img src="img/Pijama.jpg" />
        <div class="content">Pijamas</div>
      </div>
      <div class="item">
        <img src="img/Camiseta.jpg" />
        <div class="content">Camisetas</div>
      </div>
      <div class="item">
        <img src="img/crocs1.jpg" />
        <div class="content">Calzado</div>
      </div>
      <div class="item">
        <img src="img/Chaquetapolo.jpg" />
        <div class="content">Chaquetas</div>
      </div>
    </div>
  </div>
  <script src="js/templates.js"></script>
</body>
<footer class="footer">
  <div class="Brand">
    <img src="img/LogoHolly.png" alt="Holly Dashing" />
  </div>
  <div class="footercont">
    <nav>
      <ul>
        <li><a href="Tienda/Tienda.php">Tienda</a></li>
        <li><a href="info/informacion.php">Información</a></li>
        <li><a href="contact.php">Contactanos</a></li>
      </ul>
    </nav>
    <p>©2024 Holly Dashing | Todos los derechos reservados</p>
  </div>

  <div style="margin-right: 40px; margin-bottom: 60px;" class="login-button">
    <a href="registro/info.php"><button>Trabaja con nosotros</button></a>
  </div>

</footer>

</html>