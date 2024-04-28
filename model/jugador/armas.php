<?php
session_start();
require_once("../../conexion/conexion.php");
$db = new Database();
$con = $db->getConnection();
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
        <!-- Grupo de armas: PUÑOS -->
        <div class="wrapper">
            <h3 class="sub-subtitulo">PUÑOS</h3>
            <div class="box-area"> 
                <?php
                // Consulta para obtener las armas de tipo PUÑOS
                $query_punos = "SELECT * FROM armas WHERE id_tip_arma = 1";
                $result_punos = $con->query($query_punos);
                while ($row_punos = $result_punos->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="box">
                    <img src="<?php echo $row_punos['imagen_arma']; ?>" alt="">
                    <div class="overlay">
                        <h3><?php echo $row_punos['nombre_arma']; ?></h3>
                        <i class="fa-solid fa-fire"><span><?php echo $row_punos['dano']; ?></span></i>
                        <i class="fa-solid fa-person-rifle"><span><?php echo $row_punos['municion']; ?></span></i>
                    </div>
                </div>
                <?php } ?>
            </div>            
        </div>

        <!-- Grupo de armas: PISTOLAS -->
        <div class="wrapper">
            <h3 class="sub-subtitulo">PISTOLAS</h3>
            <div class="box-area"> 
                <?php
                // Consulta para obtener las armas de tipo PISTOLAS
                $query_pistolas = "SELECT * FROM armas WHERE id_tip_arma = 2";
                $result_pistolas = $con->query($query_pistolas);
                while ($row_pistolas = $result_pistolas->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="box">
                    <img src="<?php echo $row_pistolas['imagen_arma']; ?>" alt="">
                    <div class="overlay">
                        <h3><?php echo $row_pistolas['nombre_arma']; ?></h3>
                        <i class="fa-solid fa-fire"><span><?php echo $row_pistolas['dano']; ?></span></i>
                        <i class="fa-solid fa-person-rifle"><span><?php echo $row_pistolas['municion']; ?></span></i>
                    </div>
                </div>
                <?php } ?>
            </div>            
        </div>

        <!-- Grupo de armas: AMETRALLADORAS -->
        <div class="wrapper">
            <h3 class="sub-subtitulo">AMETRALLADORAS</h3>
            <div class="box-area"> 
                <?php
                // Consulta para obtener las armas de tipo AMETRALLADORAS
                $query_ametralladoras = "SELECT * FROM armas WHERE id_tip_arma = 3";
                $result_ametralladoras = $con->query($query_ametralladoras);
                while ($row_ametralladoras = $result_ametralladoras->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="box">
                    <img src="<?php echo $row_ametralladoras['imagen_arma']; ?>" alt="">
                    <div class="overlay">
                        <h3><?php echo $row_ametralladoras['nombre_arma']; ?></h3>
                        <i class="fa-solid fa-fire"><span><?php echo $row_ametralladoras['dano']; ?></span></i>
                        <i class="fa-solid fa-person-rifle"><span><?php echo $row_ametralladoras['municion']; ?></span></i>
                    </div>
                </div>
                <?php } ?>
            </div>            
        </div>

        <!-- Grupo de armas: FRANCOTIRADORES -->
        <div class="wrapper">
            <h3 class="sub-subtitulo">FRANCOTIRADORES</h3>
            <div class="box-area"> 
                <?php
                // Consulta para obtener las armas de tipo FRANCOTIRADORES
                $query_francotiradores = "SELECT * FROM armas WHERE id_tip_arma = 4";
                $result_francotiradores = $con->query($query_francotiradores);
                while ($row_francotiradores = $result_francotiradores->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="box">
                    <img src="<?php echo $row_francotiradores['imagen_arma']; ?>" alt="">
                    <div class="overlay">
                        <h3><?php echo $row_francotiradores['nombre_arma']; ?></h3>
                        <i class="fa-solid fa-fire"><span><?php echo $row_francotiradores['dano']; ?></span></i>
                        <i class="fa-solid fa-person-rifle"><span><?php echo $row_francotiradores['municion']; ?></span></i>
                    </div>
                </div>
                <?php } ?>
            </div>            
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="../../js/script.js" ></script>
</body>
</html>
