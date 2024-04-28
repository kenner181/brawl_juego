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

// Función para determinar el id_rango basado en el puntaje
function determinarRango($puntaje) {
    if ($puntaje <= 500) {
        return 1;
    } elseif ($puntaje > 500 && $puntaje <= 750) {
        return 2;
    } elseif ($puntaje > 750 && $puntaje <= 1000) {
        return 3;
    } else {
        return 4;
    }
}

$query = "SELECT usuarios.username, avatar.foto AS avatar, usuarios.puntaje, usuarios.id_rango, rango.nombre AS nombre_rango, rango.foto AS foto_rango,
          avatar.personaje AS foto_personaje, usuarios.id_nivel
          FROM usuarios
          INNER JOIN rango ON usuarios.id_rango = rango.id_rango
          INNER JOIN avatar ON usuarios.id_avatar = avatar.id_avatar
          WHERE usuarios.id = :id_usuario";
$stmt = $con->prepare($query);
$stmt->bindParam(':id_usuario', $_SESSION['id_usuario']);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Determinar el nuevo id_rango
$nuevo_id_rango = determinarRango($user['puntaje']);

// Actualizar el id_rango si es diferente al actual
if ($nuevo_id_rango != $user['id_rango']) {
    $query_update_rango = "UPDATE usuarios SET id_rango = :id_rango WHERE id = :id_usuario";
    $stmt_update_rango = $con->prepare($query_update_rango);
    $stmt_update_rango->bindParam(':id_rango', $nuevo_id_rango);
    $stmt_update_rango->bindParam(':id_usuario', $_SESSION['id_usuario']);
    $stmt_update_rango->execute();
}

// Obtener los datos actualizados del usuario
$query_actualizado = "SELECT usuarios.username, usuarios.puntaje, avatar.foto AS avatar, rango.nombre AS nombre_rango, rango.foto AS foto_rango,
                      avatar.personaje AS foto_personaje, usuarios.id_nivel
                      FROM usuarios
                      INNER JOIN rango ON usuarios.id_rango = rango.id_rango
                      INNER JOIN avatar ON usuarios.id_avatar = avatar.id_avatar
                      WHERE usuarios.id = :id_usuario";
$stmt_actualizado = $con->prepare($query_actualizado);
$stmt_actualizado->bindParam(':id_usuario', $_SESSION['id_usuario']);
$stmt_actualizado->execute();
$user_actualizado = $stmt_actualizado->fetch(PDO::FETCH_ASSOC);

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
                    <img src="<?php echo $user_actualizado['avatar']; ?>" alt="Avatar" class="img_per">
                    <p><?php echo $user_actualizado['username']; ?></p>
                </div>
                <div class="info"> 
                        <p>Nivel: <span><?php echo $user_actualizado['id_nivel']; ?></span></p> 
                        <p>puntaje: <span><?php echo $user_actualizado['puntaje']; ?></span></p>
                </div> 
            </div>
            <div class="rango">
                <h4><?php echo $user_actualizado['nombre_rango']; ?></h4>
                <div class="liga">
                    <img src="<?php echo $user_actualizado['foto_rango']; ?>" alt="Rango" class="img_ran">
                </div>
            </div>
        </header>

        <section class="contenido">
            <div class="content-wrapper">
                <div class="image-container">
                    <img src="<?php echo $user_actualizado['foto_personaje']; ?>" alt="Descripción de la imagen" class="imagen-dinamica">
                    <div class="button-container">
                        <a href="mapas.php" class="btn btn-primary diagonal">UNIRSE A PARTIDA</a>
                    </div>
                </div>
            </div>
        </section>

        <aside>
        <div class="info" >
                </div>
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
