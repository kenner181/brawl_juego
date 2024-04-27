<?php
session_start();
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    
    header("Location: ../../iniciar_sesion.php");
    exit; 
}
require_once("../../conexion/conexion.php");
$db = new Database();
$con = $db->getConnection();

$query = "SELECT * FROM usuarios WHERE id_avatar = :username";
$stmt = $con->prepare($query);
$stmt->bindParam(':username', $username);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Varela+Round&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/jugador.css">
    <title>Index Jugadores</title>
</head>
<body>
    
    <div class="contenedor">
        <header>
            <div class="perfil">
                <div class="avatar">
                    <img src="<?php echo $user['foto']; ?>" alt="Avatar" class="img_per">
                    <p>Nombre</p>
                </div>
                <div class="info" >
                    <p>Nivel: <span>1</span></p> 
                    <p>Puntos: <span>500</span></p>
                </div>
            </div>
             <div class="rango">
                <h4>Rango</h4>
                <div class="liga">
                    <img src="../../img/ranguito.png" alt="Rango" class="img_ran">
                </div>
            </div> 
        </header>

        <section class="contenido">
            <div class="content-wrapper">
                <div class="image-container">
                    <img src="../../img/bull.png" alt="Descripción de la imagen" class="imagen-dinamica">
                    <div class="button-container">
                        <button type="button" class="btn btn-primary diagonal"><a href="#">UNIRSE A PARTIDA</a></button>
                    </div>
                </div>
            </div>
        </section>

        <aside>
            <div class="menu">
                <h4>Opciones</h4>
                <ul>
                    <a href="mapas.php">
                        <li>    
                            <img src="../../img/mapas.jpg">
                            <p>Mapas</p>
                        </li>
                    </a>

                    <a href="personajes.php">
                        <li>
                                <img src="../../img/brawlers.png">
                                <p>Personajes</p>
                        </li>
                    </a>
                    <li>
                        <a href="armas.php">
                            <img src="../../img/armas.png">
                            <p>Armas</p>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
    </div>

</body>
</html>