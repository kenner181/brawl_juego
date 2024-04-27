<?php
//1
    session_start();
    require_once("../../conexion/conexion.php");
    $db = new Database();
    $con = $db->getConnection();
    

    $sql = $con -> prepare ("SELECT * FROM estado WHERE id_estado = '".$_GET['id_estado']."'");
    $sql -> execute();
    $usua =$sql -> fetch();
?>

<?php
//3
if(isset($_POST["update"]))
 {
    $estado = $_POST['estado'];
//4
    $insertSQL = $con -> prepare("UPDATE estado SET estado = '$estado' WHERE id_estado = '".$_GET['id_estado']."'");      
    $insertSQL->execute();
    echo '<script>alert ("Actualización exitosa.");</script>';
    echo '<script>window.location="estado.php"</script>';
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
    <title>Actualizar Estado</title>
</head>
<body>
    <div class="formulario">
        <h1>Actualizar Estado</h1>
        <form method="POST" name="formreg" autocomplete="off" enctype="multipart/form-data">
            <div class="campos">
                <input type="text" name="estado" value="<?php echo $usua['estado']?>" > 
            </div>   
            <br><br>
            <input type="submit" name="update" value="Actualizar">
        </form>
    </div>
</body>
</html>