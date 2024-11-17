<?php

require_once __DIR__ . '/models/User.php';

$resultado = ["exito" => false, "mensaje" => "", "datos" => null];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $campos = ['nombre', 'apellidos', 'contraseña', 'telefono', 'email', 'sexo', 'fecha_nacimiento'];
    $datosUsuario = [];
    foreach ($campos as $campo) {
        $datosUsuario[$campo] = $_POST[$campo] ?? null;
    }

    $usuario = new User(...$datosUsuario);

    $jsonUsuario = $usuario->aJson();
    if (file_put_contents('usuarios.txt', $jsonUsuario . PHP_EOL, FILE_APPEND)) {
        $resultado["exito"] = true;
        $resultado["mensaje"] = "Usuario creado con éxito.";
        $resultado["datos"] = json_decode($jsonUsuario, true);
    } else {
        $resultado["mensaje"] = "Error al crear el usuario.";
    }
}

echo json_encode($resultado);
?>