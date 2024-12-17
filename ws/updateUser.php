<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "colegio";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]));
}

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id'], $data['nombre'], $data['apellidos'], $data['telefono'], $data['email'], $data['sexo'])) {
    $id = $data['id'];
    $nombre = $data['nombre'];
    $apellidos = $data['apellidos'];
    $contraseña = $data['contraseña'] ?? null;
    $telefono = $data['telefono'];
    $email = $data['email'];
    $fecha_nacimiento = $data['fecha_nacimiento'] ?? null;
    $sexo = $data['sexo'];

    $sql = "UPDATE alumno SET nombre='$nombre', apellidos='$apellidos', telefono='$telefono', email='$email', sexo='$sexo'";
    if ($contraseña) {
        $sql .= ", contraseña='$contraseña'";
    }
    if ($fecha_nacimiento) {
        $sql .= ", fecha_nacimiento='$fecha_nacimiento'";
    }
    $sql .= " WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true, 'message' => 'Usuario actualizado con éxito']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
}

$conn->close();
?>
