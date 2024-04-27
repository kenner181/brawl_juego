<?php
session_start();
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    
    header("Location: ../../iniciar_sesion.php");
    exit; 
}
require_once("../../conexion/conexion.php");
$db = new Database();
$con = $db->getConnection();

$sql = "SELECT * FROM armas
INNER JOIN tip_arma ON armas.id_tip_arm = tip_arma.id_tip_arm
INNER JOIN usuarios ON armas.id_nivel = usuarios.id_nivel
GROUP BY armas.id_arma";
$result = $con->query($sql);

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Armas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="../../css/armas.css">
    
</head>
<body>
    
    <nav class="navbar container">
        <div class="title-container">
            <h1>HERRAMIENTAS</h1>
            <h3 class="subtitle">ARMAS</h3>
        </div>
        <div class="button-container">
            <a href="index.php"><button type="button" class="btn btn-primary diagonal">VOLVER</button></a>
        </div>
    </nav>

    
    <div id="card-area">
    <?php
        
        // Iterar a través de los resultados de la consulta y generar las cajas dinámicamente
        $currentCategory = "";
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            // Verificar si la categoría ha cambiado
            if ($currentCategory != $row['tip_arm']) {
                // Si es así, imprimir el encabezado de la categoría y comenzar un nuevo área de caja
                if ($currentCategory != "") {
                    // Cerrar la caja del área anterior
                    echo '</div></div>';
                }
                // Actualizar la categoría actual
                $currentCategory = $row['tip_arm'];
                // Imprimir el encabezado de la categoría y comenzar un nuevo área de caja
                echo '<div class="wrapper">';
                echo '<h3 class="sub-subtitulo">' . $currentCategory . '</h3>';
                echo '<div class="box-area">';
            }
            // Mostrar cada arma en una caja
            echo '<div class="box">';
            echo '<img src="' . $row['imagen_arma'] . '" alt="">';
            echo '<div class="overlay">';
            echo '<h3>' . $row['nombre_arma'] . '</h3>'; // Nombre del arma
            echo '<i class="fa-solid fa-fire"><span>' . $row['dano'] . '</span></i>'; // Daño del arma
            echo '<i class="fa-solid fa-person-rifle"><span>' . $row['can_balas'] . '</span></i>'; // Alcance del arma
            echo '</div></div>';
        }
        // Cerrar la última caja del área
        echo '</div></div>';
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="../../js/script.js" ></script>
</body>
</html>