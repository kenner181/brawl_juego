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

// Consulta para eliminar los jugadores con 0 de vida o con id_rango diferente al del mapa
$sql_eliminar_jugadores = "DELETE FROM detalle_mundo 
                           WHERE (id_jugador IN (SELECT usuarios.id 
                                                FROM usuarios 
                                                WHERE usuarios.vida <= 0)
                                  OR id_jugador IN (SELECT usuarios.id 
                                                    FROM usuarios 
                                                    INNER JOIN mundos ON usuarios.id_rango != mundos.id_rango
                                                    WHERE mundos.id_mundo = ?))";

$stmt_eliminar_jugadores = $con->prepare($sql_eliminar_jugadores);
$stmt_eliminar_jugadores->execute([$_POST['id_mundo']]); // Aquí se debe asegurar que id_mundo esté presente en el formulario que envía los datos a este script

// Mensaje para mostrar los jugadores eliminados
$jugadores_eliminados = $stmt_eliminar_jugadores->rowCount();
if ($jugadores_eliminados > 0) {
    echo "<script>alert('Se han eliminado $jugadores_eliminados jugadores cuya vida era 0 o menor o cuyo rango era diferente al del mapa.');</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Varela+Round&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Partida</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="../../css/partid.css">
    <style>
        .swiper-slide {
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body>

    <nav class="navbar container">
        <div class="title-container">
            <h1>ATRAPAGEMAS</h1>
            <h3 class="subtitle">TIROTEO ESCOLAR</h3>
        </div>
    </nav>

    <div class="swiper mySwiper container">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <?php

                // Obtener el ID del mundo desde el formulario
                $id_mundo = $_POST['id_mundo'] ?? null;

                if ($id_mundo) {
                    // Consulta SQL para obtener la foto del mundo específico
                    $sql_foto_mundo = "SELECT foto FROM mundos WHERE id_mundo = ?";
                    $stmt_foto_mundo = $con->prepare($sql_foto_mundo);
                    $stmt_foto_mundo->execute([$id_mundo]);
                    $result_foto_mundo = $stmt_foto_mundo->fetch(PDO::FETCH_ASSOC);

                    if ($result_foto_mundo) {
                        // Obtener la ruta de la foto del mundo
                        $foto_mapa = $result_foto_mundo['foto'];

                        // Imprimir la ruta de la imagen del mundo
                        echo '<img src="' . $foto_mapa . '" alt="Mapa">';
                    } else {
                        // Si no se encuentra la foto del mundo, asignar una ruta de imagen predeterminada o mostrar un mensaje de error
                        $foto_mapa = "ruta/a/imagen/predeterminada.jpg"; // Cambia esto por la ruta de una imagen predeterminada o muestra un mensaje de error
                        echo "No se encontró la foto del mundo.";
                    }
                } else {
                    echo "ID del mundo no recibido.";
                }

                ?>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="box-container">
            <?php
            // Obtener el ID del mundo desde el formulario
            $id_mundo = $_POST['id_mundo'] ?? null;

            if ($id_mundo) {
                // Consulta SQL para obtener los jugadores del mundo actual
                $sql = "SELECT usuarios.*, detalle_mundo.id_dmundo, mundos.foto AS foto_mundo, avatar.foto AS foto_avatar
                    FROM usuarios 
                    INNER JOIN detalle_mundo ON usuarios.id = detalle_mundo.id_jugador 
                    INNER JOIN mundos ON detalle_mundo.id_mundo = mundos.id_mundo
                    INNER JOIN avatar ON usuarios.id_avatar = avatar.id_avatar
                    WHERE detalle_mundo.id_mundo = ?";

                $stmt = $con->prepare($sql);
                $stmt->execute([$id_mundo]);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($result) {
                    // Mostrar los jugadores y sus datos
                    foreach ($result as $row) {
                        echo '<div class="box">';
                        echo '<div class="imgbx">';
                        // Mostrar la foto del jugador en lugar de la ruta
                        echo '<img src="' . $row['foto_avatar'] . '" alt="' . $row['username'] . '">';
                        echo '</div>';
                        echo '<div class="content">';
                        echo '<div class="details">';
                        echo '<p>jugador: ' . $row['username'] . '</p>';
                        echo '<p>Puntaje: ' . $row['puntaje'] . '</p>';
                        // Aquí puedes mostrar más datos según sea necesario
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "No se encontraron jugadores en este mundo.";
                }
            } else {
                echo "ID del mundo no recibido.";
            }

            ?>
        </div>
    </div>

    <div class="formulario">
        <h1>Nombre Jugador</h1>
        <form method="post" action="procesar.php" id="formulario">
            <div class="campos">
                <h4>Tipo de Arma</h4>
                <select name="id_arma">
                    <option value="">Seleccione Arma</option>
                    <?php
                    // Consulta SQL para obtener las armas según el rango del mundo y los jugadores
                    $sql_armas = "SELECT id_arma, nombre_arma ,municion
                                  FROM armas 
                                  WHERE id_rango <= (SELECT id_rango FROM mundos WHERE id_mundo = ?) 
                                  AND id_rango <= (SELECT id_rango FROM usuarios WHERE id = ?)";

                    $stmt_armas = $con->prepare($sql_armas);
                    $stmt_armas->execute([$id_mundo, $_SESSION['id_usuario']]);
                    $result_armas = $stmt_armas->fetchAll(PDO::FETCH_ASSOC);

                    if ($result_armas) {
                        // Mostrar las opciones de las armas
                        foreach ($result_armas as $row_arma) {
                            echo '<option value="' . $row_arma['id_arma'] . '">' . $row_arma['nombre_arma'] .' '. 'municion: ' . $row_arma['municion'] .'</option>';
                        }
                    } else {
                        echo "No se encontraron armas disponibles para este rango.";
                    }

                    ?>
                </select>
            </div>
            <div class="campos">
                <h4>Objetivo</h4>
                <select name="id_atacado">
                    <option value="">Seleccione jugador</option>
                    <?php
                    // Obtener el ID del mundo desde el formulario
                    $id_mundo = $_POST['id_mundo'] ?? null;

                    if ($id_mundo) {
                        // Consulta SQL para obtener los jugadores unidos al mundo o mapa, excluyendo al jugador en sesión activa
                        $sql_jugadores = "SELECT usuarios.id, usuarios.username 
                    FROM usuarios 
                    INNER JOIN detalle_mundo ON usuarios.id = detalle_mundo.id_jugador
                    WHERE detalle_mundo.id_mundo = ? AND usuarios.id != ?"; // Excluir al jugador en sesión activa

                        $stmt_jugadores = $con->prepare($sql_jugadores);
                        $stmt_jugadores->execute([$id_mundo, $_SESSION['id_usuario']]);
                        $result_jugadores = $stmt_jugadores->fetchAll(PDO::FETCH_ASSOC);

                        if ($result_jugadores) {
                            // Mostrar las opciones de los jugadores
                            foreach ($result_jugadores as $row_jugador) {
                                echo '<option value="' . $row_jugador['id'] . '">' . $row_jugador['username'] . '</option>';
                            }
                        } else {
                            echo "No se encontraron jugadores unidos a este mundo.";
                        }
                    } else {
                        echo "ID del mundo no recibido.";
                    }

                    ?>

                </select>
            </div>
            <input type="hidden" name="id_mundo" value="<?php echo $id_mundo; ?>">
            <input type="hidden" name="id_atacante" value="<?php echo $_SESSION['id_usuario']; ?>"> <!-- Cambia $_SESSION['id'] por el nombre de tu variable de sesión -->
            <input type="submit" name="inicio" value="Atacar">
            <br><br>
        </form>
    </div>

</body>

</html>
