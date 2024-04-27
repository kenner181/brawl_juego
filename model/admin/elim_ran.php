<?php

    session_start();
    require_once("../../conexion/conexion.php");
    $db = new Database();
    $con = $db->getConnection();

    $insertSQL = $con -> prepare("DELETE FROM rango WHERE id_rango = '".$_GET['id_rango']."'");      
    $insertSQL->execute();
    echo '<script>alert ("Registro eliminado exitosamente.");</script>';
    echo '<script>window.location="rango.php"</script>';
    ?>