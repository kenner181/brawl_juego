<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "brawl_stars";

try {
    $conexion = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Establecer el modo de error PDO en excepción
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Establecer el conjunto de caracteres a UTF-8
    $conexion->exec("SET CHARACTER SET utf8");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verificar si se enviaron ambos campos: correo y contraseña
        if (isset($_POST["username"]) && isset($_POST["contrasena"])) {
            try {
                // Escapar los valores para evitar inyección SQL
                $ID = $_POST["username"];
                $password = $_POST["contrasena"];
                $pass = password_hash($password, PASSWORD_DEFAULT);


                // Consulta SQL para obtener el tipo de usuario
                $sql = "SELECT username, contrasena, id_rol FROM usuarios WHERE username = :username";
                $stmt = $conexion->prepare($sql);
                $stmt->bindParam(":username", $ID);
                
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    // Obtener el tipo de usuario
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $ID_Roll = $row["id_rol"];

                    // Iniciar sesión y guardar el ID de usuario y el tipo de usuario en variables de sesión
                    session_start();
                    $_SESSION["username"] = $ID;
                    $_SESSION["id_rol"] = $ID_Roll;

                    // Redireccionar según el tipo de usuario
                    switch ($ID_Roll) {
                        case 1:
                            header("Location: ../model/admin/index.php");
                            exit();
                        case 2:
                            header("Location: index2.php");
                            exit();
                        case 3:
                            header("Location: index3.php");
                            exit();
                        default:
                            // Manejar el caso en que el tipo de usuario no está definido
                            echo '<script>alert("ID o contraseña incorrectos.");</script>';
                            exit();
                    }
                } else {
                    // Manejar el caso en que no se encontró ningún usuario
                    echo '<script>alert("ID o contraseña incorrectos.");</script>';
                    exit();
                }
            } catch (PDOException $e) {
                // Manejar cualquier error de base de datos
                echo "Error: " . $e->getMessage();
            }
        } else {
            // Manejar el caso en que no se enviaron ambos campos
            echo '<script>alert("No se puede iniciar sesión sin enviar datos.");</script>';
            exit();
        }
    }
} catch (PDOException $e) {
    echo "Error de conexión a la base de datos: " . $e->getMessage();
}