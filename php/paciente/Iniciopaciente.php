<?php
session_start();

if (isset($_SESSION['Nombre']) && isset($_SESSION['Num_identificacion'])) {
    $Nombre = $_SESSION['Nombre'];
    $Apellido = $_SESSION['Apellido'];
    $Tipo_identifcacion = $_SESSION['TipoIdentificacion'];
    $correo = $_SESSION['correo'];
    $direccion = $_SESSION['direccion'];
    $Num_identificacion = $_SESSION['Num_identificacion'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control - Paciente</title>
    <link rel="stylesheet" href="../../estilos/bootstrap.min.css">
    <link rel="stylesheet" href="../../estilos/panelEstudiante.css">
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
            <?php
            echo "<h2>Bienvenido, Paciente $Nombre $Apellido </h2>";
            ?>
            <h3>Tus Citas</h3>
            <p>Aquí puedes ver la lista de las citas médicas programadas y acceder a su contenido.</p>

            <h3>Calendario Citas</h3>
            <p>Consulta tus citas médicas programadas y revisa tu historial de citas.</p>

            <h3>Configuración de la Cuenta</h3>
            <p>Ajusta la configuración de tu cuenta, incluyendo la información del perfil y la contraseña.</p>
        </div>
    </div>
</body>

<script src="../Js/PanelEstudiante.js"></script>

</html>
<?php
} else {
    header("location:inicio.php");
    exit();
}
?>
