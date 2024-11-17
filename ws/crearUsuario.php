<?php

require_once __DIR__ . '/models/User.php';

$respuesta = ["exito" => false, "mensaje" => "", "datos" => null];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $campos = ['nombre', 'apellidos', 'contraseña', 'telefono', 'email', 'sexo', 'fecha_nacimiento'];
    $datos = [];
    foreach ($campos as $campo) {
        $datos[$campo] = $_POST[$campo] ?? null;
    }

    $usuario = new User(...$datos);

    $jsonDatosUsuario = $usuario->toJson();
    if (file_put_contents('usuarios.txt', $jsonDatosUsuario . PHP_EOL, FILE_APPEND)) {
        $respuesta["exito"] = true;
        $respuesta["mensaje"] = "Usuario creado con éxito.";
        $respuesta["datos"] = json_decode($jsonDatosUsuario, true);
    } else {
        $respuesta["mensaje"] = "Error al crear el usuario.";
    }
}

echo json_encode($respuesta);
?>