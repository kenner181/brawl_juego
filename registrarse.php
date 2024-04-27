<?php

require_once("conexion/conexion.php");
// Crear una instancia de la clase Database
$database = new Database();

// Obtener la conexión PDO
$con = $database->getConnection();
?>

<?php
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
		echo '<script>window.location="usuario.php"</script>';
	} else {
		$password = password_hash($contrasena, PASSWORD_DEFAULT, array("pass" => 12));
		$insertSQL = $con->prepare("INSERT INTO usuarios(username,contrasena,correo,puntaje,vida,id_estado,id_rol,id_nivel,id_avatar) 
	  VALUES ('$username','$password', '$correo', '$puntaje', '$vida', '$id_estado', '$id_rol','$id_nivel','$id_avatar')");
		$insertSQL->execute();
		echo '<script>alert ("Usuario Creado con Exito"); </script>';
		echo '<script>window.location="iniciar_sesion.php"</script>';
	}
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Varela+Round&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/ini.css">
	<title>Inicio Sesión</title>
</head>

<body>
	<div class="formulario">
		<h1>Registrate</h1>
		<form method="post" action="" id="formulario" enctype="multipart/form-data">
			<div class="campos">
				<input type="text" name="usuario" id="usuario">
				<label>Usuario</label>
			</div>
			<div class="campos">
				<input type="email" name="correo" id="corre">
				<label>Correo</label>
			</div>
			<div class="campos">
				<input type="password" name="contrasena" id="contrasena">
				<label>Contraseña</label>
			</div>
			<div class="campos">
				<select name="avatar" id="avatarSelect">
					<?php
					$control = $con->prepare("SELECT id_avatar, foto FROM avatar");
					$control->execute();
					while ($fila = $control->fetch(PDO::FETCH_ASSOC)) {
						echo "<option value='" . $fila['id_avatar'] . "'>" . "<img src='" . $fila['foto'] . "' alt='Avatar'>" . "</option>";
					}
					?>
				</select>
			</div>
			<input type="submit" name="validar" value="Registrarse">
			<input type="hidden" name="MM_insert" value="formreg">
			<br><br>
		</form>
	</div>
</body>

</html>