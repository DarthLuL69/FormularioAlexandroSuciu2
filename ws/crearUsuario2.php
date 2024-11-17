<?php

require_once 'db.php';
require_once __DIR__ . '/models/User.php';

$respuesta = ["exito" => false, "mensaje" => "", "datos" => null];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $campos = ['nombre', 'apellidos', 'contraseña', 'telefono', 'email', 'sexo', 'fecha_nacimiento'];
    $datos = [];
    foreach ($campos as $campo) {
        $datos[$campo] = $_POST[$campo] ?? null;
    }

    $baseDatos = new Database();
    $db = $baseDatos->getConnection();

    $usuario = new User(...$datos);

    if ($usuario->create($db)) {
        $respuesta["exito"] = true;
        $respuesta["mensaje"] = "Usuario creado con éxito.";
        $respuesta["datos"] = json_decode($usuario->toJson(), true);
    } else {
        $respuesta["mensaje"] = "Error al crear el usuario.";
    }
}

echo json_encode($respuesta);
?>
