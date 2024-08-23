<?php
session_start();

if(isset($_SESSION['Num_identificacion'])) {
    $num_identificacion = $_SESSION['Num_identificacion'];

    // Establecer la conexión a la base de datos
    require '../login/conexion.php';

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Preparar la consulta SQL para eliminar el usuario
    $sql = "DELETE FROM usuarios WHERE Num_identificacion = '$num_identificacion'";

    // Ejecutar la consulta
    if($conexion->query($sql) === TRUE) {
        // Cerrar la sesión
        session_destroy();
        header("location:inicio.php");
    } else {
        echo "Error al eliminar la cuenta: " . $conexion->error;
    }

    // Cerrar la conexión
    $conexion->close();
} else {
    header("location:inicio.php");
    exit();
}
?>
