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

// Obtener todos los mapas
$sql_mapas = "SELECT * FROM mundos";

$result_mapas = $conn->query($sql_mapas);

if ($result_mapas->num_rows > 0) {
    $mapas = $result_mapas->fetch_all(MYSQLI_ASSOC);
} else {
    $mapas = [];
}

// Cerrar la conexión
$conn->close();
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
                    <img src="<?php echo $mapa['foto']; ?>" alt="<?php echo $mapa['nombre_mundo']; ?>">
                    <h2 class="card__title"><?php echo $mapa['nombre_mundo']; ?></h2>
                    <!-- Aquí está el formulario que contiene el botón "Unirse" -->
                    <form action="unirse_mundo.php" method="post">
                        <input type="hidden" name="id_mundo" value="<?php echo $mapa['id_mundo']; ?>">
                        <!-- Aquí deberías obtener el id del usuario activo -->
                        <input type="hidden" name="id_usuario" value="1">
                        <button type="submit" class="btn btn-primary diagonal">Unirse</button>
                    </form>
                    <form action="sala.php" method="post">
                        <input type="hidden" name="id_mundo" value="<?php echo $mapa['id_mundo']; ?>">
                        <!-- Aquí deberías obtener el id del usuario activo -->
                        <input type="hidden" name="id_usuario" value="1">
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