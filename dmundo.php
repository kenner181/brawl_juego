<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "brawl_stars";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener todos los mundos
$sql_mundos = "SELECT * FROM mundos";

$result_mundos = $conn->query($sql_mundos);

if ($result_mundos->num_rows > 0) {
    $mundos = $result_mundos->fetch_all(MYSQLI_ASSOC);
} else {
    $mundos = [];
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Mundos</title>
</head>
<body>
    <h1>Lista de Mundos</h1>
    
    <?php if (!empty($mundos)) : ?>
        <ul>
            <?php foreach ($mundos as $mundo) : ?>
                <li>
                    <a href="detalles_mundo.php?id_mundo=<?php echo $mundo['id_mundo']; ?>">
                        Mundo <?php echo $mundo['id_mundo']; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>No hay mundos disponibles.</p>
    <?php endif; ?>
</body>
</html>

