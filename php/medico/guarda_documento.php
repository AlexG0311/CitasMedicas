<?php
session_start();
include_once 'GestionDocumentosMedico.php';
include_once("../login/conexion.php");

if (isset($_POST['submit'])) {
    $nombreArchivo = $_POST['nombre'];
    $idPaciente = $_POST['num_id'];
    $medicoId = $_SESSION['Num_identificacion'];
    $archivo = $_FILES['documento']['name'];
    $rutaTemporal = $_FILES['documento']['tmp_name'];
    $extension = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));

    if ($extension != "pdf" && $extension != "docx") {
        $_SESSION['mensaje'] = 'Solo se admiten archivos PDF o DOCX.';
        $_SESSION['tipo_mensaje'] = 'error';
    } else {
        // Ruta relativa al directorio Documentos desde el script actual
        $directorio = "../../Documentos/";
        $rutaArchivo = $directorio . basename($archivo);

        // Verificar y crear el directorio si no existe
        if (!file_exists($directorio)) {
            mkdir($directorio, 0777, true); // Intenta crear el directorio si no existe
        }

        // Intentar mover el archivo subido al directorio de Documentos
        if (move_uploaded_file($rutaTemporal, $rutaArchivo)) {
            $sql = "INSERT INTO documento (nombre, archivo, id_paciente, medico)
                    VALUES ('$nombreArchivo', '$rutaArchivo', '$idPaciente', '$medicoId')";
            if ($conexion->query($sql) === TRUE) {
                $_SESSION['mensaje'] = 'Documento subido y guardado correctamente.';
                $_SESSION['tipo_mensaje'] = 'success';
            } else {
                $_SESSION['mensaje'] = 'Error al guardar en la base de datos: ' . $conexion->error;
                $_SESSION['tipo_mensaje'] = 'error';
            }
        } else {
            $_SESSION['mensaje'] = 'Hubo un error al subir el archivo.';
            $_SESSION['tipo_mensaje'] = 'error';
        }
    }
    header('Location: GestionDocumentosMedico.php');
    exit();
}
?>
