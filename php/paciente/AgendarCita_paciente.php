<?php
require '../login/conexion.php';
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
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Agendamiento</title>
    <link rel="stylesheet" href="../../estilos/bootstrap.min.css">
    <link rel="stylesheet" href="../../estilos/PanelAdministrador.css">
    <script src="../../Js/agendar_cita.js"></script>
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
            <h2>Consultar Horarios Disponibles</h2>
            <form action="" method="post">
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" required><br><br>

                <label for="motivo">Motivo:</label>
                <textarea id="motivo" name="motivo" rows="4" cols="50" required></textarea><br><br>
                
                <label for="especialidad">Especialidad:</label>
                <select id="especialidad" name="especialidad" required>
                    <option value="Medicina General">Medicina General</option>
                    <option value="Medicina Interna">Medicina Interna</option>
                    <!-- Aquí puedes incluir más opciones de especialidades -->
                </select><br><br>
        <?php    $paciente_id = $_SESSION['Num_identificacion'];      ?>
                <button type="submit">Consultar Agendamiento</button>
            </form>
            
            <?php
            // Verificar si se ha enviado el formulario de consultar agendamiento
            if(isset($_POST['fecha']) && isset($_POST['especialidad']) && isset($_POST['motivo'])) {
                // Establecer la conexión a la base de datos
              

                // Verificar la conexión
                if ($conexion->connect_error) {
                    die("Error de conexión: " . $conexion->connect_error);
                }

                // Escapar los datos ingresados para evitar inyección SQL
                $fecha = $conexion->real_escape_string($_POST['fecha']);
                $especialidad = $conexion->real_escape_string($_POST['especialidad']);
                $motivo = $conexion->real_escape_string($_POST['motivo']);

                // Consultar las citas disponibles para la fecha y especialidad dadas
                $sql = "SELECT hora, medico FROM horarios WHERE fecha = '$fecha' AND especialidad = '$especialidad' AND cita IS NULL";
                $result = $conexion->query($sql);

                if ($result->num_rows > 0) {
                    // Mostrar los horarios disponibles en una tabla
                    echo "<h2>Horarios Disponibles para el $fecha</h2>";
                    echo "<table>";
                    echo "<tr><th>Hora</th><th>Médico</th><th>Motivo</th><th>Acción</th></tr>";
                    while($row = $result->fetch_assoc()) {
                        // Agregar el motivo a la cita médica
                        echo "<tr><td>{$row['hora']}</td><td>{$row['medico']}</td><td>$motivo</td><td><button class='agendar-cita-btn' data-fecha='$fecha' data-hora='{$row['hora']}' data-medico='{$row['medico']}' data-especialidad='$especialidad' data-paciente-id='$paciente_id' data-motivo='$motivo'>Agendar Cita</button></td></tr>";
                    }
                    echo "</table>";
                } else {
                    // No hay citas disponibles para la fecha y especialidad dadas
                    echo "<p>No hay citas disponibles para la fecha $fecha y la especialidad $especialidad.</p>";
                }

                // Cerrar la conexión
                $conexion->close();
            }
            ?>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.agendar-cita-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    var fecha = this.getAttribute('data-fecha');
                    var hora = this.getAttribute('data-hora');
                    var especialidad = this.getAttribute('data-especialidad');
                    var paciente_id = this.getAttribute('data-paciente-id');
                    var motivo = this.getAttribute('data-motivo');
                    var medico = this.getAttribute('data-medico');

                    fetch('guardar_cita.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: 'fecha=' + fecha + '&hora=' + hora + '&especialidad=' + especialidad + '&paciente_id=' + paciente_id + '&motivo=' + motivo + '&medico=' + medico
                    })
                    .then(response => response.text())
                    .then(data => {
                        alert(data);
                        location.reload(); // Recargar la página para reflejar los cambios
                    })
                    .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>
</body>

</html>

<?php 
} else {
    header("location:inicio.php");
    exit();
}
?>
