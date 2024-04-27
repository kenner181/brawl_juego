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

// Obtener el id del usuario activo
$id_usuario = $_SESSION['id_usuario']; // Ajusta esto según cómo almacenas el id de usuario en la sesión

// Obtener el id_rango del usuario activo
$query_id_rango = "SELECT id_rango FROM usuarios WHERE id = :id_usuario";
$stmt_id_rango = $con->prepare($query_id_rango);
$stmt_id_rango->bindParam(':id_usuario', $id_usuario);
$stmt_id_rango->execute();
$id_rango_usuario = $stmt_id_rango->fetchColumn();

// Consulta para obtener los mapas filtrados por id_rango
$sql_mapas = "SELECT * FROM mundos WHERE id_rango = :id_rango_usuario";
$stmt_mapas = $con->prepare($sql_mapas);
$stmt_mapas->bindParam(':id_rango_usuario', $id_rango_usuario);
$stmt_mapas->execute();
$result_mapas = $stmt_mapas->fetchAll(PDO::FETCH_ASSOC);

if ($stmt_mapas->rowCount() > 0) {
    // Si hay resultados, almacenarlos en un array asociativo
    $mapas = $result_mapas;
} else {
    // Si no hay resultados, inicializar $mapas como un array vacío
    $mapas = [];
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Varela+Round&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Mapas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="../../css/maps.css">
</head>

<body>
    <nav class="navbar container">
        <div class="title-container">
            <h1>DESAFÍO</h1>
            <h3 class="subtitle">MAPAS</h3>
        </div>
        <div class="button-container">
            <a href="index.php"><button type="button" class="btn btn-primary diagonal" id="volver">VOLVER</button></a>
        </div>
    </nav>

    <div class="swiper mySwiper container">
        <div class="swiper-wrapper">
            <?php foreach ($mapas as $mapa) : ?>
                <div class="swiper-slide">
                    <!-- Contenido de cada slide -->
                    <img src="<?php echo $mapa['foto']; ?>" alt="<?php echo $mapa['nombre_mundo']; ?>">
                    <h2 class="card__title"><?php echo $mapa['nombre_mundo']; ?></h2>

                    <?php
                    // Verificar si el usuario está registrado en este mundo
                    $id_mundo = $mapa['id_mundo'];

                    // Consulta para verificar si el usuario está registrado en este mundo
                    $sql_verificar_registro = "SELECT COUNT(*) FROM detalle_mundo WHERE id_jugador = :id_usuario AND id_mundo = :id_mundo";
                    $stmt_verificar_registro = $con->prepare($sql_verificar_registro);
                    $stmt_verificar_registro->bindParam(':id_usuario', $id_usuario);
                    $stmt_verificar_registro->bindParam(':id_mundo', $id_mundo);
                    $stmt_verificar_registro->execute();
                    $registro_existente = $stmt_verificar_registro->fetchColumn();

                    // Determinar el texto y la acción del botón según el estado del registro del usuario en este mundo
                    $boton_texto = $registro_existente ? "Ingresar al Mapa" : "Unirse al Mapa";
                    $accion_formulario = $registro_existente ? "sala.php" : "unirse_mundo.php";

                    // Mostrar el formulario con el botón correspondiente
                    echo '<form action="' . $accion_formulario . '" method="post">';
                    echo '<input type="hidden" name="id_mundo" value="' . $mapa['id_mundo'] . '">';
                    echo '<input type="hidden" name="id_usuario" value="' . $id_usuario . '">';
                    echo '<button type="submit" class="btn btn-primary diagonal">' . $boton_texto . '</button>';
                    echo '</form>';
                    ?>

                </div>
            <?php endforeach; ?>


        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="../../js/script.js"></script>
</body>

</html>