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
              <i class="fas fa-chart-bar"></i>
              <span class="nav-item">Pedidos</span>
            </a>
          </li>
          <li>
            <a href="inventory.php">
              <i class="fab fa-dochub"></i>
              <span class="nav-item">Inventario</span>
            </a>
          </li>
          <li>
            <a href="">
              <i style="color: beige;" class="fas fa-user"></i>
              <span style="color: beige;" class="nav-item">Registros</span>
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
            <a style="color:#fff; height:fit-content; font-size:1.1rem; width:60px; margin-left:400px; background-color:crimson" class='footer__title' href="../convert/pdf/registerpdf.php">PDF</a>
          </div><br>
          <div class="print">
            <a style="color: #707070; background-color: lawngreen;" class='print_button' href="../convert/registercsv.php">CSV</a>
          </div><br>
          <div class="print">
            <a style="color: #ffffff; background-color:forestgreen;" class='print_button' href="../convert/registerxml.php">XML</a><br><br>
            <div class="nextbutton">
              <a class="Fetch" href="postulados.php">Postulaciones</a>
            </div>
            <div class="nextbutton">
              <a class="Fetch" href="../registro/registro.php">Nuevo Registro</a>
            </div>
          </div>
        </form>
        <div class="someold">
          <h4>Roles</h4>
          <ol>
            <li>1. Administrador</li>
            <li>2. Empleado</li>
            <li>3. Pendiente</li>
          </ol>
        </div>
      </div><br><br>

      <div class="table__container_two">
        <table>
          <tr>
            <th>ID</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Tipo de documento</th>
            <th># de documento</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Interfaz</th>
            <th>Opciones</th>
          </tr>
          <?php
          // Consultar usuarios
          $query = "SELECT usuario.*, rol.interfaz AS interfaz FROM usuario LEFT JOIN rol ON usuario.rol_id = rol.rol_id WHERE usuario.usuario_id > 5";

          if (isset($_GET['enviar']) && !empty($_GET['busqueda'])) {
            $busqueda = $_GET['busqueda'];
            $query .= " AND (usuario.usuario_id LIKE '%$busqueda%' 
                        OR usuario.nombre LIKE '%$busqueda%' 
                        OR usuario.apellido LIKE '%$busqueda%' 
                        OR usuario.tipo_documento LIKE '%$busqueda%'
                        OR usuario.no_documento LIKE '%$busqueda%' 
                        OR usuario.email LIKE '%$busqueda%' 
                        OR usuario.telefono LIKE '%$busqueda%'  
                        OR rol.interfaz LIKE '%$busqueda%')";
          }

          $resultado = mysqli_query($conn, $query);
          if($resultado){
            while ($row = mysqli_fetch_array($resultado)) {
          ?>
            <tr>
              <td><?php echo htmlspecialchars($row['usuario_id']); ?></td>
              <td><?php echo htmlspecialchars($row['nombre']); ?></td>
              <td><?php echo htmlspecialchars($row['apellido']); ?></td>
              <td><?php echo htmlspecialchars($row['tipo_documento']); ?></td>
              <td><?php echo htmlspecialchars($row['no_documento']); ?></td>
              <td><?php echo htmlspecialchars($row['email']); ?></td>
              <td><?php echo htmlspecialchars($row['telefono']); ?></td>
              <td><?php echo htmlspecialchars($row['interfaz']); ?></td>
              <td><a href="../editform/formregister.php?id=<?php echo $row['usuario_id']; ?>" class="crud_button">Editar</a></td>
            </tr>
          <?php
            }
          }
          ?>
        </table>
      </div>
    </div>
    <script src="../js/newcolor.js"></script>
</body>

</html>
