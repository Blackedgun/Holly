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
    <link rel="stylesheet" href="../css/confirm.css" />
    <link rel="stylesheet" href="../css/storemanualslider.css" />
    <link rel="stylesheet" href="../css/normalize.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&display=swap" rel="stylesheet" />
    <script>
        function validateForm() {
            var checkout = document.getElementById("checkout").value;
            if (checkout == "") {
                alert("Por favor cargue el comprobante para continuar");
                return false;
            }
            return true;
        }
    </script>
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
                <p>CHECKOUT</p>
            </div>
            <div class="first_container">
                <form action="process_checkout.php" method="POST" onsubmit="return validateForm()">
                    <h4>DETALLES DE FACTURACIÓN</h4>
                    <br />
                    <label for="nombre">Nombres *</label>
                    <input type="text" name="nombre" id="nombre" required />
                    <label for="apellido">Apellidos *</label>
                    <input type="text" name="apellido" id="apellido" required />
                    <label for="correo">Correo elétronico *</label>
                    <input type="text" name="correo" id="correo" required />
                    <label for="direccion">Dirección de residencia *</label>
                    <input type="text" name="direccion" id="direccion" required />
                    <br />
                    <label for="localidad">Localidad *</label>
                    <br />
                    <select style="padding: 8px; font-size: 15px" name="localidad" id="localidad" required>
                        <option value="Antonio Nariño">Antonio Nariño</option>
                        <option value="Barrios Unidos">Barrios Unidos</option>
                        <option value="Bosa">Bosa</option>
                        <option value="Chapinero">Chapinero</option>
                        <option value="Ciudad Bolívar">Ciudad Bolívar</option>
                        <option value="Engativá">Engativá</option>
                        <option value="Fontibón">Fontibón</option>
                        <option value="Kennedy">Kennedy</option>
                        <option value="La Candelaria">La Candelaria</option>
                        <option value="Los Mártires">Los Mártires</option>
                        <option value="Puente Aranda">Puente Aranda</option>
                        <option value="Rafael Uribe Uribe">Rafael Uribe Uribe</option>
                        <option value="San Cristóbal">San Cristóbal</option>
                        <option value="Santa Fe">Santa Fe</option>
                        <option value="Suba">Suba</option>
                        <option value="Teusaquillo">Teusaquillo</option>
                        <option value="Tunjuelito">Tunjuelito</option>
                        <option value="Usaquén">Usaquén</option>
                        <option value="Usme">Usme</option>
                    </select>
                    <br />
                    <label for="barrio">Barrio *</label>
                    <input type="text" name="barrio" id="barrio" required />
                    <label for="telefono">Teléfono *</label>
                    <input type="text" name="telefono" id="telefono" required />
                    <br />
                    <label for="order_notes">Notas sobre el pedido (opcional)</label>
                    <textarea name="order_notes" class="input-text" id="order_notes" placeholder="Notas sobre tu pedido, por ejemplo detalles para realizar la entrega." rows="2" cols="5"></textarea>
                    <br />
                    <label style="color: black" for="checkout">Comprobante de pago (Solo si vas a pagar por Nequi o Daviplata)</label>
                    <input type="file" id="checkout" name="checkout" /><br />
                </form>
            </div>
            <div class="picture-det">
                <h4>Detalles del pedido</h4>
                <br /><br />
                <table>
                    <?php
                    $subtotal = $total; 
                    $envio = 10000; 

                    
                    ?>
                    <tr>
                        <td style="padding-bottom: 30px" rowspan="1">Subtotal</td>
                        <td style="padding-left: 50px; padding-bottom: 30px">$<?php echo number_format($subtotal, 2); ?></td>
                    </tr>
                    <tr>
                        <td rowspan="1">Envío</td>
                        <td>
                            <ul style="padding-left: 50px; margin-top: 15px; margin-bottom: 15px;">
                                <li><label for="new-check1">Valor adicional: $10.000</label></li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 70px">Total</td>
                        <td style="padding-left: 50px; padding-top: 70px">$<?php echo number_format($total + $envio, 2); ?></td>
                    </tr>
                </table>
                <br /><br />
                <!-- Incluir la selección de método de pago -->
                <div class="container">
                    <label>
                        <input name="payment" type="radio" name="initial" id="initialRadio" onchange="showSecondaryRadios()">
                        Pagar con Nequi o Daviplata
                    </label>

                    <div id="secondaryRadios" class="collapsible">
                        <label>
                            <input type="radio" name="secondary" id="secondaryRadio1" onchange="showImages('imageSet1')">
                            Pagar con Nequi
                        </label>
                        <label>
                            <input type="radio" name="secondary" id="secondaryRadio2" onchange="showImages('imageSet2')">
                            Pagar con Daviplata
                        </label>
                        <h1 style="font-size: 15px;">(No seleccione ninguna opción a menos de estar seguro que desea pagar con Nequi o Daviplata)</h1>
                    </div>

                    <div id="imageSet1" class="imageSet collapsible">
                        <img style="height: 400px" src="../img/Nequi.jpg" alt="Image 1" />
                    </div>

                    <div id="imageSet2" class="imageSet collapsible">
                        <img src="image2.jpg" alt="Image 2" />
                    </div>
                </div>

                <div class="container">
                    <label>
                        <input type="radio" name="payment" id="mercadoPagoRadio" onchange="showPaymentInfo('mercadoPagoInfo')">
                        Pagar con Mercado Pago
                    </label>

                    <div id="mercadoPagoInfo" class="collapsible">
                        <p>Beneficios de comprar con Mercado Pago:</p>
                        <ul>
                            <li>Transacciones seguras</li>
                            <li>Pago en cuotas</li>
                            <li>Protección al comprador</li>
                        </ul>
                        <label><input type="checkbox" name="terms" required>Acepto los términos y condiciones de Mercado Pago</label>
                    </div>
                </div>

                <div class="container">
                    <label>
                        <input type="radio" name="payment" id="paypalRadio" onchange="showPaymentInfo('paypalInfo')">
                        Pagar con Paypal
                    </label>

                    <div id="paypalInfo" class="collapsible">
                        <p>Beneficios de comprar con Paypal:</p>
                        <ul>
                            <li>Transacciones rápidas</li>
                            <li>Protección al comprador</li>
                            <li>Soporte global</li>
                        </ul>
                    </div>
                </div>
                <div class="check-button">
                    <input type="submit" value="Finalizar Compra" />
                </div>
            </div>
        </div>
    </div>

    <div class="secondline-bottom">
        <p>Te invitamos a que cuides, respetes y mejores tu piel con la mejor delicadeza.</p>
    </div>
    <script src="../js/new-inputs.js"></script>
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