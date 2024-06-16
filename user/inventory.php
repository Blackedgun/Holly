<?php
include "../reg.php";

session_start();
if (empty($_SESSION['usuario'])) {
  header('location: ../Interface.php');
  exit();
}

$usuario = $_SESSION['usuario'];


$sql = "SELECT rol_id FROM usuario WHERE usuario_id = '$usuario'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  if ($row['rol_id'] != 1) {
    echo "<script language='JavaScript'>
        alert ('Usted no tiene permitido el acceso a esta vista');
        location.assign ('../Interface.php');
        </script>";
    exit();
  }
} 

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="../img/LogoHolly.png" />
  <title>Main</title>
  <link rel="stylesheet" href="../css/user-int.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Passion+One:wght@400;700;900&family=Raleway:wght@300;400;700&display=swap" rel="stylesheet" />
</head>

<body style="background: url(../img/pinkdot2.jpg)">
  <div style="position: relative;" class="container">
    <nav>
      <div class="navbar">
        <div class="logo">
          <img src="../img/LogoHolly.png" alt="Logo" />
          <h2>Holly</h2>
        </div>
        <ul>
          <li>
            <a href="user.php">
              <i class="fas fa-chart-bar"></i>
              <span class="nav-item">Pedidos</span>
            </a>
          </li>
          <li>
            <a href="">
              <i style="color: beige;" class="fab fa-dochub"></i>
              <span class="nav-item" style="color: beige;">Inventario</span>
            </a>
          </li>
          <li>
            <a href="registros.php">
              <i class="fas fa-user"></i>
              <span  class="nav-item">Registros</span>
            </a>
          </li>
          <li>
            <a href="../docs/Manual de Usuario Holly Dashing.pdf">
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
          <li>
            <div class="color-picker-container">
              <label style="color: var(--text-color, black);" for="colorPicker">Color de interfaz:</label>
              <input type="color" id="colorPicker" name="colorPicker">
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <div>
      <div class="somenew">
        <form class="header__title" method="GET" action="">
          <input type="text" name="busqueda" placeholder="Buscar...">
          <br><br>
          <input type="submit" name="enviar" value="Buscar">
          <br><br>
          <div>
            <a style="color:#fff; height:fit-content; font-size:1.1rem; width:60px; margin-left:400px; background-color:crimson" class='footer__title' href="../convert/pdf/productopdf.php">PDF</a>
          </div><br>
          <div class="print">
            <a style="color: #707070; background-color: lawngreen;" class='print_button' href="../convert/productocsv.php">CSV</a>
          </div>
          <br>
          <div class="print">
            <a style="color: #ffffff; background-color:forestgreen;" class='print_button' href="../convert/productoxml.php">XML</a>
          </div>
          <br><br>
          <div class="nextbutton">
            <a class="Fetch" href="../additem/addprod.php">Agregar</a>
          </div>
        </form>
        <div style="width: 350px;" class="someold">
          <h4>Categorías</h4>
          <ol>
            <li>1. Pantalones
              <a style="margin-left: 20px; color: #ffffff; background-color:forestgreen;" class='print_button' href="../convert/pantalonesxml.php">XML</a>
              <a style="margin-left: 5px; color:#fff; height:fit-content; font-size:1.1rem; width:60px; background-color:crimson" class='footer__title' href="../convert/pdf/pantalonespdf.php">PDF</a>
            </li>
            <li>2. Camisetas
              <a style="margin-left: 20px; color: #ffffff; background-color:forestgreen;" class='print_button' href="../convert/camisetasxml.php">XML</a>
              <a style="margin-left: 5px; color:#fff; height:fit-content; font-size:1.1rem; width:60px; background-color:crimson" class='footer__title' href="../convert/pdf/camisetaspdf.php">PDF</a>
            </li>
            <li>3. Calzado
              <a style="margin-left: 20px; color: #ffffff; background-color:forestgreen;" class='print_button' href="../convert/calzadoxml.php">XML</a>
              <a style="margin-left: 5px; color:#fff; height:fit-content; font-size:1.1rem; width:60px; background-color:crimson" class='footer__title' href="../convert/pdf/calzadopdf.php">PDF</a>
            </li>
            <li>4. Pijamas
              <a style="margin-left: 20px; color: #ffffff; background-color:forestgreen;" class='print_button' href="../convert/pijamasxml.php">XML</a>
              <a style="margin-left: 5px; color:#fff; height:fit-content; font-size:1.1rem; width:60px; background-color:crimson" class='footer__title' href="../convert/pdf/pijamaspdf.php">PDF</a>
            </li>
            <li>5. Chaquetas<a style="margin-left: 20px; color: #ffffff; background-color:forestgreen;" class='print_button' href="../convert/chaquetasxml.php">XML</a>
              <a style="margin-left: 5px; color:#fff; height:fit-content; font-size:1.1rem; width:60px; background-color:crimson" class='footer__title' href="../convert/pdf/chaquetaspdf.php">PDF</a>
            </li>
          </ol>
        </div>
      </div>
      <br><br>
      <div class="table__container_two">
        <table>
          <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Disponibilidad</th>
            <th>Popular</th>
            <th>Imagen</th>
            <th>Opciones</th>
          </tr>
          <?php
          $inv = "SELECT producto.*, categoria.categoria AS categoria FROM producto LEFT JOIN categoria ON producto.cat_id = categoria.cat_id";
          if (isset($_GET['enviar']) && !empty($_GET['busqueda'])) {
            $busqueda = $_GET['busqueda'];
            $inv .= " WHERE producto_id LIKE '%$busqueda%' OR prod_nombre LIKE '%$busqueda%' OR categoria LIKE '%$busqueda%' OR prod_cantidad LIKE '%$busqueda%' OR prod_precio LIKE '%$busqueda%' OR disponibilidad LIKE '%$busqueda%'";
          }
          $resultado = mysqli_query($conn, $inv);
          while ($row = mysqli_fetch_array($resultado)) {
          ?>
            <tr>
              <td><?php echo $row['producto_id']; ?></td>
              <td><?php echo $row['prod_nombre']; ?></td>
              <td><?php echo $row['categoria']; ?></td>
              <td><?php echo $row['prod_cantidad']; ?></td>
              <td><?php echo $row['prod_precio']; ?></td>
              <td><?php echo $row['disponibilidad']; ?></td>
              <td><?php echo $row['popular']; ?></td>
              <td><img height="50px" src="data:image/jpg;base64, <?php echo base64_encode($row['prod_image']); ?>"></td>
              <td><a href="../editform/forminventario.php?id=<?php echo $row['producto_id']; ?>" class="crud_button">Editar</a></td>
            </tr>
          <?php
          }
          ?>
        </table>
      </div>
    </div>
  </div>
  <script src="../js/newcolor.js"></script>
</body>

</html>