<?php
require_once("conexion/conexion.php");
$db = new Database();
$con = $db->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se ha enviado un correo electrónico
    if (!isset($_POST['email'])) {
        echo "Email is required";
        exit;
    }

    // Recuperar el correo electrónico del formulario
    $email = $_POST['email'];

    // Verificar si el correo electrónico existe en la base de datos
    $stmt = $con->prepare("SELECT * FROM usuarios WHERE correo = :email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "El correo electrónico no se encuentra registrado.";
        exit;
    }

    // Generar un token de recuperación de contraseña (por simplicidad, usaremos la dirección de correo electrónico)
    $token = $email;

    // Construir el mensaje de correo electrónico
    $to = $email;
    $subject = "Recuperación de contraseña";
    $message = "Hola,\n\nHemos recibido una solicitud para restablecer tu contraseña. Por favor, sigue este enlace para restablecer tu contraseña:\n\nhttp://tu-sitio.com/reset_password.php?token=$token\n\nSi no solicitaste este restablecimiento de contraseña, puedes ignorar este correo electrónico.\n\nSaludos,\nTu equipo de soporte";

    // Configurar encabezados adicionales
    $headers = "From: TuNombre <tuemail@tudominio.com>\r\n";
    $headers .= "Reply-To: tuemail@tudominio.com\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Enviar el correo electrónico
    if (mail($to, $subject, $message, $headers)) {
        echo "Se ha enviado un correo electrónico de recuperación de contraseña a $email con el token: $token";
    } else {
        echo "Error al enviar el correo electrónico de recuperación de contraseña.";
    }
}
?>

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
    <title>Recuperar Contraseña</title>
</head>

<body>
    <div class="formulario">
        <h1>Recuperar Contraseña</h1>
        <form method="post" action="recupera.php" id="formulario">
            <div class="campos">
                <input type="email" name="email" id="email" required autocomplete="off">
                <label>Correo</label>
            </div>
            <input type="submit" name="inicio" value="Continuar">
            <input type="hidden" name="MM_insert" value="formreg">
            <br><br>
        </form>
    </div>
</body>

</html>
