<?php
//1
    session_start();
    require_once("../../conexion/conexion.php");
    $db = new Database();
    $con = $db->getConnection();
    

    $sql = $con -> prepare ("SELECT * FROM rango WHERE id_rango = '".$_GET['id_rango']."'");
    $sql -> execute();
    $usua =$sql -> fetch();
?>

<?php
//3
if(isset($_POST["update"]))
 {
    $rango = $_POST['rango'];

    $foto = $_FILES['foto']['name'];
    $foto_temp = $_FILES['foto']['tmp_name'];
    $foto_destino = "../../img_bd/" . $foto;

    move_uploaded_file($foto_temp, $foto_destino);
   
//4
    $insertSQL = $con -> prepare("UPDATE rango SET nombre_ran = '$rango', imagen_ran ='$foto_destino' WHERE id_rango = '".$_GET['id_rango']."'");      
    $insertSQL->execute();
    echo '<script>alert ("Actualización exitosa.");</script>';
    echo '<script>window.location="rango.php"</script>';
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
    <link rel="stylesheet" href="../../css/formulario.css">
    <title>Actualizar Rango</title>
</head>
<body>
    <div class="formulario">
        <h1>Actualizar Rango</h1>
        <form method="POST" name="formreg" autocomplete="off" enctype="multipart/form-data">
            <div class="campos">
                <input type="text" name="rango" value="<?php echo $usua['nombre_ran']?>" > 
            </div>
            <div class="campos">
                <img src="<?php echo $usua['imagen_ran']?>" alt="Imagen del arma" style="max-width: 100px;">
            </div>
            <div class="campos">
                <input type="file" name="foto" accept="image/*">
            </div>
            <br><br>
            <input type="submit" name="update" value="Actualizar">
        </form>
    </div>
</body>
</html>