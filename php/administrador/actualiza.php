<?php
include ("../login/conexion.php");

$nombre = $conexion->real_escape_string($_POST['nombre']);
$apellidos = $conexion->real_escape_string($_POST['apellidos']);
$tipo_ide = $conexion->real_escape_string($_POST['tipo_identificacion']);
$num_ide = $conexion->real_escape_string($_POST['cedula']);
$direccion = $conexion->real_escape_string($_POST['direccion']);
$Fecha = $conexion->real_escape_string($_POST['fechanac']);
$correo = $conexion->real_escape_string($_POST['correo']);
$Contraseña = $conexion->real_escape_string($_POST['contraseña']); 
$rol = $conexion->real_escape_string($_POST['rol']);// Corregido el nombre del campo contraseña

$sql = "UPDATE `usuarios` SET `Nombre`='$nombre',`Apellido`='$apellidos',`TipoIdentificacion`='$tipo_ide',`Num_identificacion`='$num_ide',`direccion`='$direccion',`Fecha_nacimiento`='$Fecha',`correo`='$correo',`Contraseña`='$Contraseña',`rol`='$rol' WHERE Num_identificacion = '$num_ide'"; // Corregido el nombre del campo contraseña y agregado punto y coma al final de la consulta SQL

if ($conexion->query($sql)) {
    echo "Usuario insertado correctamente con el ID: $num_ide"; // Mensaje de éxito (puedes eliminar esta línea si no necesitas el mensaje)
} else {
    echo "Error al insertar usuario: " . $conexion->error; // Mensaje de error si la consulta no se ejecuta correctamente
}

header('Location: gestionUsuarios.php');
?>

