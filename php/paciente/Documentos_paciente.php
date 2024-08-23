<?php
session_start();

include("../login/conexion.php"); // Asegúrate de que la ruta a la conexión de la base de datos es correcta

$idPaciente = $_SESSION['Num_identificacion']; // Asegúrate de que el ID del paciente se almacena en la sesión al iniciar sesión
    $Nombre = $_SESSION['Nombre'];
    $Apellido = $_SESSION['Apellido'];
    $Tipo_identifcacion = $_SESSION['TipoIdentificacion'];
    $correo = $_SESSION['correo'];
    $direccion = $_SESSION['direccion'];
    $Num_identificacion = $_SESSION['Num_identificacion'];

// Consulta para obtener los documentos del paciente
$sql = "SELECT d.nombre, d.archivo, u.nombre AS nombre_medico
        FROM documento d
        JOIN usuarios u ON d.medico = u.Num_identificacion
        WHERE d.id_paciente = '$idPaciente'";
$resultado = $conexion->query($sql);


if(isset($_SESSION['Nombre']) && isset($_SESSION['Num_identificacion'])){

    $Nombre = $_SESSION['Nombre'];
    $Apellido = $_SESSION['Apellido'];

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CitaTech - Documentos</title>
    <link rel="stylesheet" href="../../estilos/bootstrap.min.css">
    <link rel="stylesheet" href="../../estilos/panelEstudiante.css">
    <script src=""></script>
    
</head>
<body>

    

<div class="container">
    <div class="sidebar">
            <div class="header">
                <h1>Panel de Control</h1>
                <p><?php echo $Nombre . " " . $Apellido; ?></p>
                <p><?php echo $Num_identificacion; ?></p>
                
            </div>
            <ul>
                <li><a href="iniciopaciente.php">Inicio</a></li>
                <li><a href="MisCitas_paciente.php">Mis Citas</a></li>
                <li><a href="AgendarCita_paciente.php">Agendar Cita</a></li>
                <li><a href="CalendarioCitas_paciente.php">Calendario Citas</a></li>
                <li><a href="Documentos_paciente.php">Documentos</a></li>
                <li><a href="Configuracion_paciente.php">Configuración</a></li>
                <li><a href="../cerrarsesion.php">Cerrar Sesión</a></li>
            </ul>
        </div>

        <div class="content">
            <h2>Mis Documentos</h2>
            <div id="calificaciones-estudiante">
            
        <?php if ($resultado->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Nombre del Documento</th>
                        <th>Médico</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['nombre']) ?></td>
                            <td><?= htmlspecialchars($row['nombre_medico']) ?></td>
                            <td><a href="<?= htmlspecialchars($row['archivo']) ?>" download><button>Descargar</button></a></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No tiene documentos disponibles.</p>
        <?php endif; ?> 
               
            </div>
        </div>
    </div>
    
</body>
</html>
<?php 
}else{
    header("location:inicio.php");
    exit();
}
?>