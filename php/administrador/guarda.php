<?php
include("../login/conexion.php");

$nombre = $conexion->real_escape_string($_POST['nombre']);
$apellidos = $conexion->real_escape_string($_POST['apellidos']);
$tipo_ide = $conexion->real_escape_string($_POST['tipo_identificacion']);
$num_ide = $conexion->real_escape_string($_POST['cedula']);
$direccion = $conexion->real_escape_string($_POST['direccion']);
$Fecha = $conexion->real_escape_string($_POST['fechanac']);
$rol = $conexion->real_escape_string($_POST['rol']);
$especialidad = $conexion->real_escape_string($_POST['especialidad']);
$correo = $conexion->real_escape_string($_POST['correo']);
$Contraseña = $conexion->real_escape_string($_POST['contraseña']);

// Encriptar la contraseña
$hashed_password = password_hash($Contraseña, PASSWORD_DEFAULT);

$sql = "INSERT INTO `usuarios` (`Nombre`, `Apellido`, `TipoIdentificacion`, `Num_identificacion`, `direccion`, `Fecha_nacimiento`, `correo`, `Contraseña`, `rol`) VALUES ('$nombre','$apellidos','$tipo_ide','$num_ide','$direccion','$Fecha','$correo','$hashed_password','$rol')";

if ($conexion->query($sql)) {
    $id = $conexion->insert_id;
    echo "Usuario insertado correctamente con el ID: $id"; // Mensaje de éxito (puedes eliminar esta línea si no necesitas el mensaje)
} else {
    echo "Error al insertar usuario: " . $conexion->error; // Mensaje de error si la consulta no se ejecuta correctamente
}

header('Location: gestionUsuarios.php');
?>
