<?php
// Verificar si se proporcionó el id_partida a través de GET
if (isset($_GET['id_partida'])) {
    // Conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "brawl_stars";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener el id_partida de la URL
    $id_partida = $_GET['id_partida'];

    // Obtener datos de la partida
    $sql_partida = "SELECT * FROM partida WHERE id_partida = ?";
    
    if ($stmt = $conn->prepare($sql_partida)) {
        $stmt->bind_param("i", $id_partida);
        $stmt->execute();
        $result_partida = $stmt->get_result();
        
        if ($result_partida->num_rows > 0) {
            $partida = $result_partida->fetch_assoc();
        } else {
            die("La partida no existe.");
        }
        
        $stmt->close();
    } else {
        die("Error en la consulta SQL de la partida.");
    }

    // Obtener detalles de la partida
    $sql_detalles_partida = "SELECT * FROM detalle_partida WHERE id_partida = ?";

    if ($stmt = $conn->prepare($sql_detalles_partida)) {
        $stmt->bind_param("i", $id_partida);
        $stmt->execute();
        $result_detalles_partida = $stmt->get_result();
        
        if ($result_detalles_partida->num_rows > 0) {
            $detalles_partida = $result_detalles_partida->fetch_all(MYSQLI_ASSOC);
        } else {
            $detalles_partida = [];
        }
        
        $stmt->close();
    } else {
        die("Error en la consulta SQL de los detalles de la partida.");
    }

    // Cerrar la conexión
    $conn->close();
} else {
    die("ID de partida no proporcionado.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles de la Partida</title>
</head>
<body>
    <h1>Detalles de la Partida</h1>
    
    <h2>Partida</h2>
    <?php if (!empty($partida)) : ?>
        <p>ID de la Partida: <?php echo $partida['id_partida']; ?></p>
        <p>Fecha de Inicio: <?php echo $partida['fecha_inicio']; ?></p>
        <p>Fecha de Fin: <?php echo $partida['fecha_fin']; ?></p>
    <?php else : ?>
        <p>No se encontró la partida.</p>
    <?php endif; ?>
    
    <h2>Detalles de la Partida</h2>
    <?php if (!empty($detalles_partida)) : ?>
        <ul>
            <?php foreach ($detalles_partida as $detalle) : ?>
                <li>
                  
                    ID de Jugador Atacante: <?php echo $detalle['id_jugador_atacante']; ?><br>
                    ID de Jugador Atacado: <?php echo $detalle['id_jugador_atacado']; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>No hay detalles disponibles para esta partida.</p>
    <?php endif; ?>
</body>
</html>
