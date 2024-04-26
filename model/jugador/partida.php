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
    <title>Partida</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="../../css/partida.css">
    
</head>
<body>
    
<div class="joa">
    <nav class="navbar container">
        <div class="title-container">
            <h1>ATRAPAGEMAS</h1>
            <h3 class="subtitle">TIROTEO ESCOLAR</h3>
        </div>
    </nav>

    <div class="swiper mySwiper container">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="../../img/aguas_turbulentas.webp" alt="">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="box-container">

            <div class="box">
                <div class="imgbx">
                    <img src="../../img/brawlers.png">
                </div>
                <div class="content">
                    <div class="details">
                        <h2>Nombre Jugador</h2>
                    </div>
                </div>
            </div>

            <div class="box">
                <div class="imgbx">
                    <img src="../../img/brawlers.png">
                </div>
                <div class="content">
                    <div class="details">
                        <h2>Nombre Jugador</h2>
                    </div>
                </div>
            </div>
        
            <div class="box">
                <div class="imgbx">
                    <img src="../../img/brawlers.png">
                </div>
                <div class="content">
                    <div class="details">
                        <h2>Nombre Jugador</h2>
                    </div>
                </div>
            </div>

            <div class="box">
                <div class="imgbx">
                    <img src="../../img/brawlers.png">
                </div>
                <div class="content">
                    <div class="details">
                        <h2>Nombre Jugador</h2>
                    </div>
                </div>
            </div>
        </div> 
    </div>

    <div class="formulario">
        <h1>Nombre Jugador</h1>
        <form method="post"  action="controller/inicio.php" id="formulario">
            <div class="campos">
                <h4>Tipo de Arma</h4>
                <select name="id_usuario">
                <option value="">Seleccione Tipo de arma</option>
                </select>
            </div>
            <div class="campos">
                <h4>Arma</h4>
                <select name="id_usuario">
                <option value="">Seleccione Arma</option>
                </select>
            </div>
            <div class="campos">
                <h4>Objetivo</h4>
                <select name="id_usuario">
                <option value="">Seleccione jugador</option>
                </select>
            </div>
            <input type="submit" name="inicio" value="Atacar">
            <br><br>
        </form>
    </div>
</div>
             
        
</body>
</html>