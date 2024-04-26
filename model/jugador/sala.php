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
                // Conexión a la base de datos
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "brawl_stars";

                $conn = new mysqli($servername, $username, $password, $database);

                if ($conn->connect_error) {
                    die("Conexión fallida: " . $conn->connect_error);
                }

                // Obtener el ID del mundo desde el formulario
                $id_mundo = $_POST['id_mundo'] ?? null;

                if ($id_mundo) {
                    // Consulta SQL para obtener la foto del mundo específico
                    $sql_foto_mundo = "SELECT foto FROM mundos WHERE id_mundo = ?";
                    $stmt_foto_mundo = $conn->prepare($sql_foto_mundo);
                    $stmt_foto_mundo->bind_param("i", $id_mundo);
                    $stmt_foto_mundo->execute();
                    $result_foto_mundo = $stmt_foto_mundo->get_result();

                    if ($result_foto_mundo->num_rows > 0) {
                        // Obtener la ruta de la foto del mundo
                        $row_foto_mundo = $result_foto_mundo->fetch_assoc();
                        $foto_mapa = $row_foto_mundo['foto'];

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

                // Cerrar la conexión
                $conn->close();
                ?>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="box-container">
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

                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id_mundo);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    // Mostrar los jugadores y sus datos
                    while ($row = $result->fetch_assoc()) {
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

            // Cerrar la conexión
            $conn->close();
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
                    // Conexión a la base de datos
                    $conn = new mysqli($servername, $username, $password, $database);

                    if ($conn->connect_error) {
                        die("Conexión fallida: " . $conn->connect_error);
                    }

                    // Consulta SQL para obtener las armas
                    $sql_armas = "SELECT id_arma, nombre_arma FROM armas";
                    $result_armas = $conn->query($sql_armas);

                    if ($result_armas->num_rows > 0) {
                        // Mostrar las opciones de las armas
                        while ($row_arma = $result_armas->fetch_assoc()) {
                            echo '<option value="' . $row_arma['id_arma'] . '">' . $row_arma['nombre_arma'] . '</option>';
                        }
                    } else {
                        echo "No se encontraron armas disponibles.";
                    }

                    // Cerrar la conexión
                    $conn->close();
                    ?>
                </select>
            </div>
            <div class="campos">
                <h4>Objetivo</h4>
                <select name="id_atacado">
                    <option value="">Seleccione jugador</option>
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

                    // Obtener el ID del mundo desde el formulario
                    $id_mundo = $_POST['id_mundo'] ?? null;

                    if ($id_mundo) {
                        // Consulta SQL para obtener los jugadores unidos al mundo o mapa
                        $sql_jugadores = "SELECT usuarios.id, usuarios.username 
                    FROM usuarios 
                    INNER JOIN detalle_mundo ON usuarios.id = detalle_mundo.id_jugador
                    WHERE detalle_mundo.id_mundo = ?";

                        $stmt_jugadores = $conn->prepare($sql_jugadores);
                        $stmt_jugadores->bind_param("i", $id_mundo);
                        $stmt_jugadores->execute();
                        $result_jugadores = $stmt_jugadores->get_result();

                        if ($result_jugadores->num_rows > 0) {
                            // Mostrar las opciones de los jugadores
                            while ($row_jugador = $result_jugadores->fetch_assoc()) {
                                echo '<option value="' . $row_jugador['id'] . '">' . $row_jugador['username'] . '</option>';
                            }
                        } else {
                            echo "No se encontraron jugadores unidos a este mundo.";
                        }
                    } else {
                        echo "ID del mundo no recibido.";
                    }

                    // Cerrar la conexión
                    $conn->close();
                    ?>

                </select>
            </div>
            <input type="hidden" name="id_mundo" value="<?php echo $id_mundo; ?>">
            <input type="hidden" name="id_atacante" value="1"> <!-- Cambia $_SESSION['id'] por el nombre de tu variable de sesión -->
            <input type="submit" name="inicio" value="Atacar">
            <br><br>
        </form>
    </div>

</body>

</html>