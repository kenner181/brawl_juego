<?php


session_start();
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    
    header("Location: ../../iniciar_sesion.php");
    exit; 
}
require_once("../../conexion/conexion.php");
$db = new Database();
$con = $db->getConnection();


// Verificar si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_mundo'])) {
   

    // Obtener el id_mundo y el id del jugador activo
    $id_mundo = $_POST['id_mundo'];
    // Aquí deberías obtener el id del jugador activo, por ejemplo desde una variable de sesión
    $id_jugador = 1; // Suponiendo que el id del jugador activo es 1

    // Insertar un nuevo registro en detalle_mundo
    $sql_insertar_detalle = "INSERT INTO detalle_mundo (id_mundo, id_jugador) VALUES (?, ?)";
    
    if ($stmt = $conn->prepare($sql_insertar_detalle)) {
        $stmt->bind_param("ii", $id_mundo, $id_jugador);
        $stmt->execute();
        $stmt->close();
        
        echo "Te has unido al mundo correctamente.";
    } else {
        echo "Error al unirse al mundo: " . $conn->error;
    }


} else {
    echo "ID de mundo no proporcionado.";
}
?>
