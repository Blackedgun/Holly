<?php
include "../reg.php";

session_start();
if (empty($_SESSION['usuario'])) {
  header('location: ../Interface.php');
  exit();
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
  <div class="container">
    <nav>
      <div class="navbar">
        <div class="logo">
          <img src="../img/LogoHolly.png" alt="Logo" />
          <h2>Holly</h2>
        </div>
        <ul>
          <li>
            <a href="user.php">
              <i style="color: beige;" class="fas fa-chart-bar"></i>
              <span class="nav-item" style="color: beige;">Pedidos</span>
            </a>
          </li>
          <li>
            <a href="inventory.php">
              <i class="fab fa-dochub"></i>
              <span class="nav-item">Inventario</span>
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
        <form class="header__title" action="" method="GET">
          <input type="text" name="busqueda" placeholder="Buscar...">
          <br><br>
          <input type="submit" name="enviar" value="Buscar">
          <div class="print">
            <a style="color: #707070; background-color: lawngreen;" class='print_button' href="../convert/pedidocsv.php">CSV</a>
          </div><br>
          <div class="print">
            <a style="color: #ffffff; background-color:forestgreen;" class='print_button' href="../convert/pedidoxml.php">XML</a><br><br>
            <div class="nextbutton">
              <a class="Fetch" href="'checkbillsdeletequotationmarks'">Facturas</a>
            </div>
          </div>
        </form>
        <div style="background: none; border: 0px;" class="someold"></div>
      </div><br><br>

      <div class="table__container_two">
        <table>
          <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Total</th>
            <th>Estado</th>
            <th>Cliente</th>
            <th>Opciones</th>
          </tr>
          <?php
          // Consultar pedidos
          $query = "SELECT pedidos.pedido_id, pedidos.fecha_ped, pedidos.total_amount, pedidos.estado, cliente.nombre_cli 
                    FROM pedidos 
                    LEFT JOIN cliente ON pedidos.cliente_id = cliente.cliente_id";

          if (isset($_GET['enviar']) && !empty($_GET['busqueda'])) {
            $busqueda = $_GET['busqueda'];
            $query .= " WHERE pedidos.pedido_id LIKE '%$busqueda%' 
                        OR pedidos.fecha_ped LIKE '%$busqueda%' 
                        OR pedidos.total_amount LIKE '%$busqueda%' 
                        OR pedidos.estado LIKE '%$busqueda%' 
                        OR cliente.nombre_cli LIKE '%$busqueda%'";
          }
          $resultado = mysqli_query($conn, $query);
          while ($row = mysqli_fetch_array($resultado)) {
          ?>
            <tr>
              <td><?php echo $row['pedido_id']; ?></td>
              <td><?php echo $row['fecha_ped']; ?></td>
              <td><?php echo $row['total_amount']; ?></td>
              <td><?php echo $row['estado']; ?></td>
              <td><?php echo $row['nombre_cli']; ?></td>
              <td><a href="'direccionURLborrarcomillas'?id=<?php echo $row['pedido_id']; ?>" class="crud_button">Consultar</a></td>
            </tr>
          <?php
          }
          ?>
        </table>
      </div>
    </div>
    <script src="../js/newcolor.js"></script>
</body>

</html>