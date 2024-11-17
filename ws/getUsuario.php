<?php
require_once 'db.php';
require_once __DIR__ . '/models/User.php';

$respuesta = ["exito" => false, "mensaje" => "", "datos" => null];

$baseDatos = new Database();
$db = $baseDatos->getConnection();

$usuario = new User();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'] ?? '';

    if ($id) {
        $usuario->id = $id;
        $datosUsuario = $usuario->get($db);
        if ($datosUsuario) {
            $respuesta["exito"] = true;
            $respuesta["mensaje"] = "Usuario obtenido correctamente.";
            $respuesta["datos"] = $datosUsuario;
        } else {
            $respuesta["mensaje"] = "Usuario con id $id no se encuentra en la bd.";
        }
    }
}

echo json_encode($respuesta);
?>
