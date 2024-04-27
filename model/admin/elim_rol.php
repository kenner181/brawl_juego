<?php

    session_start();
    require_once("../../conexion/conexion.php");
    $db = new Database();
    $con = $db->getConnection();

    $insertSQL = $con -> prepare("DELETE FROM roles WHERE id_rol = '".$_GET['id_rol']."'");      
    $insertSQL->execute();
    echo '<script>alert ("Registro eliminado exitosamente.");</script>';
    echo '<script>window.location="roles.php"</script>';
    ?>