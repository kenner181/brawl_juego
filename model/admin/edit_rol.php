<?php
//1
    session_start();
    require_once("../../conexion/conexion.php");
    $db = new Database();
    $con = $db->getConnection();
    

    $sql = $con -> prepare ("SELECT * FROM roles WHERE id_rol = '".$_GET['id_rol']."'");
    $sql -> execute();
    $usua =$sql -> fetch();
?>

<?php
//3
if(isset($_POST["update"]))
 {
    $rol = $_POST['rol'];
//4
    $insertSQL = $con -> prepare("UPDATE roles SET rol = '$rol' WHERE id_rol = '".$_GET['id_rol']."'");      
    $insertSQL->execute();
    echo '<script>alert ("Actualización exitosa.");</script>';
    echo '<script>window.location="roles.php"</script>';
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
    <title>Actualizar Roles</title>
</head>
<body>
    <div class="formulario">
        <h1>Actualizar Roles</h1>
        <form method="POST" name="formreg" autocomplete="off" enctype="multipart/form-data">
            <div class="campos">
                <input type="text" name="rol" value="<?php echo $usua['rol']?>" > 
            </div>   
            <br><br>
            <input type="submit" name="update" value="Actualizar">
        </form>
    </div>
</body>
</html>