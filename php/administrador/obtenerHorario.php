<?php
// Conexión a la base de datos
require '../login/conexion.php';
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$id = $_POST['id'];

$sql = "SELECT * FROM horarios WHERE id=$id";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    echo json_encode($data);
} else {
    echo json_encode([]);
}

$conexion->close();
?>
