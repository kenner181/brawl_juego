<?php
//1
    session_start();
    require_once("../../conexion/conexion.php");
    $db = new Database();
    $con = $db->getConnection();
    

    $sql = $con -> prepare ("SELECT * FROM avatar WHERE id_avatar = '".$_GET['id_avatar']."'");
    $sql -> execute();
    $usua =$sql -> fetch();
?>

<?php
//3
if(isset($_POST["update"]))
 {
    $username = $_POST['username'];

    
    $foto = $_FILES['foto']['name'];
    $foto_temp = $_FILES['foto']['tmp_name'];
    $foto_destino = "../../img_bd/" . $foto;

    $foto_personaje = $_FILES['personaje']['name'];
    $foto_temp_personaje = $_FILES['personaje']['tmp_name'];
    $foto_destino_personaje = "../../img_bd/" . $foto_personaje;


    move_uploaded_file($foto_temp, $foto_destino);
    move_uploaded_file($foto_temp_personaje, $foto_destino_personaje);


//4
    $insertSQL = $con -> prepare("UPDATE avatar SET nombre = '$username', foto ='$foto_destino', personaje ='$foto_destino_personaje' WHERE id_avatar = '".$_GET['id_avatar']."'");      
    $insertSQL->execute();
    echo '<script>alert ("Actualización exitosa.");</script>';
    echo '<script>window.location="avatar.php"</script>';
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
    <title>Actualizar Avatar</title>
</head>
<body>
    <div class="formulario">
        <h1>Actualizar Avatar</h1>
        <form method="POST" name="formreg" autocomplete="off" enctype="multipart/form-data">
            <div class="campos">
                <input type="text" name="username" value="<?php echo $usua['nombre']?>" > 
            </div>
            <div class="campos">
                <img src="<?php echo $usua['foto']?>" alt="Imagen del arma" style="max-width: 100px;">
            </div>
            <div class="campos">
                <input type="file" name="foto" accept="image/*">
            </div>
            <div class="campos">
                <img src="<?php echo $usua['personaje']?>" alt="Imagen del arma" style="max-width: 100px;">
            </div>
            <div class="campos">
                <input type="file" name="personaje" accept="image/*">
            </div>
            
            
            <br><br>
            <input type="submit" name="update" value="Actualizar">
        </form>
    </div>
</body>
</html>