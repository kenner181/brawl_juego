<?php
session_start();
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("Location: ../../iniciar_sesion.php");
    exit; 
}
require_once("../../conexion/conexion.php");
$db = new Database();
$con = $db->getConnection();

// Obtener el id del usuario activo
$id_usuario = $_SESSION['username']; // Ajusta esto según la forma en que almacenas el id de usuario en la sesión

$sql_mapas = "SELECT * FROM mundos";

$stmt = $con->prepare($sql_mapas);
$stmt->execute();
$result_mapas = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($stmt->rowCount() > 0) {
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
                    <form action="unirse_mundo.php" method="post">
                        <input type="hidden" name="id_mundo" value="<?php echo $mapa['id_mundo']; ?>">
                        <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>"> <!-- Aquí se incluye el id del usuario activo -->
                        <button type="submit" class="btn btn-primary diagonal">Unirse</button>
                    </form>
                    <form action="sala.php" method="post">
                        <input type="hidden" name="id_mundo" value="<?php echo $mapa['id_mundo']; ?>">
                        <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>"> <!-- Aquí se incluye el id del usuario activo -->
                        <button type="submit" class="btn btn-primary diagonal">Unirse sala</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="../../js/script.js"></script>
</body>

</html>
