<?php
session_start();
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    
    header("Location: ../../iniciar_sesion.php");
    exit; 
}
require_once("../../conexion/conexion.php");
$db = new Database();
$con = $db->getConnection();

$query = $con->prepare("SELECT * FROM tip_arma");
$query->execute();
$resultados = $query->fetchAll(PDO::FETCH_ASSOC);

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formreg")){

    $tip_arm = $_POST['tip_arm'];

    $sql = $con->prepare("SELECT * FROM tip_arma WHERE tip_arm ='$tip_arm'");
	$sql->execute();
	$fila = $sql->fetchAll(PDO::FETCH_ASSOC);

    if ($tip_arm == "") {
		echo '<script>alert ("Datos Vacios"); </script>';
		echo '<script>window.location="tip_armas.php"</script>';
	} else if ($fila) {
		echo '<script>alert ("RANGO YA REGISTRADA"); </script>';
		echo '<script>window.location="tip_armas.php"</script>';
	} else {
		
		$insertSQL = $con->prepare("INSERT INTO tip_arma (tip_arm) 
	    VALUES ('$tip_arm')");
		$insertSQL->execute();
        echo '<script>alert ("REGISTRO EXITOSO"); </script>';
		echo '<script>window.location="tip_armas.php"</script>';
	}

};
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rango</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/1057b0ffdd.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include("nav.php") ?>
    <div class="container-fluid row">
        <form class="col-4 p-3" method="post" enctype="multipart/form-data">
            <h3 class="text-center text-secondary">Registrar Tipos de armas</h3>
            <div class="mb-3">
                <label for="tip_arm" class="form-label">Tipo de arma</label>
                <input type="text" class="form-control" name="tip_arm">
            </div>
            <input type="submit" class="btn btn-primary" name="validar" value="Registrarse">
            <input type="hidden" name="MM_insert" value="formreg">
        </form>
        
        <div class="col-8 p-4">
            <table class="table">
                <thead class="bg-info">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tipo de arma</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <?php
                    // Consulta de armas
                    $consulta = "SELECT * FROM tip_arma ";
                    $resultado = $con->query($consulta);

                    while ($fila = $resultado->fetch()) {
                    ?>
                        <tr>
                            <td><?php echo $fila["id_tip_arm"]; ?></td>
                            <td><?php echo $fila["tip_arm"]; ?></td>
                            <td>
                                <div class="text-center">
                                    <div class="d-flex justify-content-start">
                                        <a href="edit_tip_arm.php?id_tip_arm=<?php echo $fila["id_tip_arm"]; ?>" class="btn btn-primary btn-sm me-2"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="elim_tip_arm.php?id_tip_arm=<?php echo $fila["id_tip_arm"]; ?>" class="btn btn-danger btn-sm"><i class="fa-solid fa-user-xmark"></i></a>
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