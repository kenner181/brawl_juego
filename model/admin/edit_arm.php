<?php
//1
    session_start();
    require_once("../../conexion/conexion.php");
    $db = new Database();
    $con = $db->getConnection();
    

    $sql = $con -> prepare ("SELECT * FROM armas WHERE id_arma = '".$_GET['id_arma']."'");
    $sql -> execute();
    $usua =$sql -> fetch();
?>

<?php
//3
if(isset($_POST["update"]))
 {
    $nombre = $_POST['nombre'];
    $dano = $_POST['dano'];
    $nivel = $_POST['nivel'];

    $foto = $_FILES['foto']['name']; 
    $foto_temp = $_FILES['foto']['tmp_name'];
    $foto_destino = "../../img_bd/" . $foto;

    move_uploaded_file($foto_temp, $foto_destino);;

//4
    $insertSQL = $con -> prepare("UPDATE armas SET nombre_arma = '$nombre', dano ='$dano', imagen_arma ='$foto_destino', id_nivel ='$nivel' WHERE id_arma = '".$_GET['id_arma']."'");      
    $insertSQL->execute();
    echo '<script>alert ("Actualización exitosa.");</script>';
    echo '<script>window.location="armas.php"</script>';
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
    <title>Actualizar Arma</title>
</head>
<body>
    <div class="formulario">
        <h1>Actualizar Arma</h1>
        <form method="POST" name="formreg" autocomplete="off" enctype="multipart/form-data">
            <div class="campos">
            <label for="foto">Nombre Arma</label>
                <input type="text" name="nombre" value="<?php echo $usua['nombre_arma']?>" > 
            </div>
            <div class="campos">
            <label for="foto">Daño</label>
                <input type="text" name="dano" value="<?php echo $usua['dano']?>" > 
            </div>
            <div class="campos">
                <img src="<?php echo $usua['imagen_arma']?>" alt="Imagen del arma" style="max-width: 100px;">
            </div>
            <div class="campos">
                <input type="file" name="foto" accept="image/*">
            </div>
            <div class="campos">
                <label for="foto">Nivel del arma</label>
                <input type="text" name="nivel" value="<?php echo $usua['id_nivel']?>">
            </div>
            <br><br>
            <input type="submit" name="update" value="Actualizar">
        </form>
    </div>
</body>
</html>