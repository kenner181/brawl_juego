<?php

    session_start();
    require_once("../../conexion/conexion.php");
    $db = new Database();
    $con = $db->getConnection();

    $insertSQL = $con -> prepare("DELETE FROM usuarios WHERE id = '".$_GET['id']."'");      
    $insertSQL->execute();
    echo '<script>alert ("Registro eliminado exitosamente.");</script>';
    echo '<script>window.location="usuarios.php"</script>';
    ?>