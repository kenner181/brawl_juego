<?php
session_start();
// Verificar si la sesión no está iniciada
if (!isset($_SESSION["username"])) {
    // Mostrar un alert y redirigir utilizando JavaScript 
    echo '<script>alert("Debes iniciar sesión antes de acceder.");</script>';
    echo '<script>window.location.href = "../../iniciar_sesion.php";</script>';
    exit();
}

// Incluir el archivo de conexión
require_once("../../conexion/conexion.php");

// Crear una instancia de la clase Database
$db = new Database();

// Obtener la conexión
$con = $db->getConnection();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/1057b0ffdd.js" crossorigin="anonymous"></script>
</head>
<body>
<?php include("nav.php") ?>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>