<?php

include "../reg.php";

session_start();
if (empty($_SESSION['usuario'])) {
  header('location: ../Interface.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=, initial-scale=1.0" />
  <link rel="icon" href="../img/LogoHolly.png" />
  <title>Main</title>
  <link rel="stylesheet" href="../css/user-int.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Passion+One:wght@400;700;900&family=Raleway:wght@300;400;700&display=swap" rel="stylesheet" />
</head>
<header></header>

<body style="background: url(../img/pinkdot2.jpg)">
  <div class="container">
    <nav>
      <div class="navbar">
        <div class="logo">
          <img src="../img/LogoHolly.png" alt="" />
          <h2>Holly</h2>
        </div>
        <ul>
          <li>
            <a href="#">
              <i class="fas fa-chart-bar"></i>
              <a href="" style="color: beige"><span class="nav-item">Pedidos</span></a>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="fab fa-dochub"></i>
              <a href="inventory.php"><span class="nav-item">Inventario</span></a>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="fas fa-cog"></i>
              <span class="nav-item">Confuguración</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="fas fa-question-circle"></i>
              <span class="nav-item">Ayuda</span>
            </a>
          </li>
          <li>
            <a href="../login/logout_usuario.php" class="logout">
              <i class="fas fa-sign-out-alt"></i>
              <span class="nav-item">Cerrar Sesión</span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <div>
      <div class="somenew">
        <form class="header__title" action="">
          <input type="text" name="busqueda">
          <br>
          <br>
          <input type="submit" name="enviar" value="Buscar">

          <div>
            <a style="color:#fff; height:fit-content; font-size:1.1rem; width:60px; margin-left:400px; background-color:crimson" class='footer__title' href="../convert/pdf/productopdf.php">PDF</a>
          </div><br>
          <div class="print">
            <a style="color: #707070; background-color: lawngreen;" class='print_button' href="convert/convertocsvinv.php">CSV</a>
          </div>
          <br>
          <div class="print">
            <a style="color: #ffffff; background-color:forestgreen;" class='print_button' href="../convert/productoxml.php">XML</a><br><br>
            <div class="nextbutton">
              <a class="Fetch" href="../additem/addprod.php">Comentarios</a>
            </div>
          </div>
        </form>
        <div style="background: none; border: 0px;" class="someold">
        </div>
      </div><br><br>

      <div class="table__container_two">
        <table>
          <tr>
            <th>Id</th>
            <th>Fecha</th>
            <th>Total</th>
            <th>Estado</th>
            <th>Cliente</th>
            <th>Dirección</th>
            <th>Barrio</th>
            <th>Opciones</th>
          </tr>
          <?php
          $inv = "SELECT * FROM pedidos";
          $resulta = mysqli_query($conn, $inv);
          while ($row = mysqli_fetch_array($resulta)) {
          ?>
            <tr>
              <td>
                <?php echo $row['pedido_id'] ?>
              </td>
              <td>
                <?php echo $row['fecha_ped'] ?>
              </td>
              <td>
                <?php echo $row['total_amount'] ?>
              </td>
              <td>
                <?php echo $row['estado'] ?>
              </td>
              <td>
                <?php echo $row['cliente_id'] ?>
              </td>
              <td>
                <?php echo $row['direccion'] ?>
              </td>
              <td>
                <?php echo $row['barrio'] ?>
              </td>
              <td><a href="../editform/forminventario.php?id=<?php echo $row['pedido_id']; ?>" class="crud_button">Editar</a></td>
            </tr>
          <?php
          }
          ?>
        </table>
      </div>
    </div>
</body>

</html>