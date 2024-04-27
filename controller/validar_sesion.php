<?php
session_start();
if (!isset($_SESSION['id'])) {
    echo '
 <script>
        alert("Por favor inicie sesión e intente nuevamente");
        window.location = "../iniciar_sesion.php";
    </script>
    ';
    
}
?>