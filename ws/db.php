<?php
class BaseDatos {
    private $host = 'localhost';
    private $db_name = 'colegio';
    private $user = 'root';
    private $contraseña = '';
    public $conexion;

    public function obtenerConexion() {
        $this->conexion = null;
        try {
            $this->conexion = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->user, $this->contraseña);
            $this->conexion->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
        return $this->conexion;
    }
}
?>