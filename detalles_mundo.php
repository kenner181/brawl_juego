<?php
// Verificar si se proporcionó el id_mundo a través de GET
if (isset($_GET['id_mundo'])) {
    // Conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "brawl_stars";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener el id_mundo de la URL
    $id_mundo = $_GET['id_mundo'];

    // Obtener datos del mundo
    $sql_mundo = "SELECT * FROM mundos WHERE id_mundo = ?";
    
    if ($stmt = $conn->prepare($sql_mundo)) {
        $stmt->bind_param("i", $id_mundo);
        $stmt->execute();
        $result_mundo = $stmt->get_result();
        
        if ($result_mundo->num_rows > 0) {
            $mundo = $result_mundo->fetch_assoc();
        } else {
            die("El mundo no existe.");
        }
        
        $stmt->close();
    } else {
        die("Error en la consulta SQL del mundo.");
    }

    // Obtener detalles del mundo
    $sql_detalles_mundo = "SELECT * FROM detalle_mundo WHERE id_mundo = ?";

    if ($stmt = $conn->prepare($sql_detalles_mundo)) {
        $stmt->bind_param("i", $id_mundo);
        $stmt->execute();
        $result_detalles_mundo = $stmt->get_result();
        
        if ($result_detalles_mundo->num_rows > 0) {
            $detalles_mundo = $result_detalles_mundo->fetch_all(MYSQLI_ASSOC);
        } else {
            $detalles_mundo = [];
        }
        
        $stmt->close();
    } else {
        die("Error en la consulta SQL de los detalles del mundo.");
    }

    // Cerrar la conexión
    $conn->close();
} else {
    die("ID de mundo no proporcionado.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles del Mundo</title>
</head>
<body>
    <h1>Detalles del Mundo</h1>
    
    <h2>Mundo</h2>
    <?php if (!empty($mundo)) : ?>
        <p>ID del Mundo: <?php echo $mundo['id_mundo']; ?></p>
        <p>Nombre del Mundo: <?php echo $mundo['nombre']; ?></p>
        <!-- Agrega aquí más campos de información del mundo si los tienes -->
    <?php else : ?>
        <p>No se encontró el mundo.</p>
    <?php endif; ?>
    
    <h2>Detalles del Mundo</h2>
    <?php if (!empty($detalles_mundo)) : ?>
        <ul>
            <?php foreach ($detalles_mundo as $detalle) : ?>
                <li>
                    ID del Detalle del Mundo: <?php echo $detalle['id_dmundo']; ?><br>
                    ID del Jugador: <?php echo $detalle['id_jugador']; ?>
                    <!-- Agrega aquí más detalles si los tienes -->
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>No hay detalles disponibles para este mundo.</p>
    <?php endif; ?>
</body>
</html>
