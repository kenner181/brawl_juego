<?php

    session_start();
    require_once("../../conexion/conexion.php");
    $db = new Database();
    $con = $db->getConnection();

    $insertSQL = $con -> prepare("DELETE FROM estado WHERE id_estado = '".$_GET['id_estado']."'");      
    $insertSQL->execute();
    echo '<script>alert ("Registro eliminado exitosamente.");</script>';
    echo '<script>window.location="estado.php"</script>';
    ?>