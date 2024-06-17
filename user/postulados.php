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
  <link rel="stylesheet" href="../css/user-int-two.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Passion+One:wght@400;700;900&family=Raleway:wght@300;400;700&display=swap" rel="stylesheet" />
</head>

<body style="background: url(../img/pinkdot2.jpg)">
  <div class="main-container">
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
            <a href="registros.php">
              <i class="fas fa-user"></i>
              <span class="nav-item">Registros</span>
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
    <div class="content-container">
      <div class="somenew">
        <form class="header__title" action="" method="GET">
          <input type="text" name="busqueda" placeholder="Buscar...">
          <br><br>
          <input type="submit" name="enviar" value="Buscar">
          <div class="print">
            <a style="color:#fff; background-color:crimson" class='footer__title' href="../convert/pdf/postuladopdf.php">PDF</a>
          </div><br>
          <div class="print">
            <a style="color: #707070; background-color: lawngreen;" class='print_button' href="../convert/postuladocsv.php">CSV</a>
          </div><br>
          <div class="print">
            <a style="color: #ffffff; background-color:forestgreen;" class='print_button' href="../convert/postuladoxml.php">XML</a><br><br>
          </div>
        </form>
        <div style="background: none; border: 0px;" class="someold"></div>
      </div><br><br>

      <div class="table__container_two">
        <table>
          <tr>
            <th>ID</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Genero</th>
            <th>Edad</th>
            <th>Tipo de documento</th>
            <th># de documento</th>
            <th>Correo</th>
            <th>Dirección</th>
            <th>Barrio</th>
            <th>Teléfono</th>
            <th>Curriculum</th>
            <th>Opciones</th>
          </tr>
          <?php
          // Consultar usuarios
          $query = "SELECT * FROM postulantes";

          if (isset($_GET['enviar']) && !empty($_GET['busqueda'])) {
            $busqueda = $_GET['busqueda'];
            $query .= " WHERE postulantes.post_id LIKE '%$busqueda%' 
                        OR postulantes.Nombres LIKE '%$busqueda%' 
                        OR postulantes.Apellidos LIKE '%$busqueda%' 
                        OR postulantes.Genero LIKE '%$busqueda%'
                        OR postulantes.Edad LIKE '%$busqueda%' 
                        OR postulantes.tipo_documento LIKE '%$busqueda%' 
                        OR postulantes.no_documento LIKE '%$busqueda%'  
                        OR postulantes.Correo LIKE '%$busqueda%'
                        OR postulantes.Direccion LIKE '%$busqueda%' 
                        OR postulantes.Barrio LIKE '%$busqueda%' 
                        OR postulantes.Telefono LIKE '%$busqueda%' 
                        OR postulantes.Curriculum LIKE '%$busqueda%'";
          }
          $resultado = mysqli_query($conn, $query);
          while ($row = mysqli_fetch_array($resultado)) {
          ?>
            <tr>
              <td><?php echo htmlspecialchars($row['post_id']); ?></td>
              <td><?php echo htmlspecialchars($row['Nombres']); ?></td>
              <td><?php echo htmlspecialchars($row['Apellidos']); ?></td>
              <td><?php echo htmlspecialchars($row['Genero']); ?></td>
              <td><?php echo htmlspecialchars($row['Edad']); ?></td>
              <td><?php echo htmlspecialchars($row['tipo_documento']); ?></td>
              <td><?php echo htmlspecialchars($row['no_documento']); ?></td>
              <td><?php echo htmlspecialchars($row['Correo']); ?></td>
              <td><?php echo htmlspecialchars($row['Direccion']); ?></td>
              <td><?php echo htmlspecialchars($row['Barrio']); ?></td>
              <td><?php echo htmlspecialchars($row['Telefono']); ?></td>
              <td>
                <?php if (!empty($row['Curriculum'])): ?>
                  <a href="../curriculums/<?php echo htmlspecialchars($row['Curriculum']); ?>" target="_blank">Ver Curriculum</a>
                <?php else: ?>
                  No disponible
                <?php endif; ?>
              </td>
              <td><form action="../deleteform/deletecandidate.php" method="POST">
                <input type="hidden" name="delete" value="<?php echo $row['post_id']; ?>">
                <button type="submit" class="crud_button" onclick="return confirm('¿Estás seguro de que quieres eliminar este registro?')">Eliminar</button>
              </form>
            </td>
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
