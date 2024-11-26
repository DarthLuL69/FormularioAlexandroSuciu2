<?php
require_once 'db.php';
require_once __DIR__ . '/models/User.php';

$respuesta = ["exito" => false, "mensaje" => "", "datos" => null];

$baseDatos = new BaseDatos();
$db = $baseDatos->obtenerConexion();

$usuario = new User();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'] ?? '';

    if ($id) {
        $usuario->id = $id;
        $datosUsuario = $usuario->obtener($db);
        if ($datosUsuario) {
            $respuesta["exito"] = true;
            $respuesta["mensaje"] = "Usuario obtenido correctamente.";
            $respuesta["datos"] = $datosUsuario;
        } else {
            $respuesta["mensaje"] = "Usuario con id $id no se encuentra en la bd.";
        }
    } else {
        $datosUsuarios = $usuario->getAll($db);
        if ($datosUsuarios) {
            $respuesta["exito"] = true;
            $respuesta["mensaje"] = "Usuarios obtenidos correctamente.";
            $respuesta["datos"] = $datosUsuarios;
        } else {
            $respuesta["mensaje"] = "No se encontraron usuarios.";
        }
    }
}

echo json_encode($respuesta);
?>
