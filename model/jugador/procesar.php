<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['id_usuario']) || empty($_SESSION['id_usuario'])) {
    // Si el usuario no está autenticado, redirigirlo a la página de inicio de sesión
    header("Location: ../iniciar_sesion.php");
    exit; 
}
require_once("../../conexion/conexion.php");

$db = new Database();
$conn = $db->getConnection();

// Verificar si se han recibido los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $id_atacante = $_POST['id_atacante'];
    $id_atacado = $_POST['id_atacado'];
    $id_arma = $_POST['id_arma'];
    $id_mundo = $_POST['id_mundo'];

    try {
        // Verificar si el jugador atacante existe en la tabla usuarios
        $sql_check_jugador = "SELECT id FROM usuarios WHERE id = ?";
        $stmt_check_jugador = $conn->prepare($sql_check_jugador);
        $stmt_check_jugador->execute([$id_atacante]);
        $result_check_jugador = $stmt_check_jugador->fetch(PDO::FETCH_ASSOC);

        // Verificar si se encontró el jugador atacante
        if ($result_check_jugador) {
            // Obtener el daño realizado del arma seleccionada
            $sql_dano = "SELECT dano, id_tip_arma FROM armas WHERE id_arma = ?";
            $stmt_dano = $conn->prepare($sql_dano);
            $stmt_dano->execute([$id_arma]);
            $result_dano = $stmt_dano->fetch(PDO::FETCH_ASSOC);

            // Verificar si se encontró el daño del arma
            if ($result_dano) {
                $dano = $result_dano['dano'];
                $id_tipo_arma = $result_dano['id_tip_arma'];

                // Obtener la vida actual del jugador atacado
                $sql_vida_atacado = "SELECT vida FROM usuarios WHERE id = ?";
                $stmt_vida_atacado = $conn->prepare($sql_vida_atacado);
                $stmt_vida_atacado->execute([$id_atacado]);
                $result_vida_atacado = $stmt_vida_atacado->fetch(PDO::FETCH_ASSOC);
                $vida_atacado = $result_vida_atacado['vida'];

                // Calcular la vida restante después del ataque
                $vida_restante = $vida_atacado - $dano;

                // Actualizar la vida del jugador atacado
                $sql_update_vida_atacado = "UPDATE usuarios SET vida = ? WHERE id = ?";
                $stmt_update_vida_atacado = $conn->prepare($sql_update_vida_atacado);
                $stmt_update_vida_atacado->execute([$vida_restante, $id_atacado]);

                // Obtener la fecha y hora actual
                $fecha_inicio = date('Y-m-d H:i:s');

                // Calcular la fecha y hora de finalización (puedes ajustar según necesites)
                $fecha_fin = date('Y-m-d H:i:s', strtotime($fecha_inicio . ' +1 hour'));

                // Insertar los datos en la tabla detalles_jugador
                $sql_insert = "INSERT INTO detalles_jugador (fecha_inicio, fecha_fin, id_jugador_atacante, id_jugador_atacado, id_mundo, dano_realizado, id_arma) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt_insert = $conn->prepare($sql_insert);
                $stmt_insert->execute([$fecha_inicio, $fecha_fin, $id_atacante, $id_atacado, $id_mundo, $dano, $id_arma]);

                // Actualizar el puntaje del jugador atacante según el tipo de arma
                $puntaje = 0;
                switch ($id_tipo_arma) {
                    case 1:
                        $puntaje = 1;
                        break;
                    case 2:
                        $puntaje = 2;
                        break;
                    case 3:
                        $puntaje = 10;
                        break;
                    case 4:
                        $puntaje = 20;
                        break;
                    default:
                        $puntaje = 0;
                        break;
                }

                // Sumar puntos al puntaje del jugador atacante
                $sql_update_puntaje = "UPDATE usuarios SET puntaje = puntaje + ? WHERE id = ?";
                $stmt_update_puntaje = $conn->prepare($sql_update_puntaje);
                $stmt_update_puntaje->execute([$puntaje, $id_atacante]);

                // Éxito al insertar los datos
                echo '<script>alert ("¡Ataque realizado con éxito! Causaste ' . $dano . ' de daño al jugador."); </script>';
                echo '<script>window.location="mapas.php"</script>';
                exit; // Se agrega para evitar que se ejecute más código después de la redirección
            } else {
                // El arma seleccionada no existe, mostrar un mensaje de error
                echo "El arma seleccionada no existe en la base de datos.";
            }
        } else {
            // El jugador atacante no existe, mostrar un mensaje de error
            echo "El jugador atacante no existe en la base de datos.";
            exit; // Se agrega para evitar que se ejecute más código después de la redirección
        }
    } catch (PDOException $e) {
        // Error al ejecutar la consulta
        echo "Error: " . $e->getMessage();
    }
} else {
    // Si no se reciben datos del formulario, mostrar un mensaje de error
    echo "No se han recibido datos del formulario.";
}
?>
