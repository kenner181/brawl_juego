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
        <div class="wrapper">
            <h3 class="sub-subtitulo">PUÑOS</h3>
            <div class="box-area"> 
                <div class="box">
                    <img src="../../img/puño1.png" alt="">
                    <div class="overlay">
                        <h3>TRES STRIKES</h3>
                        <i class="fa-solid fa-fire"><span> 300</span></i>
                        <i class="fa-solid fa-person-rifle"><span> 15</span></i>
                    </div>
                </div>
                <div class="box">
                    <img src="../../img/puño2.png" alt="">
                    <div class="overlay">
                        <h3>LA BATIDORA</h3>
                        <i class="fa-solid fa-fire"><span> 300</span></i>
                        <i class="fa-solid fa-person-rifle"><span> 15</span></i>
                    </div>
                </div>
                <div class="box">
                    <img src="../../img/puño3.png" alt="">
                    <div class="overlay">
                        <h3>TRIKI TRAKE</h3>
                        <i class="fa-solid fa-fire"><span> 300</span></i>
                        <i class="fa-solid fa-person-rifle"><span> 15</span></i>
                    </div>
                </div>
            </div>            
        </div>

        <div class="wrapper">
            <h3 class="sub-subtitulo">PISTOLAS</h3>
            <div class="box-area"> 
                <div class="box">
                    <img src="../../img/pistol1.png" alt="">
                    <div class="overlay">
                        <h3>PERDIGON</h3>
                        <i class="fa-solid fa-fire"><span> 300</span></i>
                        <i class="fa-solid fa-person-rifle"><span> 15</span></i>
                    </div>
                </div>
                <div class="box">
                    <img src="../../img/pistol2.png" alt="">
                    <div class="overlay">
                        <h3>FUSIL FRUNCIDO</h3>
                        <i class="fa-solid fa-fire"><span> 300</span></i>
                        <i class="fa-solid fa-person-rifle"><span> 15</span></i>
                    </div>
                </div>
                <div class="box">
                    <img src="../../img/pistol3.png" alt="">
                    <div class="overlay">
                        <h3>TETRANUTRA</h3>
                        <i class="fa-solid fa-fire"><span> 300</span></i>
                        <i class="fa-solid fa-person-rifle"><span> 15</span></i>
                    </div>
                </div>
            </div>            
        </div>

        <div class="wrapper">
            <h3 class="sub-subtitulo">AMETRALLADORA</h3>
            <div class="box-area"> 
                <div class="box">
                    <img src="../../img/ametra1.png" alt="">
                    <div class="overlay">
                        <h3>GATLING</h3>
                        <i class="fa-solid fa-fire"><span> 300</span></i>
                        <i class="fa-solid fa-person-rifle"><span> 15</span></i>
                    </div>
                </div>
                <div class="box">
                    <img src="../../img/ametra2.png" alt="">
                    <div class="overlay">
                        <h3>LIBRA DE LIMON</h3>
                        <i class="fa-solid fa-fire"><span> 300</span></i>
                        <i class="fa-solid fa-person-rifle"><span> 15</span></i>
                    </div>
                </div>
                <div class="box">
                    <img src="../../img/ametra3.png" alt="">
                    <div class="overlay">
                        <h3>KILO 141</h3>
                        <i class="fa-solid fa-fire"><span> 300</span></i>
                        <i class="fa-solid fa-person-rifle"><span> 15</span></i>
                    </div>
                </div>
            </div>            
        </div>

        <div class="wrapper">
            <h3 class="sub-subtitulo">FRANCOTIRADOR</h3>
            <div class="box-area"> 
                <div class="box">
                    <img src="../../img/franco1.png" alt="">
                    <div class="overlay">
                        <h3>PIU PIU</h3>
                        <i class="fa-solid fa-fire"><span> 300</span></i>
                        <i class="fa-solid fa-person-rifle"><span> 15</span></i>
                    </div>
                </div>
                <div class="box">
                    <img src="../../img/franco2.png" alt="">
                    <div class="overlay">
                        <h3>M12+1</h3>
                        <i class="fa-solid fa-fire"><span> 300</span></i>
                        <i class="fa-solid fa-person-rifle"><span> 15</span></i>
                    </div>
                </div>
                <div class="box">
                    <img src="../../img/franco3.png" alt="">
                    <div class="overlay">
                        <h3>VIC MAC</h3>
                        <i class="fa-solid fa-fire"><span> 300</span></i>
                        <i class="fa-solid fa-person-rifle"><span> 15</span></i>
                    </div>
                </div>
            </div>            
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="../../js/script.js" ></script>
</body>
</html>