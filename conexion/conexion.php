<?php
class Database {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "brawl_stars";
    private $con;

    public function __construct() {
        try {
            $this->con = new PDO("mysql:host={$this->servername};dbname={$this->database}", $this->username, $this->password);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->con;
    }
}
?>
