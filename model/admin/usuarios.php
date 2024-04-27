<?php
session_start();
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    
    header("Location: ../../iniciar_sesion.php");
    exit; 
}
require_once("../../conexion/conexion.php");
$db = new Database();
$con = $db->getConnection();

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formreg")) {
	$username = $_POST['usuario'];
	$contrasena = $_POST['contrasena'];
	$correo = $_POST['correo'];
	$id_avatar = $_POST['avatar'];
	$puntaje = 0;
	$vida = 100;
	$id_estado = 1;
	$id_rol = 2;
	$id_nivel = 1;



	$sql = $con->prepare("SELECT * FROM usuarios where username='$username'");
	$sql->execute();
	$fila = $sql->fetchAll(PDO::FETCH_ASSOC);



	if ($username == "" || $contrasena == "" || $correo == "" || $id_avatar == "") {
		echo '<script>alert ("Completa el formulario"); </script>';
		echo '<script>window.location="registrarse.php"</script>';
	} else if ($fila) {
		echo '<script>alert ("USUARIO YA REGISTRADO"); </script>';
		echo '<script>window.location="usuarios.php"</script>';
	} else {
		$password = password_hash($contrasena, PASSWORD_DEFAULT, array("pass" => 12));
		$insertSQL = $con->prepare("INSERT INTO usuarios(username,contrasena,correo,puntaje,vida,id_estado,id_rol,id_nivel,id_avatar) 
	  VALUES ('$username','$password', '$correo', '$puntaje', '$vida', '$id_estado', '$id_rol','$id_nivel','$id_avatar')");
		$insertSQL->execute();
		echo '<script>alert ("Usuario Creado con Exito"); </script>';
		echo '<script>window.location="usuarios.php"</script>';
	}
}




// Preparar y ejecutar la consulta SQL para mostrar en tabla
$query = $con->prepare("SELECT usuarios.username, usuarios.correo, roles.rol, estado.estado 
    FROM usuarios 
    JOIN roles ON usuarios.id_rol = roles.id_rol 
    JOIN estado ON usuarios.id_estado = estado.id_estado;
    ");
$query->execute();
$resultados = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/1057b0ffdd.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include("nav.php") ?>
    <div class="container-fluid row">
        <form class="col-4 p-3" method="post" enctype="multipart/form-data">
            <h3 class="text-center text-secondary">Registrar Jugador</h3>
            <div class="mb-3">
                <label for="usuario" class="form-label">Nombre de Usuario</label>
                <input type="text" class="form-control" name="usuario" id="usuario">

            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input type="email" class="form-control" name="correo" id="exampleInputEmail1">

            </div>
            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña</label>
                <input type="password" name="contrasena" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
            <label for="avatar" class="form-label">Avatar</label>
                <select class="form-control" name="avatar">
                    <?php
                    $control = $con->prepare("SELECT * FROM avatar");
                    $control->execute();
                    while ($fila = $control->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $fila['id_avatar'] . "'>" . $fila['nombre'] . "</option>";
                    }
                    ?>

                </select>
            </div>
            

            <input type="submit" class="btn btn-primary" name="validar" value="Registrar">
            <input type="hidden" name="MM_insert" value="formreg">
        </form>

        <div class="col-8 p-4">
            <table class="table">
                <thead class="bg-info">
                    <tr>
                        <th scope="col">Usuario</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Avatar</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Nivel</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    // Consulta de armas
                    $consulta = "SELECT * FROM usuarios, avatar, roles, estado WHERE usuarios.id_avatar = avatar.id_avatar AND usuarios.id_rol = roles.id_rol AND usuarios.id_estado = estado.id_estado ";
                    $resultado = $con->query($consulta);

                    while ($fila = $resultado->fetch()) {
                    ?>
                        <tr>
                            <td><?php echo $fila["username"]; ?></td>
                            <td><?php echo $fila["correo"]; ?></td>
                            <td><img src="<?php echo $fila["foto"]; ?>" alt="Avatar" style="max-width: 100px;"></td>
                            <td><?php echo $fila["rol"]; ?></td>
                            <td><?php echo $fila["id_nivel"]; ?></td>
                            <td><?php echo $fila["estado"]; ?></td>
                            <td>
                                <div class="text-center">
                                    <div class="d-flex justify-content-start">
                                        <a href="edit_usu.php?id=<?php echo $fila["id"]; ?>" class="btn btn-primary btn-sm me-2"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="elim_usu.php?id=<?php echo $fila["id"]; ?>" class="btn btn-danger btn-sm"><i class="fa-solid fa-user-xmark"></i></a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>