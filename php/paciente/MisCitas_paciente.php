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
    <link rel="stylesheet" href="../../estilos/PanelInstructor.css">
    <link rel="stylesheet" href="../../estilos/panelEstudiante.css">
    <script src="../../Js/cursosEstudiante.js"></script>
    <style>
        .citas{
            margin-left:0px;
        }
    </style>
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

if(isset($_SESSION['Nombre']) && isset($_SESSION['Num_identificacion'])){
    $Nombre = $_SESSION['Nombre'];
    $Apellido = $_SESSION['Apellido'];
    $Tipo_identifcacion = $_SESSION['TipoIdentificacion'];
    $paciente_id = $_SESSION['Num_identificacion'];
    
    
    

    // Establecer la conexión a la base de datos
    require '../login/conexion.php';

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Consultar las citas médicas del paciente
    $sql = "SELECT * FROM agendar_citas WHERE paciente_id = '$paciente_id'";
    $result = $conexion->query($sql);

    // Verificar si se encontraron citas médicas
    if ($result->num_rows > 0) {
        // Mostrar las citas médicas en una tabla
        echo "<h2 class = 'citas'>Mis Citas</h2>";
        echo "<table class='tablecalificaciones'>";
        echo "<tr><th>Fecha</th><th>Hora</th><th>Especialidad</th><th>Motivo</th><th>Medico</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['fecha']}</td>";
            echo "<td>{$row['hora']}</td>";
            echo "<td>{$row['especialidad']}</td>";
            echo "<td>{$row['motivo']}</td>";
            echo "<td>{$row['medico']}</td>";
            
            echo "</tr>";
        }
        echo "</table>";
    } else {
        // Si no se encontraron citas médicas
        echo "<p>No tienes citas médicas agendadas.</p>";
    }

    // Cerrar la conexión
    $conexion->close();
?>

        </div>

    </div>
</body>

</html>

<?php

} else {
    header("location:inicio.php");
    exit();
}
}
?>