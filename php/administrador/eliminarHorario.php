<?php
// Conexión a la base de datos
require '../login/conexion.php';
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$id = $_GET['id'];

$sql = "DELETE FROM horarios WHERE id=$id";

if ($conexion->query($sql) === TRUE) {
    echo "Horario eliminado exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conexion->error;
}

$conexion->close();

header("Location: gestionHorarios.php");
exit();
?>
