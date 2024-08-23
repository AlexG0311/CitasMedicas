<?php
// Conexión a la base de datos
require '../login/conexion.php';
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$especialidad = $_POST['especialidad'];
$medico = $_POST['medico']; // Esto es el número de identificación

$sql = "INSERT INTO horarios (fecha, hora, especialidad, medico) VALUES ('$fecha', '$hora', '$especialidad', '$medico')";

if ($conexion->query($sql) === TRUE) {
    echo "Horario guardado exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conexion->error;
}

$conexion->close();

header("Location: gestionHorarios.php");
exit();
?>
