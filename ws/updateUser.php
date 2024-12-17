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

$id = $_GET['id'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$contraseña = $_POST['contraseña'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$sexo = $_POST['sexo'];

$sql = "UPDATE alumno SET nombre='$nombre', apellidos='$apellidos', contraseña='$contraseña', telefono='$telefono', email='$email', fecha_nacimiento='$fecha_nacimiento', sexo='$sexo' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true, 'message' => 'Usuario actualizado con éxito']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $sql . '<br>' . $conn->error]);
}

$conn->close();
?>
