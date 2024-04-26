<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Varela+Round&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/ini.css">
    <title>Inicio Sesión</title>
</head>
<body>
    <div class="formulario">
        <h1>Bienvenido</h1>
        <form method="post"  action="controller/inicio.php" id="formulario">
            <div class="campos">
                <input type="text" name="username" id="username" >
                <label>Username</label>
            </div>
            <div class="campos">
                <input type="password" name="contrasena" id="contrasena">
                <label>Contraseña</label>
            </div>
            <div class="recordar"><a href="#">Olvido su contraseña?</a></div>
            <input type="submit" name="inicio" value="Iniciar Sesión">
            <br><br>
        </form>
    </div>
</body>
</html>