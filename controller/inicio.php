<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "brawl_stars";

try {
    $conexion = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexion->exec("SET CHARACTER SET utf8");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["username"]) && isset($_POST["contrasena"])) {
            try {
                $username = $_POST["username"];
                $password = $_POST["contrasena"];

                // Consulta SQL para obtener el ID de usuario correspondiente al nombre de usuario proporcionado
                $sql = "SELECT id, contrasena, id_rol FROM usuarios WHERE username = :username";
                $stmt = $conexion->prepare($sql);
                $stmt->bindParam(":username", $username);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $id_usuario = $row["id"];
                    $ID_Roll = $row["id_rol"];
                    $stored_password = $row["contrasena"];

                    if (password_verify($password, $stored_password)) {
                        session_start();
                        $_SESSION["id_usuario"] = $id_usuario;
                        $_SESSION["id_rol"] = $ID_Roll;

                        switch ($ID_Roll) {
                            case 1:
                                header("Location: ../model/admin/index.php");
                                exit();
                            case 2:
                                header("Location: ../model/jugador/index.php");
                                exit();
                            case 3:
                                header("Location: index3.php");
                                exit();
                            default:
                                echo '<script>alert("Rol de usuario no definido.");</script>';
                                exit();
                        }
                    } else {
                        echo '<script>alert("Contraseña incorrecta.");</script>';
                        exit();
                    }
                } else {
                    echo '<script>alert("Nombre de usuario no encontrado.");</script>';
                    exit();
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo '<script>alert("Por favor, complete todos los campos.");</script>';
            exit();
        }
    }
} catch (PDOException $e) {
    echo "Error de conexión a la base de datos: " . $e->getMessage();
}
?>
