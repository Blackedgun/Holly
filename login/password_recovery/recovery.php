<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../../PHPMailer-master/src/Exception.php';
require '../../PHPMailer-master/src/PHPMailer.php';
require '../../PHPMailer-master/src/SMTP.php';

require_once('../../reg.php');

$email = $_POST['email'];
$query = "SELECT * FROM usuario WHERE email = '$email' AND status = 'Activo'";
$result = $conn->query($query);
$row = $result->fetch_assoc();

if ($result->num_rows > 0) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp-mail.outlook.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'Strengthware@outlook.es';
        $mail->Password   = 'Kmirasapo123456$$$';
        $mail->Port       = 587;

        $mail->setFrom('Strengthware@outlook.es', 'Holly Dashing Enterprise');
        $mail->addAddress($email, $row['nombre']); 
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8'; 
        $mail->Subject = 'Recuperación de contraseña';
        $mail->Body    = 'Hola, este es un correo generado para solicitar tu recuperación de contraseña. Por favor, visita la página de <a href="http://localhost/Holly/login/password_recovery/password_recovery2.php?id=' . $row['usuario_id'] . '">Recuperación de contraseña</a>';

        $mail->send();
        echo '<script>
         alert("Se ha enviado un correo de recuperación a su correo eléctronico");
         window.location = "../Formulario.php";
    </script>';
    } catch (Exception $e) {
        echo '<script>
         alert("Ha ocurrido un error al enviar el correo");
         window.location = "../Formulario.php";
    </script>';
    }
} else {
    echo '<script>
         alert("Correo invalido o no vinculado, inténtelo de nuevo");
         window.location = "../Formulario.php";
    </script>';
}
