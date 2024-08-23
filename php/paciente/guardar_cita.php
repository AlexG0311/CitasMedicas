<?php
session_start();

// Verificar si se recibieron los datos necesarios
if(isset($_POST['fecha']) && isset($_POST['hora']) && isset($_POST['especialidad']) && isset($_POST['paciente_id']) && isset($_POST['motivo'])&& isset($_POST['medico'])) {
    // Obtener los datos recibidos de la solicitud AJAX
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $especialidad = $_POST['especialidad'];
    $paciente_id = $_POST['paciente_id'];
    $motivo = $_POST['motivo'];
    $medico = $_POST['medico'];

    // Establecer la conexión a la base de datos
    require '../login/conexion.php';

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Iniciar una transacción
    $conexion->begin_transaction();

    try {
        // Preparar la consulta SQL para insertar la cita
        $sql = "INSERT INTO agendar_citas (fecha, hora, especialidad, paciente_id, motivo, medico) VALUES ('$fecha', '$hora', '$especialidad', '$paciente_id', '$motivo', '$medico')";
        
        // Ejecutar la consulta
        if($conexion->query($sql) === TRUE) {
            // Obtener el ID de la cita recién insertada
            $cita_id = $conexion->insert_id;

            // Actualizar la tabla horarios con el ID de la cita
            $sql_update = "UPDATE horarios SET cita = '$cita_id' WHERE fecha = '$fecha' AND hora = '$hora' AND especialidad = '$especialidad' AND cita IS NULL";
            if ($conexion->query($sql_update) === TRUE) {
                // Confirmar la transacción
                $conexion->commit();
                echo "La cita se ha agendado correctamente.";
            } else {
                // Si ocurre un error al actualizar, revertir la transacción
                $conexion->rollback();
                echo "Hubo un error al agendar la cita. Por favor, inténtalo de nuevo. Error: " . $conexion->error;
            }
        } else {
            // Si ocurre un error al insertar, revertir la transacción
            $conexion->rollback();
            echo "Hubo un error al agendar la cita. Por favor, inténtalo de nuevo. Error: " . $conexion->error;
        }
    } catch (Exception $e) {
        // Si ocurre una excepción, revertir la transacción
        $conexion->rollback();
        echo "Hubo un error al agendar la cita. Por favor, inténtalo de nuevo. Error: " . $e->getMessage();
    }

    // Cerrar la conexión
    $conexion->close();
} else {
    // Si faltan datos en la solicitud AJAX
    echo "No se recibieron todos los datos necesarios para agendar la cita.";
}
?>
