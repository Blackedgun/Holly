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
  <link rel="stylesheet" href="../css/Tiendacss/Storepantalon.css" />
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
        <li><a href="Informacion">Información</a></li>
        <li><a href="Contactos">Contactanos</a></li>
      </ul>
    </nav>

    <div class="login-button">
      <a href="../login/Formulario.php"><button>Iniciar Sesión</button></a>
    </div>
  </header>
  <div class="slider-frame">
    <ul>
      <li><img src="../img/jeanmodelres.jpg" alt="" /></li>
    </ul>
    <div>
      <p class="texta">Pantalones Holly Dashing</p>
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
        <a href="Calzado.php">
          <li>Calzado</li>
        </a><br /><br />
        <a href="" style="color: rgb(241, 163, 248);">
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
        <p>PANTALONES</p>
      </div>
      <div class="column">
        <a href="Tienda/Jeans.html">
          <div class="picture-det">
            <img src="img/americanino_jean.jpg" alt="img-galeria" />
            <?php
            $inv = "SELECT * FROM producto WHERE producto_id = 9";
            $resulta = mysqli_query($conn, $inv);
            if ($row = mysqli_fetch_array($resulta)) {
            ?>
              <ol>
                <li>
                  <?php echo $row['prod_nombre'] ?>
                </li>
                <br />
                <li>
                  <?php echo $row['prod_descripcion'] ?>
                </li>
                <br />
                <li>
                  Precio: $
                  <?php echo $row['prod_precio'] ?>
                </li>
              </ol>
            <?php
            }
            ?>
          </div>
        </a>
        <a href="#">
          <div class="picture-det">
            <img src="img/Loewe_clara.jpg" alt="img-galeria" />
            <?php
            $inv = "SELECT * FROM producto WHERE producto_id = 15";
            $resulta = mysqli_query($conn, $inv);
            if ($row = mysqli_fetch_array($resulta)) {
            ?>
              <ol>
                <li>
                  <?php echo $row['prod_nombre'] ?>
                </li>
                <br />
                <li>
                  <?php echo $row['prod_descripcion'] ?>
                </li>
                <br />
                <li>
                  Precio: $
                  <?php echo $row['prod_precio'] ?>
                </li>
              </ol>
            <?php
            }
            ?>
          </div>
        </a>
        <a href="#">
          <div class="picture-det">
            <img src="img/camisa_col_dama.jpg" alt="img-galeria" />
            <?php
            $inv = "SELECT * FROM producto WHERE producto_id = 1";
            $resulta = mysqli_query($conn, $inv);
            if ($row = mysqli_fetch_array($resulta)) {
            ?>
              <ol>
                <li>
                  <?php echo $row['prod_nombre'] ?>
                </li>
                <br />
                <li>
                  <?php echo $row['prod_descripcion'] ?>
                </li>
                <br />
                <li>
                  Precio: $
                  <?php echo $row['prod_precio'] ?>
                </li>
              </ol>
            <?php
            }
            ?>
          </div>
        </a>
        <a href="Tienda/Jeans.html">
          <div class="picture-det">
            <img src="img/diesel_zapatilla.jpg" alt="img-galeria" />
            <?php
            $inv = "SELECT * FROM producto WHERE producto_id = 11";
            $resulta = mysqli_query($conn, $inv);
            if ($row = mysqli_fetch_array($resulta)) {
            ?>
              <ol>
                <li>
                  <?php echo $row['prod_nombre'] ?>
                </li>
                <br />
                <li>
                  <?php echo $row['prod_descripcion'] ?>
                </li>
                <br />
                <li>
                  Precio: $
                  <?php echo $row['prod_precio'] ?>
                </li>
              </ol>
            <?php
            }
            ?>
          </div>
        </a>
      </div>
      <div class="column">
        <a href="#">
          <div class="picture-det">
            <img src="img/levis_dark_portrait.jpg" alt="img-galeria" />
            <?php
            $inv = "SELECT * FROM producto WHERE producto_id = 5";
            $resulta = mysqli_query($conn, $inv);
            if ($row = mysqli_fetch_array($resulta)) {
            ?>
              <ol>
                <li>
                  <?php echo $row['prod_nombre'] ?>
                </li>
                <br />
                <li>
                  <?php echo $row['prod_descripcion'] ?>
                </li>
                <br />
                <li>
                  Precio: $
                  <?php echo $row['prod_precio'] ?>
                </li>
              </ol>
            <?php
            }
            ?>
          </div>
        </a>
        <a href="#">
          <div class="picture-det">
            <img src="img/Boss_azul_bosque.jpg" alt="img-galeria" />
            <?php
            $inv = "SELECT * FROM producto WHERE producto_id = 4";
            $resulta = mysqli_query($conn, $inv);
            if ($row = mysqli_fetch_array($resulta)) {
            ?>
              <ol>
                <li>
                  <?php echo $row['prod_nombre'] ?>
                </li>
                <br />
                <li>
                  <?php echo $row['prod_descripcion'] ?>
                </li>
                <br />
                <li>
                  Precio: $
                  <?php echo $row['prod_precio'] ?>
                </li>
              </ol>
            <?php
            }
            ?>
          </div>
        </a>
        <a href="#">
          <div class="picture-det">
            <img src="img/camisa_colombia.jpg" alt="img-galeria" />
            <?php
            $inv = "SELECT * FROM producto WHERE producto_id = 2";
            $resulta = mysqli_query($conn, $inv);
            if ($row = mysqli_fetch_array($resulta)) {
            ?>
              <ol>
                <li>
                  <?php echo $row['prod_nombre'] ?>
                </li>
                <br />
                <li>
                  <?php echo $row['prod_descripcion'] ?>
                </li>
                <br />
                <li>
                  Precio: $
                  <?php echo $row['prod_precio'] ?>
                </li>
              </ol>
            <?php
            }
            ?>
          </div>
        </a>
        <a href="Tienda/Jeans.html">
          <div class="picture-det">
            <img src="img/babuchas_gatito.jpg" alt="img-galeria" />
            <?php
            $inv = "SELECT * FROM producto WHERE producto_id = 12";
            $resulta = mysqli_query($conn, $inv);
            if ($row = mysqli_fetch_array($resulta)) {
            ?>
              <ol>
                <li>
                  <?php echo $row['prod_nombre'] ?>
                </li>
                <br />
                <li>
                  <?php echo $row['prod_descripcion'] ?>
                </li>
                <br />
                <li>
                  Precio: $
                  <?php echo $row['prod_precio'] ?>
                </li>
              </ol>
            <?php
            }
            ?>
          </div>
        </a>
      </div>
      <div class="column">
        <a href="#">
          <div class="picture-det">
            <img src="img/levis_gloomy_portrait.jpg" alt="img-galeria" />
            <?php
            $inv = "SELECT * FROM producto WHERE producto_id = 10";
            $resulta = mysqli_query($conn, $inv);
            if ($row = mysqli_fetch_array($resulta)) {
            ?>
              <ol>
                <li>
                  <?php echo $row['prod_nombre'] ?>
                </li>
                <br />
                <li>
                  <?php echo $row['prod_descripcion'] ?>
                </li>
                <br />
                <li>
                  Precio: $
                  <?php echo $row['prod_precio'] ?>
                </li>
              </ol>
            <?php
            }
            ?>
          </div>
        </a>
        <a href="#">
          <div class="picture-det">
            <img src="img/Tommy_oscuro_diseño.jpg" alt="img-galeria" />
            <?php
            $inv = "SELECT * FROM producto WHERE producto_id = 14";
            $resulta = mysqli_query($conn, $inv);
            if ($row = mysqli_fetch_array($resulta)) {
            ?>
              <ol>
                <li>
                  <?php echo $row['prod_nombre'] ?>
                </li>
                <br />
                <li>
                  <?php echo $row['prod_descripcion'] ?>
                </li>
                <br />
                <li>
                  Precio: $
                  <?php echo $row['prod_precio'] ?>
                </li>
              </ol>
            <?php
            }
            ?>
          </div>
        </a>
        <a href="Tienda/Jeans.html">
          <div class="picture-det">
            <img src="img/camisa_negra_colombia.jpg" alt="img-galeria" />
            <?php
            $inv = "SELECT * FROM producto WHERE producto_id = 6";
            $resulta = mysqli_query($conn, $inv);
            if ($row = mysqli_fetch_array($resulta)) {
            ?>
              <ol>
                <li>
                  <?php echo $row['prod_nombre'] ?>
                </li>
                <br />
                <li>
                  <?php echo $row['prod_descripcion'] ?>
                </li>
                <br />
                <li>
                  Precio: $
                  <?php echo $row['prod_precio'] ?>
                </li>
              </ol>
            <?php
            }
            ?>
          </div>
        </a>
        <a href="Tienda/Jeans.html">
          <div class="picture-det">
            <img src="img/babuchas_vaca.jpg" alt="img-galeria" />
            <?php
            $inv = "SELECT * FROM producto WHERE producto_id = 13";
            $resulta = mysqli_query($conn, $inv);
            if ($row = mysqli_fetch_array($resulta)) {
            ?>
              <ol>
                <li>
                  <?php echo $row['prod_nombre'] ?>
                </li>
                <br />
                <li>
                  <?php echo $row['prod_descripcion'] ?>
                </li>
                <br />
                <li>
                  Precio: $
                  <?php echo $row['prod_precio'] ?>
                </li>
              </ol>
            <?php
            }
            ?>
          </div>
        </a>
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
        <li><a href="Informacion">Información</a></li>
        <li><a href="Contactos">Contactanos</a></li>
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