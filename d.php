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

// Obtener todas las partidas
$sql_partidas = "SELECT * FROM partida";

$result_partidas = $conn->query($sql_partidas);

if ($result_partidas->num_rows > 0) {
    $partidas = $result_partidas->fetch_all(MYSQLI_ASSOC);
} else {
    $partidas = [];
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Partidas</title>
</head>
<body>
    <h1>Lista de Partidas</h1>
    
    <?php if (!empty($partidas)) : ?>
        <ul>
            <?php foreach ($partidas as $partida) : ?>
                <li>
                    <a href="detalles_partida.php?id_partida=<?php echo $partida['id_partida']; ?>">
                        Partida <?php echo $partida['id_partida']; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>No hay partidas disponibles.</p>
    <?php endif; ?>
</body>
</html>
