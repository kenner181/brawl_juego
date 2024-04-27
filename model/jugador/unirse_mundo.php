<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['id_usuario']) || empty($_SESSION['id_usuario'])) {
    // Si el usuario no está autenticado, mostrar un mensaje y redirigirlo a la página de inicio de sesión
    echo '
        <script>
            alert("Por favor inicie sesión e intente nuevamente");
            window.location = "../iniciar_sesion.php";
        </script>
    ';
    exit; 
}
require_once("../../conexion/conexion.php");
$db = new Database();
$con = $db->getConnection();

// Verificar si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_mundo'])) {
    // Obtener el id_mundo y el id del jugador activo
    $id_mundo = $_POST['id_mundo'];
    
    // Obtener el id del jugador activo desde la sesión
    $id_jugador = $_SESSION['id_usuario']; // Ajusta este valor según cómo guardes el id del jugador en la sesión

    // Insertar un nuevo registro en detalle_mundo
    $sql_insertar_detalle = "INSERT INTO detalle_mundo (id_mundo, id_jugador) VALUES (?, ?)";
    
    try {
        $stmt = $con->prepare($sql_insertar_detalle);
        // Vinculamos los parámetros usando bind_param
        $stmt->bindParam(1, $id_mundo, PDO::PARAM_INT);
        $stmt->bindParam(2, $id_jugador, PDO::PARAM_INT);
        $stmt->execute();
        echo '<script>alert("Te has unido al mundo correctamente."); window.location = "mapas.php";</script>';

    } catch (PDOException $e) {
        echo "Error al ejecutar la consulta: " . $e->getMessage();
    }
} else {
    echo "ID de mundo no proporcionado.";
}
?>
