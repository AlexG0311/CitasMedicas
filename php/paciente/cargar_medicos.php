<?php
// Conexión a la base de datos
include('../login/conexion.php');

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener la especialidad seleccionada desde la solicitud GET
$especialidad = $_GET['especialidad'];

// Consulta SQL para obtener los nombres de los doctores con la especialidad seleccionada
$sql = "SELECT nombre FROM medico WHERE especialidad = $especialidad";

$resultado = $conexion->query($sql);

// Construir las opciones para el combo box de doctores
$options = "";
while ($fila = $resultado->fetch_assoc()) {
    $options .= "<option value='" . $fila['nombre'] . "'>" . $fila['nombre'] . "</option>";
}

// Cerrar la conexión
$conexion->close();

// Devolver las opciones al cliente
echo $options;
?>
