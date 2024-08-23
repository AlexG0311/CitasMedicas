<?php
include("../login/conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cedula = $conexion->real_escape_string($_POST['cedula']);
    $nombre = $conexion->real_escape_string($_POST['Nombre']);
    $apellidos = $conexion->real_escape_string($_POST['apellidos']);
    $tipo_identificacion = $conexion->real_escape_string($_POST['tipo_identificacion']);
    $direccion = $conexion->real_escape_string($_POST['direccion']);
    $fecha_nacimiento = $conexion->real_escape_string($_POST['fechaNacimiento']);
    $rol = $conexion->real_escape_string($_POST['rol']);
    $especialidad = $conexion->real_escape_string($_POST['especialidad']);
    $correo = $conexion->real_escape_string($_POST['correo']);
    $contrasena = $conexion->real_escape_string($_POST['contraseña']);

    $sql = "UPDATE usuarios SET nombre='$nombre', apellidos='$apellidos', tipo_identificacion='$tipo_identificacion', direccion='$direccion', fecha_nacimiento='$fecha_nacimiento', rol='$rol', especialidad='$especialidad', correo='$correo', contrasena='$contrasena' WHERE num_identificacion = '$cedula'";

    if ($conexion->query($sql)) {
        echo "Usuario actualizado correctamente con el número de identificación: $cedula";
    } else {
        echo "Error al actualizar usuario: " . $conexion->error;
    }

    header('Location: gestionUsuarios.php');
}
?>
