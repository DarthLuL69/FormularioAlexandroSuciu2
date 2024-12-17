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
$sql = "DELETE FROM alumno WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true, 'message' => 'Usuario eliminado con éxito']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $sql . '<br>' . $conn->error]);
}

$conn->close();
?>
