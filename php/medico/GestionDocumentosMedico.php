<?php
session_start();
include("../login/conexion.php");

$medico_id =  $_SESSION['Nombre']; // Asegúrate de que esto corresponde al ID del médico
$Nombre = $_SESSION['Nombre'];
$Apellido = $_SESSION['Apellido'];
$Tipo_identifcacion = $_SESSION['TipoIdentificacion'];
$correo = $_SESSION['correo'];
$direccion = $_SESSION['direccion'];
$Num_identificacion = $_SESSION['Num_identificacion'];

// Realizar la consulta SQL
$sql = "SELECT c.fecha, c.hora, c.motivo, c.paciente_id, u.nombre AS Nombre_Paciente, u.apellido AS Apellido_Paciente
FROM agendar_citas c
JOIN usuarios u ON c.paciente_id = u.num_identificacion
WHERE c.medico = '$medico_id'";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Evaluación - Instructor</title>
    <link rel="stylesheet" href="../../estilos/bootstrap.min.css">
    <link rel="stylesheet" href="../../estilos/PanelAdministrador.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                <li><a href="PanelMedico.php">Inicio</a></li>
                <li><a href="GestionDeCitasMedico.php">Citas Medicas</a></li>
                <li><a href="GestionDocumentosMedico.php">Documentos</a></li>
                <li><a href="CalendarioMedico.php">Calendario Citas</a></li>
                <li><a href="ConfiguracionMedico.php">Configuración</a></li>
                <li><a href="../cerrarsesion.php">Cerrar Sesión</a></li>
            </ul>
        </div>

        <div class="content">
            <h1>Subir Documento para Paciente</h1>
            <form action="guarda_documento.php" method="post" enctype="multipart/form-data">
                <label for="paciente_id">Nombre del documento:</label>
                <input type="text" name="nombre">
                <label for="paciente_id">Digite el numero de identificacion del paciente:</label>
                <input type="text" name="num_id">
                <br><br>
                <label for="documento">Seleccione el Documento (PDF, DOCX):</label>
                <input type="file" name="documento" id="documento" required>
                <br><br>
                <button type="submit" name="submit">Subir Documento</button>
            </form>
        </div>
    </div>

    <script>
    function alerta(mensaje, tipo){
        Swal.fire({
            title: tipo === 'success' ? 'Éxito' : 'Error',
            text: mensaje,
            icon: tipo,
            confirmButtonText: 'OK'
        });
    }

    <?php if (isset($_SESSION['mensaje'])) { ?>
        alerta('<?php echo $_SESSION['mensaje']; ?>', '<?php echo $_SESSION['tipo_mensaje']; ?>');
        <?php
        // Elimina el mensaje después de mostrarlo
        unset($_SESSION['mensaje']);
        unset($_SESSION['tipo_mensaje']);
    } ?>
    </script>
</body>
</html>
