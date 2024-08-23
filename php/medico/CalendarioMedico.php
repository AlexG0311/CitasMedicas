<?php
session_start();

if(isset($_SESSION['Nombre']) && isset($_SESSION['Num_identificacion'])){
    $Nombre = $_SESSION['Nombre'];
    $Apellido = $_SESSION['Apellido'];
    $idPaciente = $_SESSION['Num_identificacion']; // Asegúrate de que el ID del paciente se almacena en la sesión al iniciar sesión
    $Nombre = $_SESSION['Nombre'];
    $Apellido = $_SESSION['Apellido'];
    $Tipo_identifcacion = $_SESSION['TipoIdentificacion'];
    $correo = $_SESSION['correo'];
    $direccion = $_SESSION['direccion'];
    $Num_identificacion = $_SESSION['Num_identificacion'];

    // Establecer la conexión a la base de datos
    require '../login/conexion.php';

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Obtener las citas del paciente con su información personal
    $citas = array();
    $sql = "SELECT fecha, hora, motivo FROM agendar_citas WHERE medico = '".$_SESSION['Nombre']."'";

    $result = $conexion->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $citas[] = $row;
        }
    }

    // Cerrar la conexión
    $conexion->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control - Medico</title>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
    <link rel="stylesheet" href="../../estilos/bootstrap.min.css">
    <link rel="stylesheet" href="../../estilos/PanelInstructor.css">
    <style>
        .container {
            display: flex;
        }

        .fc-unthemed td.fc-today {
    background: #50397b;
}

        .content {
            flex: 1;
            padding: 10px;
        }

        #calendar {
            max-width: 900px;
            margin: 0 auto;
        }
        .clase1{
            text-align: center;
        }
    </style>
    </style>


    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: [
                    <?php
                        foreach ($citas as $cita) {
                            echo "{";
                            echo "title: '" . $cita['motivo'] . "',";
                            echo "start: '" . $cita['fecha'] . "T" . $cita['hora'] . "',";
                            echo "},";
                        }
                    ?>
                ]
            });
        });
    </script>


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
            <h2 class = "clase1" >Calendario Citas</h2>
            <div id="calendar"></div>
        </div>
</body>
</html>
<?php 
}else{
    header("location:inicio.php");
    exit();
}
?>