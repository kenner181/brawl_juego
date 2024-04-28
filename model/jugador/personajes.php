<?php
session_start();
if (!isset($_SESSION['id_usuario']) || empty($_SESSION['id_usuario'])) {
    
    header("Location: ../../iniciar_sesion.php");
    exit; 
}
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
    <title>Personajes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="../../css/personajes.css">
    
</head>
<body>
    
    <nav class="navbar container">
        <div class="title-container">
            <h1>BRAWLERS</h1>
            <h3 class="subtitle">SELECCIONA</h3>
        </div> 
        <div class="button-container">
            <a href="index.php"><button type="button" class="btn btn-primary diagonal">VOLVER    </button></a>
        </div>
    </nav>

    <div class="swiper mySwiper container">
        <div class="swiper-wrapper">

            <div class="swiper-slide">
                <img src="../../img/shelly_fondo.jpg" alt="">
                <div class="card__data">
                    <h2 class="card__title">SHELLY</h2>
                    <span class="card__description">"Donde pone el ojo, pone la bala"</span>
                    <a href="index.php?id_personaje=1" class="card__button">Seleccionar</a>
                 </div>
            </div>

            <div class="swiper-slide">
                <img src="../../img/pam_fondo.jpg" alt="">
                <div class="card__data">
                    <h2 class="card__title">PAM</h2>
                    <span class="card__description">"Siempre puede con todo"</span>
                    <a href="index.php?id_personaje=2" class="card__button">Seleccionar</a>
                 </div>
            </div>

            <div class="swiper-slide">
                <img src="../../img/colt_fondo.jpg" alt="">
                <div class="card__data">
                    <h2 class="card__title">COLT</h2>
                    <span class="card__description">"Conquista a todos, excepto a shelly"</span>
                    <a href="index.php?id_personaje=3" class="card__button">Seleccionar</a>
                </div>
            </div>

            <div class="swiper-slide">
                <img src="../../img/primo_fondo.jpg" alt="">
                <div class="card__data">
                    <h2 class="card__title">EL PRIMO</h2>
                    <span class="card__description">"El rey del cuadrilatero"</span>
                    <a href="index.php?id_personaje=4" class="card__button">Seleccionar</a>
                </div>
            </div>

            <div class="swiper-slide">
                <img src="../../img/crow_fondo.jpg" alt="">
                <div class="card__data">
                    <h2 class="card__title">CROW</h2>
                    <span class="card__description">"No confia en nadie"</span>
                    <a href="index.php?id_personaje=5" class="card__button">Seleccionar</a>
                </div>
            </div>

            <div class="swiper-slide">
                <img src="../../img/bull_fondo.jpg" alt="">
                <div class="card__data">
                    <h2 class="card__title">BULL</h2>
                    <span class="card__description">"Es duro como el metal"</span>
                    <a href="index.php?id_personaje=6" class="card__button">Seleccionar</a>
                </div>
            </div>
        </div>
    </div>
   


    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="../../js/script.js" ></script>
</body>
</html>