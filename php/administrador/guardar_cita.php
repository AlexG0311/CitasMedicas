<?php
session_start();

if(isset($_POST['fecha']) && isset($_POST['hora']) && isset($_POST['especialidad']) && isset($_POST['documento']) && isset($_POST['motivo']) && isset($_POST['medico'])) {
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $especialidad = $_POST['especialidad'];
    $documento = $_POST['documento'];
    $motivo = $_POST['motivo'];
    $medico = $_POST['medico'];

    require '../login/conexion.php';

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $conexion->begin_transaction(); 

    try {
        $sql_check = "SELECT Num_identificacion FROM usuarios WHERE Num_identificacion = '$documento'";
        $result_check = $conexion->query($sql_check);

        if ($result_check->num_rows > 0) {
            $sql = "INSERT INTO agendar_citas (fecha, hora, motivo, especialidad, paciente_id, medico) VALUES ('$fecha', '$hora', '$motivo', '$especialidad', '$documento', '$medico')";
            
            if($conexion->query($sql) === TRUE) {
                $cita_id = $conexion->insert_id;

                $sql_update = "UPDATE horarios SET cita = '$cita_id' WHERE fecha = '$fecha' AND hora = '$hora' AND especialidad = '$especialidad' AND cita IS NULL";
                if ($conexion->query($sql_update) === TRUE) {
                    $conexion->commit();
                    echo "La cita se ha agendado correctamente.";
                } else {
                    $conexion->rollback();
                    echo "Hubo un error al agendar la cita. Por favor, inténtalo de nuevo. Error: " . $conexion->error;
                }
            } else {
                $conexion->rollback();
                echo "Hubo un error al agendar la cita. Por favor, inténtalo de nuevo. Error: " . $conexion->error;
            }
        } else {
            echo "El documento del paciente no existe en la base de datos.";
        }
    } catch (Exception $e) {
        $conexion->rollback();
        echo "Hubo un error al agendar la cita. Por favor, inténtalo de nuevo. Error: " . $e->getMessage();
    }

    $conexion->close();
} else {
    echo "No se recibieron todos los datos necesarios para agendar la cita.";
}
?>
