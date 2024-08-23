<?php
include("../login/conexion.php");

if (isset($_GET['cedula'])) {
    $cedula = $conexion->real_escape_string($_GET['cedula']);

    $consulta = "SELECT * FROM usuarios WHERE num_identificacion = '$cedula'";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado && $resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        echo json_encode([
            'success' => true,
            'Nombre' => $fila['nombre'],
            'apellidos' => $fila['apellidos'],
            'tipo_identificacion' => $fila['tipo_identificacion'],
            'cedula' => $fila['num_identificacion'],
            'direccion' => $fila['direccion'],
            'fecha_nacimiento' => $fila['fecha_nacimiento'],
            'tipo_usuario' => $fila['rol'],
            'especialidad' => $fila['especialidad'],
            'email' => $fila['correo'],
            'contrasena' => $fila['contrasena']
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Usuario no encontrado']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Cédula no proporcionada']);
}
?>
