<?php
require '../login/conexion.php'; 

$N_i = $conexion->real_escape_string($_POST['cedula']);

$sql = "SELECT `Nombre`,`Apellido`,`TipoIdentificacion`,`Num_identificacion`,`direccion`,`Fecha_nacimiento`,`correo`,`Contraseña`,`rol` FROM `usuarios` WHERE Num_identificacion = $N_i LIMIT 1";

$resultado = $conexion->query($sql);

$usuario = [];

if($resultado) {
    $usuario = $resultado->fetch_assoc();
}

echo json_encode($usuario, JSON_UNESCAPED_UNICODE);

?>
