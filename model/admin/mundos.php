<?php
session_start();
require_once("../../conexion/conexion.php");
$db = new Database();
$con = $db->getConnection();


$query = $con->prepare("SELECT mundos.nombre_mundo,mundos.foto FROM mundos");
$query->execute();
$resultados = $query->fetchAll(PDO::FETCH_ASSOC);

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formreg")) {

    $nombre = $_POST['nombre'];

    $foto = $_FILES['foto']['name']; 
    $foto_temp = $_FILES['foto']['tmp_name'];
    $foto_destino = "../../img_bd/" . $foto;

    move_uploaded_file($foto_temp, $foto_destino);

    $sql = $con->prepare("SELECT * FROM mundos where nombre_mundo='$nombre'");
    $sql->execute();
    $fila = $sql->fetchAll(PDO::FETCH_ASSOC);

    if ($nombre == "" || $foto_destino == "") {
        echo '<script>alert ("Datos Vacios"); </script>';
        echo '<script>window.location="mundos.php"</script>';
    } else if ($fila) {
        echo '<script>alert ("MUNDO YA REGISTRADO"); </script>';
        echo '<script>window.location="mundos.php"</script>';
    } else {

        $insertSQL = $con->prepare("INSERT INTO mundos (nombre_mundo,foto) 
	    VALUES ('$nombre','$foto_destino')");
        $insertSQL->execute();
        echo '<script>window.location="mundos.php"</script>';
    }
};



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mundos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/1057b0ffdd.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include("nav.php") ?>
    <div class="container-fluid row">
        <form class="col-4 p-3" method="post" enctype="multipart/form-data">
            <h3 class="text-center text-secondary">Registrar Avatar</h3>
            <div class="mb-3">
                <label for="usuario" class="form-label">Mundo</label>
                <input type="text" class="form-control" name="nombre">

            </div>
            <div class=" mb-3">
                <label for="foto" class="form-label">Imagen</label>
                <input type="file" class="form-control" name="foto">

            </div>
            <input type="submit" class="btn btn-primary" name="validar" value="Registrarse">
            <input type="hidden" name="MM_insert" value="formreg">
        </form>
        <div class="col-8 p-4">
            <table class="table">
                <thead class="bg-info">
                    <tr>
                        <th scope="col">Mundo</th>
                        <th scope="col">Foto</th>
                        <th scope="col"> </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultados as $fila) : ?>
                        <tr>
                            <td><?php echo $fila['nombre_mundo']; ?></td>
                            <td><img src="<?php echo $fila['foto']; ?>" alt="Foto del Mundo" style="max-width: 100px;"></td>


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