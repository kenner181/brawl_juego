<?php

    session_start();
    require_once("../../conexion/conexion.php");
    $db = new Database();
    $con = $db->getConnection();

    $insertSQL = $con -> prepare("DELETE FROM mundos WHERE id_mundo = '".$_GET['id_mundo']."'");      
    $insertSQL->execute();
    echo '<script>alert ("Registro eliminado exitosamente.");</script>';
    echo '<script>window.location="mundos.php"</script>';
    ?>