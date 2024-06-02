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
              <a href="user.php"><span class="nav-item">Pedidos</span></a>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="fab fa-dochub"></i>
              <a href="" style="color: beige"><span class="nav-item">Inventario</span></a>
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
            <a style="color: #707070; background-color: lawngreen;" class='print_button' href="../convert/productocsv.php">CSV</a>
          </div>
          <br>
          <div class="print">
            <a style="color: #ffffff; background-color:forestgreen;" class='print_button' href="../convert/productoxml.php">XML</a><br><br>
            <div class="nextbutton">
              <a class="Fetch" href="../additem/addprod.php">Agregar</a>
            </div>
          </div>
        </form>
        <div class="someold">
          <h4>Categorías</h4>
          <ol>
            <li>1. Pantalones</li>
            <li>2. Camisetas</li>
            <li>3. Calzado</li>
            <li>4. Pijamas</li>
            <li>5. Chaquetas</li>
          </ol>
        </div>
      </div><br><br>

      <div class="table__container_two">
        <table>
          <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Disponibilidad</th>
            <th>Imagen</th>
            <th>Opciones</th>
          </tr>
          <?php
          $inv = "SELECT producto.*, categoria.categoria AS categoria FROM producto LEFT JOIN categoria ON producto.cat_id = categoria.cat_id";
          $resultado = mysqli_query($conn, $inv);
          while ($row = mysqli_fetch_array($resultado)) {
          ?>
            <tr>
              <td>
                <?php echo $row['producto_id'] ?>
              </td>
              <td>
                <?php echo $row['prod_nombre'] ?>
              </td>
              <td>
                <?php echo $row['categoria'] ?>
              </td>
              <td>
                <?php echo $row['prod_cantidad'] ?>
              </td>
              <td>
                <?php echo $row['prod_precio'] ?>
              </td>
              <td>
                <?php echo $row['disponibilidad'] ?>
              </td>
              <td style="color: #f2f2f2"><img height="50px" src="data:image/jpg;base64, <?php echo base64_encode($row['prod_image']) ?>"></td>
              <td><a href="../editform/forminventario.php?id=<?php echo $row['producto_id']; ?>" class="crud_button">Editar</a></td>
            </tr>
          <?php
          }
          ?>
        </table>
      </div>
    </div>
</body>

</html>