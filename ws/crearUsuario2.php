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

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$contraseña = $_POST['contraseña'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$sexo = $_POST['sexo'];

$sql = "INSERT INTO alumno (nombre, apellidos, contraseña, telefono, email, fecha_nacimiento, sexo) VALUES ('$nombre', '$apellidos', '$contraseña', '$telefono', '$email', '$fecha_nacimiento', '$sexo')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true, 'message' => 'Usuario creado con éxito']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $sql . '<br>' . $conn->error]);
}

$conn->close();
?>
