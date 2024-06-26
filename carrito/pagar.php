<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

require_once('../reg.php');
session_start();


if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$correo = $_POST['correo'];
$direccion = $_POST['direccion'];
$localidad = $_POST['localidad'];
$barrio = $_POST['barrio'];
$telefono = $_POST['telefono'];
$notas = $_POST['order_notes'];

// Procesar comprobante
if (isset($_FILES['comprobante']) && $_FILES['comprobante']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = '../comprobantes/';
    $uploadFile = $uploadDir . basename($_FILES['comprobante']['name']);


    if ($_POST) {
        $total = 0;
        $SID = session_id();

        if (move_uploaded_file($_FILES['comprobante']['tmp_name'], $uploadFile)) {

            $sentencia = "INSERT INTO cliente (nombre_cli, apellido_cli, correo_cli, direccion_cli, localidad, barrio, telefono, notas, comprobante) VALUES ('$nombre', '$apellido', '$correo', '$direccion', '$localidad', '$barrio', '$telefono', '$notas', '$uploadFile');";
            $result = $conn->query($sentencia);
            $clientSecret = $conn->insert_id;

            if ($result) {
                // Total de la compra
                foreach ($_SESSION['cart'] as $index => $item) {
                    $total += $item['prod_precio'] * $item['cantidad'];
                }

                if (!isset($pdo)) {
                    $pdo = new PDO('mysql:host=localhost;dbname=holly', 'root', '');
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }


                $sentencia = $pdo->prepare("INSERT INTO pedidos (claveTransaccion, fecha_ped, total_amount, estado, cliente_id, usuario_id) VALUES (:claveTransaccion, current_timestamp(), :Total, 'Pendiente', :cliente, '6');");
                $sentencia->bindParam(":claveTransaccion", $SID);
                $sentencia->bindParam(":Total", $total);
                $sentencia->bindParam(":cliente", $clientSecret);

                if ($sentencia->execute()) {
                    $pedidoId = $pdo->lastInsertId();


                    $detalleSentencia = $pdo->prepare("INSERT INTO detalle (producto_id, pedido_id, precio_unit, cantidad, metodo_pago, modo_envio) VALUES (:producto_id, :pedido_id, :precio_unit, :cantidad, 'Código QR', 'Envío');");
                    $updateProductQuantitySentencia = $pdo->prepare("UPDATE producto SET prod_cantidad = prod_cantidad - :cantidad WHERE producto_id = :producto_id");

                    foreach ($_SESSION['cart'] as $index => $item) {
                        $detalleSentencia->bindParam(":producto_id", $item['producto_id']);
                        $detalleSentencia->bindParam(":pedido_id", $pedidoId);
                        $detalleSentencia->bindParam(":precio_unit", $item['prod_precio']);
                        $detalleSentencia->bindParam(":cantidad", $item['cantidad']);
                        $detalleSentencia->execute();

                        $updateProductQuantitySentencia->bindParam(":producto_id", $item['producto_id']);
                        $updateProductQuantitySentencia->bindParam(":cantidad", $item['cantidad']);
                        $updateProductQuantitySentencia->execute();
                    }

                    // Join para traer datos de F. keys de pedidos
                    $pedidoSql = "SELECT p.pedido_id, p.total_amount, c.nombre_cli, c.correo_cli, p.fecha_ped
                                  FROM pedidos p
                                  JOIN cliente c ON p.cliente_id = c.cliente_id
                                  WHERE p.pedido_id = ?";
                    $pedidoStmt = $pdo->prepare($pedidoSql);
                    $pedidoStmt->bindParam(1, $pedidoId, PDO::PARAM_INT);
                    $pedidoStmt->execute();
                    $pedido = $pedidoStmt->fetch(PDO::FETCH_ASSOC);

                    // Crear PDF para la factura
                    require('../convert/pdf/fpdf.php');
                    $pdf = new FPDF();
                    $pdf->AddPage();

                    // Header
                    $pdf->Image('../img/LogoHolly.png', 10, 10, 30);
                    $pdf->SetFont('Arial', 'B', 16);
                    $pdf->Cell(0, 10, 'Factura Holly Dashing', 0, 1, 'C');
                    $pdf->Cell(0, 12, '', 0, 1, 'C');
                    $pdf->SetFont('Arial', 'B', 16);
                    $pdf->Cell(0, 10, 'Gracias por comprar en', 0, 1, 'C');
                    $pdf->Cell(0, 10, 'Holly Dashing esperamos vuelva pronto!', 0, 1, 'C');
                    $pdf->Cell(0, 8, '', 0, 1, 'C');
                    $pdf->SetFont('Arial', '', 12);

                    // Body
                    $pdf->Ln(10);
                    $pdf->Cell(0, 10, 'Pedido ID: ' . $pedido['pedido_id'], 0, 1,  'C');
                    $pdf->Cell(0, 10, 'Cliente: ' . $pedido['nombre_cli'], 0, 1,  'C');
                    $pdf->Cell(0, 10, 'Fecha: ' . $pedido['fecha_ped'], 0, 1,  'C');

                    $pdf->Ln(10);
                    $pdf->SetFont('Arial', 'B', 12);
                    $pdf->Cell(0, 10, 'Detalles de la Venta', 0, 1,  'C');
                    $pdf->SetFont('Arial', '', 12);

                    foreach ($_SESSION['cart'] as $item) {
                        $pdf->Cell(0, 10, 'Producto: ' . $item['prod_nombre'], 0, 1,  'C');
                        $pdf->Cell(0, 10, 'Precio Unitario: ' . $item['prod_precio'], 0, 1,  'C');
                        $pdf->Cell(0, 10, 'Cantidad: ' . $item['cantidad'], 0, 1,  'C');
                        $pdf->Ln(5);
                    }

                    // Total
                    $pdf->Cell(0, 10, 'Total: $' . $pedido['total_amount'], 0, 1,  'C');

                    // Footer
                    $pdf->Cell(0, 10, '', 0, 1, 'C');
                    $pdf->SetFont('Arial', 'B', 16);
                    $pdf->Cell(0, 10, utf8_decode('(Esta factura se anulará automáticamente ante cualquier queja'), 0, 1, 'C');
                    $pdf->Cell(0, 10, utf8_decode('o reclamo en caso de que el comprobante de pago no coincida con el'), 0, 1, 'C');
                    $pdf->Cell(0, 10, utf8_decode('total a pagar, la información del comprador no sea la correcta)'), 0, 1, 'C');
                    $pdf->Cell(0, 10, utf8_decode('o el archivo cargado sea incorrecto)'), 0, 1, 'C');

                    // Guardar el PDF en el servidor
                    $pdfFileName = '../facturas/factura_' . $pedidoId . '.pdf';
                    $pdf->Output($pdfFileName, 'F');

                    // PHP Mailer Section
                    try {
                        $mail = new PHPMailer(true);
                        $mail->isSMTP();
                        $mail->Host       = 'smtp-mail.outlook.com';
                        $mail->SMTPAuth   = true;
                        $mail->Username   = 'Strengthware@outlook.es';
                        $mail->Password   = 'Kmirasapo123456$$$';
                        $mail->Port       = 587;
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Habilita TLS encryption
                        $mail->Timeout = 15;
                        $mail->SMTPDebug = 0; // Desactiva la depuración para producción
                        $mail->SMTPKeepAlive = true; // Mantén la conexión SMTP abierta
                        $mail->setFrom('Strengthware@outlook.es', 'Holly Dashing Enterprise');
                        $mail->addAddress($pedido['correo_cli'], $pedido['nombre_cli']);
                        $mail->isHTML(true);
                        $mail->CharSet = 'UTF-8';
                        $mail->Subject = 'Factura de su compra en Holly Dashing';
                        $mail->Body    = 'Hola ' . $pedido['nombre_cli'] . ',<br><br>'
                            . 'Gracias por su compra en Holly Dashing. Adjuntamos la factura correspondiente a su pedido.<br><br>'
                            . 'Atentamente,<br>'
                            . 'Holly Dashing Enterprise<br><br>'
                            . '<a href="http://localhost/Holly/facturas/factura_' . $pedidoId . '.pdf">Descargar Factura</a>';
                        $mail->addAttachment($pdfFileName); // Adjuntar la factura mediante el output

                        $mail->send();

                        unset($_SESSION['cart']);
                        echo '<script>
                                alert("Compra Exitosa (Se ha enviado la factura a tu correo electrónico).");
                                window.location = "../interface.php";
                              </script>';
                    } catch (Exception $e) {

                        echo '<script>
                                alert("Ha ocurrido un error en el envío de la factura a su correo mas sin embargo la compra fue exitosa, comuniquese a 3025193306 o a Strengthware@outlook.es para recibir su factura por correo o mensaje");
                                window.location = "../interface.php";
                              </script>';
                    }
                } else {

                    echo '<script>
                            alert("Algo salió mal al agregar detalles del pedido.");
                            window.location = "confirm.php";
                          </script>';
                }
            } else {

                echo '<script>
                        alert("Algo salió mal con el registro del cliente.");
                        window.location = "confirm.php";
                      </script>';
            }
        } else {

            echo '<script>
                    alert("Error al subir el archivo de comprobante.");
                    window.location = "confirm.php";
                  </script>';
        }
    }
} else {

    echo '<script>
            alert("Por favor seleccione un documento para continuar.");
            window.location = "confirm.php";
          </script>';
}
exit();
