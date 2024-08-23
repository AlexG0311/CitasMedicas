<?php
session_start();
require '../login/conexion.php';
if(isset($_SESSION['Num_identificacion'])) {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $tipo_identificacion = $_POST['tipo_identificacion'];
    $direccion = $_POST['direccionResidencia'];
    $fecha_nacimiento = $_POST['fechaNacimiento'];
    $correo = $_POST['email'];
    $contraseña = $_POST['contrasena'];
    $num_identificacion = $_SESSION['Num_identificacion'];

    // Establecer la conexión a la base de datos


    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Preparar la consulta SQL para actualizar los datos del paciente
    $sql = "UPDATE usuarios SET 
            Nombre = '$nombre',
            Apellido = '$apellido',
            TipoIdentificacion = '$tipo_identificacion',
            direccion = '$direccion',
            Fecha_nacimiento = '$fecha_nacimiento',
            correo = '$correo',
            Contraseña = '$contraseña'
            WHERE Num_identificacion = '$num_identificacion'";

    // Ejecutar la consulta
    if($conexion->query($sql) === TRUE) {
        // Actualizar los datos de la sesión
        $_SESSION['Nombre'] = $nombre;
        $_SESSION['Apellido'] = $apellido;
        $_SESSION['TipoIdentificacion'] = $tipo_identificacion;
        $_SESSION['direccion'] = $direccion;
        $_SESSION['Fecha_nacimiento'] = $fecha_nacimiento;
        $_SESSION['correo'] = $correo;
        $_SESSION['Contraseña'] = $contraseña;

        echo "Datos actualizados correctamente.";
    } else {
        echo "Error al actualizar los datos: " . $conexion->error;
    }

    // Cerrar la conexión
    $conexion->close();
} else {
    header("location:inicio.php");
    exit();
}
?>
