<?php
require_once 'db.php';
require_once __DIR__ . '/models/User.php';

$respuesta = ["exito" => false, "mensaje" => "", "datos" => null];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'] ?? '';

    if ($id) {
        $baseDatos = new BaseDatos();
        $db = $baseDatos->obtenerConexion();

        $usuario = new User();
        $usuario->id = $id;

        if ($usuario->eliminar($db)) {
            $respuesta["exito"] = true;
            $respuesta["mensaje"] = "Usuario eliminado correctamente.";
        } else {
            $respuesta["mensaje"] = "Usuario con id $id no se encuentra en la bd.";
        }
    }
}

echo json_encode($respuesta);
?>
