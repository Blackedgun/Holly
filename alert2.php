<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>error 404</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: sans-serif;
        }

        body {
            background: #1a84d3;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container-404{
            text-align: center;
            width: 100%;
            max-width: 400px;
            background: white;
            padding-top: 40px;
            margin-top: 200px;
            padding-bottom: 40px;
            padding-left: 60px;
            padding-right: 60px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 10);
            border-radius: 5px;
            line-height: 1.7;
        }

        .button {
            border-radius: 10px;
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            background: #1a84d3;
            color: #fff;
            padding: 10px 15px;
        }
    </style>
</head>
<body>
    <div class="container-404">
        <h1>¡OOPS!</h1>
        <p>Disculpe, pero usted tiene restringido el acceso a esta vista</p>
        <a href="carrito/carrito.php" class="button">¡Entendido!</a>
    </div>
</body>