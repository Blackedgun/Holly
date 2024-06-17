<?php
require_once('../reg.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../img/LogoHolly.png" />
    <title>Holly Store</title>
    <link rel="stylesheet" href="../css/Tiendacss/carrito.css" />
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
                <li><a href="../Tienda/Tienda.php">Tienda</a></li>
                <li><a href="../contact.php">Contactanos</a></li>
            </ul>
        </nav>
        <div class="login-button">
            <a href="../login/Formulario.php"><button>Iniciar Sesión</button></a>
        </div>
    </header>

    <div class="main-container">
        <div class="container-pop-items">
            <div class="secondline">
                <p>TU CARRITO</p>
            </div>
            <div class="first_container">
                <form action="update_cart.php" method="post">
                    <table>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>PRODUCTO</th>
                            <th>PRECIO</th>
                            <th>CANTIDAD</th>
                            <th>SUBTOTAL</th>
                        </tr>
                        <?php
                        $total = 0;
                        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                            foreach ($_SESSION['cart'] as $index => $item) {
                                $subtotal = $item['prod_precio'] * $item['cantidad'];
                                $total += $subtotal;
                        ?>
                                <tr>
                                    <td>
                                        <form action="remove_from_cart.php" method="GET">
                                            <input type="hidden" name="delete_index" value="<?php echo $index; ?>">
                                            <button style="border: none;" type="submit"><img style="height: 25px; width: 25px;" src="../img/Eliminar.jpg" alt="Eliminar"></button>
                                        </form>
                                    </td>
                                    <td><img class="product-img" height="50px" src="data:image/jpg;base64, <?php echo base64_encode($item['prod_image']); ?>"></td>
                                    <td><?php echo $item['prod_nombre']; ?></td>
                                    <td>$<?php echo number_format($item['prod_precio'], 2); ?></td>
                                    <td>
                                        <div class="quantity-container">
                                            <button type="button" class="quantity-button" onclick="decrementQuantity(<?php echo $index; ?>)">-</button>
                                            <input style="width: 35px;" type="text" name="quantities[<?php echo $index; ?>]" value="<?php echo $item['cantidad']; ?>" readonly>
                                            <button type="button" class="quantity-button" onclick="incrementQuantity(<?php echo $index; ?>)">+</button>
                                        </div>
                                    </td>
                                    <td>$<?php echo number_format($subtotal, 2); ?></td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo '<tr><td colspan="6"><p>El carrito está vacío.</p></td></tr>';
                        }
                        ?>
                        <tr>
                            <td colspan="6" style="border-bottom: none;">
                                <div class="update_button"><button type="submit" class="button" name="update_cart" value="Update cart">Actualizar carro</button></div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div style="width: 300px;" class="picture-det">
                <h4>Total del carrito</h4>
                <br><br>
                <table>
                    <tr>
                        <td style="padding-bottom: 30px;" rowspan="1">Subtotal</td>
                        <td style="padding-left: 50px; padding-bottom: 30px;">$<?php echo number_format($total, 2); ?></td>
                    </tr>
                    <tr>
                        <td rowspan="1">Envío</td>
                        <td>
                            <ul style="padding-left: 50px; margin-top: 15px; margin-bottom: 15px;">
                                <li>
                                    <input type="radio" name="shipping" value="additional_cost" id="new-check1" checked onchange="updateTotal()">
                                    <label for="new-check1">Valor adicional: $10.000</label>
                                </li>
                                <br>
                                <li>
                                    <input type="radio" name="shipping" value="store_pickup" id="new-check2" onchange="updateTotal()">
                                    <label for="new-check2">Retiro en tienda (San Andresito de la 38)</label>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 70px;">Total</td>
                        <td style="padding-left: 50px; padding-top: 70px;" id="total">$<?php echo number_format($total + 10000, 2); ?></td>
                    </tr>
                </table>
                <div class="check-button">
                    <a href="confirm.php">Continuar Compra</a>
                </div>
            </div>
        </div>
    </div>

    <div class="secondline-bottom">
        <p>
            Te invitamos a que cuides, respetes y mejores tu piel con la mejor
            delicadeza.
        </p>
    </div>
    <script src="../js/quantity.js"></script>
    <script>
        function incrementQuantity(index) {
            const quantityInput = document.querySelector(`input[name="quantities[${index}]"]`);
            quantityInput.value = parseInt(quantityInput.value) + 1;
        }

        function decrementQuantity(index) {
            const quantityInput = document.querySelector(`input[name="quantities[${index}]"]`);
            if (quantityInput.value > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
            }
        }

        function updateTotal() {
            const shippingCost = document.querySelector('input[name="shipping"]:checked').value === "additional_cost" ? 10000 : 0;
            const totalElement = document.getElementById("total");
            const total = <?php echo $total; ?> + shippingCost;
            totalElement.textContent = "$" + total.toLocaleString('es-ES', {
                minimumFractionDigits: 2
            });
        }
    </script>
</body>

<footer class="footer">
    <div class="Brand">
        <img src="../img/LogoHolly.png" alt="Holly Dashing" />
    </div>
    <div class="footercont">
        <nav>
            <ul>
                <li><a href="../Interface.php">Inicio</a></li>
                <li><a href="../Tienda/Tienda.php">Tienda</a></li>
                <li><a href="../contact.php">Contactanos</a></li>
            </ul>
        </nav>
        <p>©2024 Holly Dashing | Todos los derechos reservados</p>
    </div>
    <ul class="social-icon">
        <li>
            <a href="https://x.com/eldiariodedross"><img src="../img/x.png" alt="" /></a>
        </li>
        <li>
            <a href="https://www.facebook.com/Seniorwhis"><img src="../img/facebook.png" alt="" /></a>
        </li>
        <li>
            <a href="https://www.instagram.com/senior_whiiss/"><img src="../img/instagram.png" alt="" /></a>
        </li>
        <li>
            <a href="https://wa.me/3025193306"><img src="../img/whatsapp.png" alt="" /></a>
        </li>
    </ul>
</footer>

</html>