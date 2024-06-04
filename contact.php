<?php

include "reg.php";

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="img/LogoHolly.png" />
    <title>Contácto</title>
    <link rel="stylesheet" href="css/Interface.css" />
    <link rel="stylesheet" href="css/myslides.css" />
    <link rel="stylesheet" href="css/manualslider.css" />
    <link rel="stylesheet" href="css/normalize.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&display=swap"
      rel="stylesheet"
    />
  </head>

  <body style="background: url(img/pinkdot2.jpg)">
    <header class="header">
      <div class="Brand">
        <img src="img/LogoHolly.png" alt="Holly Dashing" />
      </div>
      <nav>
        <ul>
          <li><a href="Interface.php">Inicio</a></li>
          <li><a href="info/informacion.php">Información</a></li>
          <li><a href="">Contactanos</a></li>
        </ul>
      </nav>

      <div class="login-button">
        <a href="login/Formulario.php"><button>Iniciar Sesión</button></a>
      </div>
    </header>

    <div class="secondline">
      <p>CONTÁCTANOS</p>
    </div>
    <div class="container-pop-items">
      <div class="column">
        <h4>Envianos tus comentarios</h4>
        <div class="contact-form">
        <form action="https://formsubmit.co/2178960ae6f5f00a1b7d22e893e69a56" method="POST">
            <input type="text" name="name" placeholder="Ingresa tu nombre" required />
            <input
              type="email"
              name="email"
              placeholder="Ingresa tu correo"
              required
            />
            <input type="text" name="subject" placeholder="Asunto" required />
            <textarea
              name="message"
              rows="5"
              placeholder="Mensaje"
              required
            ></textarea>
            <button type="submit">Enviar</button>
          </form>
        </div>

        <br />
        <br />
        <br />
        <br />

        <div>
          <h4>DATOS DE CONTÁCTO</h4>
          <br>
          <ol style="margin-left: 20px; list-style-type: disc;">
            <li><h1 style="font-size: larger;">Correo: Blackendgun@gmail.com</h1></li>
            <br>
            <li><h1 style="font-size: larger;">Teléfono: 3025193306</h1></li>
            <br>
            <li><h1 style="font-size: larger;">Horarios de atención: Todos los días de 9:00AM a 6:00PM</h1></li>
            <br>
            <li><h1 style="font-size: larger;">Nuestras redes sociales las puedes encontrar en el pie de pagína</h1></li>
            <br>
          </ol>
        </div>
      </div>
      <div style="margin-bottom: 150px;" class="column">
        <h4>Nuestra ubicación</h4>
        <br />

        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3976.87616476084!2d-74.10463362450331!3d4.616149695358559!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f99d56d7e75db%3A0x6e35471a560d19b9!2sCl.%2010%20%2337a-61%2C%20Puente%20Aranda%2C%20Bogot%C3%A1%2C%20Cundinamarca!5e0!3m2!1ses-419!2sco!4v1717485461717!5m2!1ses-419!2sco"
          width="600"
          height="400"
          style="border: 0"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
        ></iframe>
        <br />
        <br />
        <br />
        <p>
          Estamos ubicados en el san andresito de la 38 Centro comercial
          Américas, entrada 7 en el local 103. Que esperas para darnos una
          visíta?
        </p>
      </div>
    </div>
  </body>
  <footer class="footer">
    <div class="Brand">
      <img src="img/LogoHolly.png" alt="Holly Dashing" />
    </div>
    <div class="footercont">
      <nav>
        <ul>
          <li><a href="interface.php">Inicio</a></li>
          <li><a href="info/informacion.php">Información</a></li>
          <li><a href="Contactos">Contactanos</a></li>
        </ul>
      </nav>
      <p>©2024 Holly Dashing | Todos los derechos reservados</p>
    </div>
    <ul class="social-icon">
      <li>
        <a href="https://x.com/blackendgun"><img src="img/x.png" alt="" /></a>
      </li>
      <li>
        <a href="https://www.facebook.com/Seniorwhis"><img src="img/facebook.png" alt="" /></a>
      </li>
      <li>
        <a href="https://www.instagram.com/senior_whiiss/"><img src="img/instagram.png" alt="" /></a>
      </li>
      <li>
        <a href="https://wa.me/3025193306"><img src="img/whatsapp.png" alt="" /></a>
      </li>
    </ul>
  </footer>
</html>
