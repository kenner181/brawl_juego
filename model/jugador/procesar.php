<?php
// Parámetros de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "brawl_stars";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se han recibido los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $id_atacante = $_POST['id_atacante'];
    $id_atacado = $_POST['id_atacado'];
    $id_arma = $_POST['id_arma'];
    $id_mundo = $_POST['id_mundo'];

    // Verificar si el jugador atacante existe en la tabla usuarios
    $sql_check_jugador = "SELECT id FROM usuarios WHERE id = ?";
    $stmt_check_jugador = $conn->prepare($sql_check_jugador);
    $stmt_check_jugador->bind_param("i", $id_atacante);
    $stmt_check_jugador->execute();
    $result_check_jugador = $stmt_check_jugador->get_result();

    // Verificar si se encontró el jugador atacante
    if ($result_check_jugador->num_rows > 0) {
        // Obtener el daño realizado del arma seleccionada
        $sql_dano = "SELECT dano FROM armas WHERE id_arma = ?";
        $stmt_dano = $conn->prepare($sql_dano);
        $stmt_dano->bind_param("i", $id_arma);
        $stmt_dano->execute();
        $result_dano = $stmt_dano->get_result();
        $row_dano = $result_dano->fetch_assoc();
        $dano = $row_dano['dano'];

        // Obtener la fecha y hora actual
        $fecha_inicio = date('Y-m-d H:i:s');

        // Calcular la fecha y hora de finalización (puedes ajustar según necesites)
        $fecha_fin = date('Y-m-d H:i:s', strtotime($fecha_inicio . ' +1 hour'));

        // Insertar los datos en la tabla detalles_jugador
        $sql_insert = "INSERT INTO detalles_jugador (fecha_inicio, fecha_fin, id_jugador_atacante, id_jugador_atacado, id_mundo, dano_realizado, id_arma) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("ssiiiii", $fecha_inicio, $fecha_fin, $id_atacante, $id_atacado, $id_mundo, $dano, $id_arma);

        if ($stmt_insert->execute()) {
            // Éxito al insertar los datos
            echo '<script>alert ("¡Ataque realizado con éxito! Causaste ' . $dano . ' de daño al jugador."); </script>';
            echo '<script>window.location="mapas.php"</script>';
        } else {
            // Error al insertar los datos
            echo "Error al realizar el ataque.";
        }
    } else {
        // El jugador atacante no existe, mostrar un mensaje de error
        echo "El jugador atacante no existe en la base de datos.";
        header("Location: sala.php");
    }
} else {
    // Si no se reciben datos del formulario, redireccionar o mostrar un mensaje de error
    echo "No se han recibido datos del formulario.";
}

// Cerrar la conexión
$conn->close();
?>
