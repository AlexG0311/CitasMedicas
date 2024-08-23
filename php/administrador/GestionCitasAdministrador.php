<?php
require '../login/conexion.php';
session_start();

if(isset($_SESSION['Nombre']) && isset($_SESSION['Num_identificacion'])){
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
    <title>EduCECAR - Gestión de Temas</title>
    <script src="../../Js/temas.js"></script>
    <link rel="stylesheet" href="../../estilos/bootstrap.min.css">
    <link rel="stylesheet" href="../../estilos/PanelAdministrador.css">
    <script src="../../Js/gestionTemas.js"></script>
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
            <li><a href="PanelAdministrador.php">Inicio</a></li>
            <li><a href="GestionCitasAdministrador.php">Gestión de citas medicas</a></li>
            <li><a href="gestionUsuarios.php">Gestión de Usuarios</a></li>
            <li><a href="gestionHorarios.php">Gestión de Horarios</a></li>
            <li><a href="configuracionAdministrador.php">Configuración</a></li>
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

            <label for="documento">Documento del paciente</label>
            <input type="text" id="documento" name="documento" placeholder="Digitar el numero de documento del paciente..." required><br><br>

            <label for="especialidad">Especialidad:</label>
            <select id="especialidad" name="especialidad" required>
                <option value="Medicina General">Medicina General</option>
                <option value="Medicina Interna">Medicina Interna</option>
                <!-- Aquí puedes incluir más opciones de especialidades -->
            </select><br><br>
            <button type="submit">Consultar Agendamiento</button>
        </form>
        
        <?php
        if(isset($_POST['fecha']) && isset($_POST['especialidad']) && isset($_POST['motivo']) && isset($_POST['documento'])) {
            if ($conexion->connect_error) {
                die("Error de conexión: " . $conexion->connect_error);
            }

            $fecha = $conexion->real_escape_string($_POST['fecha']);
            $especialidad = $conexion->real_escape_string($_POST['especialidad']);
            $motivo = $conexion->real_escape_string($_POST['motivo']);
            $documento = $conexion->real_escape_string($_POST['documento']);

            $sql = "SELECT hora, medico FROM horarios WHERE fecha = '$fecha' AND especialidad = '$especialidad' AND cita IS NULL";
            $result = $conexion->query($sql);

            if ($result->num_rows > 0) {
                echo "<h2>Horarios Disponibles para el $fecha</h2>";
                echo "<table>";
                echo "<tr><th>Hora</th><th>Médico</th><th>Motivo</th><th>Documento</th><th>Acción</th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>{$row['hora']}</td><td>{$row['medico']}</td><td>$motivo</td><td>$documento</td><td><button class='agendar-cita-btn' data-fecha='$fecha' data-hora='{$row['hora']}' data-medico='{$row['medico']}' data-especialidad='$especialidad' data-documento='$documento' data-motivo='$motivo'>Agendar Cita</button></td></tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No hay citas disponibles para la fecha $fecha y la especialidad $especialidad.</p>";
            }

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
            var documento = this.getAttribute('data-documento');
            var motivo = this.getAttribute('data-motivo');
            var medico = this.getAttribute('data-medico');

            fetch('guardar_cita.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'fecha=' + fecha + '&hora=' + hora + '&especialidad=' + especialidad + '&documento=' + documento + '&motivo=' + motivo + '&medico=' + medico
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
                location.reload();
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
