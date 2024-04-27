<?php
//1
    session_start();
    require_once("../../conexion/conexion.php");
    $db = new Database();
    $con = $db->getConnection();
    

    $sql = $con -> prepare ("SELECT * FROM usuarios, avatar WHERE id = '".$_GET['id']."'");
    $sql -> execute();
    $usua =$sql -> fetch();
?>

<?php
//3
if(isset($_POST["update"]))
 {
    $username = $_POST['username'];
    $correo = $_POST['correo'];
    $avatar = $_POST['avatar'];

//4
    $insertSQL = $con -> prepare("UPDATE usuarios SET username = '$username', correo ='$correo', id_avatar ='$avatar' WHERE id = '".$_GET['id']."'");      
    $insertSQL->execute();
    echo '<script>alert ("Actualización exitosa.");</script>';
    echo '<script>window.location="usuarios.php"</script>';
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
    <title>Actualizar Usuario</title>
</head>
<body>
    <div class="formulario">
        <h1>Actualizar Usuario</h1>
        <form method="POST" name="formreg" autocomplete="off" enctype="multipart/form-data">
            <div class="campos">
                <input type="text" name="username" value="<?php echo $usua['username']?>" > 
            </div>
            <div class="campos">
                <input type="text" name="correo" value="<?php echo $usua['correo']?>" > 
            </div>
            <div class="campos">
            <select class="form-control" name="avatar">
            <option value="<?php echo $usua['id_avatar']?>"><?php echo $usua['nombre']?></option>
                    <?php
                    $control = $con->prepare("SELECT * FROM avatar");
                    $control->execute();
                    while ($fila = $control->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $fila['id_avatar'] . "'>" . $fila['nombre'] . "</option>";
                    }
                    ?>

                </select>
            </div>
            
            <br><br>
            <input type="submit" name="update" value="Actualizar">
        </form>
    </div>
</body>
</html>