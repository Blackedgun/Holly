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
                        <a href="#">
                            <i class=""></i>
                            <span class="nav-item" style="color: beige;">Configuración</span>
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
                <form class="header__title" method="GET" action="">

                    <div class="color-picker-container">
                        <label for="colorPicker">Choose a theme color:</label>
                        <input type="color" id="colorPicker" name="colorPicker">
                    </div>

                </form>
            </div>

        </div>
    </div>
    <script src="../js/newcolor.js"></script>
</body>

</html>