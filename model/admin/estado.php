<?php
session_start();
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    
    header("Location: ../../iniciar_sesion.php");
    exit; 
}
require_once("../../conexion/conexion.php");
$db = new Database();
$con = $db->getConnection();

$query = $con->prepare("SELECT id_estado,estado FROM estado");
$query->execute();
$resultados = $query->fetchAll(PDO::FETCH_ASSOC);

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formreg")){

    $estado = $_POST['estado'];
    

    $sql = $con->prepare("SELECT * FROM estado where estado='$estado'");
	$sql->execute();
	$fila = $sql->fetchAll(PDO::FETCH_ASSOC);

    if ($estado == "") {
		echo '<script>alert ("Datos Vacios"); </script>';
		echo '<script>window.location="estado.php"</script>';
	} else if ($fila) {
		echo '<script>alert ("NIVEL YA REGISTRADO"); </script>';
		echo '<script>window.location="estado.php"</script>';
	} else {
		
		$insertSQL = $con->prepare("INSERT INTO estado (estado) 
	  VALUES ('$estado')");
		$insertSQL->execute();
		echo '<script>window.location="estado.php"</script>';
	}

};
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/1057b0ffdd.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include("nav.php") ?>
    <div class="container-fluid row">
        <form class="col-4 p-3" method="post">
            <h3 class="text-center text-secondary">Registrar Estados</h3>
            <div class="mb-3">
                <label for="usuario" class="form-label">Estado</label>
                <input type="text" class="form-control" name="estado" >

            </div>

            <input type="submit" class="btn btn-primary" name="validar" value="Registrar">
            <input type="hidden" name="MM_insert" value="formreg">
        </form>
        
        <div class="col-8 p-4">
            <table class="table">
                <thead class="bg-info">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Estados</th>
                        <th scope="col"> </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultados as $fila) : ?>
                        <tr>
                            <td><?php echo $fila['id_estado']; ?></td>
                            <td><?php echo $fila['estado']; ?></td>

                            <td>
                                <a href="" class="btn btn-small btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="" class="btn btn-small btn-danger"><i class="fa-solid fa-user-xmark"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>




    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>