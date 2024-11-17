<?php

require_once 'db.php';
require_once __DIR__ . '/models/User.php';

$respuesta = ["exito" => false, "mensaje" => "", "datos" => null];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_GET['id'] ?? '';
    $campos = ['nombre', 'apellidos', 'contraseña', 'telefono', 'email', 'sexo', 'fecha_nacimiento'];
    $datos = [];
    foreach ($campos as $campo) {
        $datos[$campo] = $_POST[$campo] ?? null;
    }

    if ($id) {
        $baseDatos = new BaseDatos();
        $db = $baseDatos->obtenerConexion();

        $usuario = new User();
        $usuario->id = $id;

        if ($usuario->obtener($db)) {
            foreach ($campos as $campo) {
                if (!is_null($datos[$campo])) {
                    $usuario->$campo = $datos[$campo];
                }
            }

            if ($usuario->actualizar($db)) {
                $respuesta["exito"] = true;
                $respuesta["mensaje"] = "Usuario actualizado correctamente.";
            } else {
                $respuesta["mensaje"] = "Error al actualizar el usuario.";
            }
        } else {
            $respuesta["mensaje"] = "Usuario con id $id no se encuentra en la bd.";
        }
    }
}

echo json_encode($respuesta);
?>
