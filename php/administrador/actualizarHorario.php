<?php
// Conexión a la base de datos
require '../login/conexion.php';
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$id = $_POST['id'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$especialidad = $_POST['especialidad'];
$medico = $_POST['medico']; // Esto es el número de identificación

$sql = "UPDATE horarios SET fecha='$fecha', hora='$hora', especialidad='$especialidad', medico='$medico' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Horario actualizado exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

header("Location: gestionHorarios.php");
exit();
?>
