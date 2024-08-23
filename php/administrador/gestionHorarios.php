<?php
session_start();


if(isset($_SESSION['Nombre']) && isset($_SESSION['Num_identificacion'])){

    $Nombre = $_SESSION['Nombre'];
    $Apellido = $_SESSION['Apellido'];
    $Num_identificacion = $_SESSION['Num_identificacion'];
  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Horarios - Administrador</title>
    <link rel="stylesheet" href="../../estilos/all.min.css">
    <link rel="stylesheet" href="../../estilos/bootstrap.min.css">
    <link rel="stylesheet" href="../../estilos/panelAdministrador.css">
    <script src="../../js/bootstrap.bundle.min.js"></script>
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
                <li><a href="GestionDocumentosAdministrador.php">Gestión de Documentos</a></li>
                <li><a href="gestionUsuarios.php">Gestión de Usuarios</a></li>
                <li><a href="gestionHorarios.php">Gestión de Horarios</a></li>
                <li><a href="configuracionAdministrador.php">Configuración</a></li>
                <li><a href="../cerrarsesion.php">Cerrar Sesión</a></li>
            </ul>
        </div>
        <div class="content">
            <div class="tabla_">
                <a href="#" class="dark-btn" data-bs-toggle="modal" data-bs-target="#nuevo_modal"><i class="fa-solid fa-circle-plus"></i> Nuevo horario</a>
                <br><br>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Especialidad</th>
                                <th>Medico</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Conexión a la base de datos
                            require '../login/conexion.php';
                            if ($conexion->connect_error) {
                                die("Conexión fallida: " . $conexion->connect_error);
                            }

                            $sql = "SELECT * FROM horarios";
                            $result = $conexion->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                            <td>" . $row['fecha'] . "</td>
                                            <td>" . $row['hora'] . "</td>
                                            <td>" . $row['especialidad'] . "</td>
                                            <td>" . $row['medico'] . "</td>
                                            <td>
                                                <a href='#' class='btn btn-sm btn-warning' data-bs-toggle='modal' data-bs-target='#editar_modal' data-bs-id='" . $row['id'] . "'><i class='fa-solid fa-pen-to-square'></i> Editar</a>
                                                <a href='eliminarHorario.php?id=" . $row['id'] . "' class='btn btn-sm btn-danger'><i class='fa-solid fa-trash'></i> Eliminar</a>
                                            </td>
                                          </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No hay horarios disponibles</td></tr>";
                            }

                            $conexion->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal para nuevo horario -->
        <div class="modal fade" id="nuevo_modal" tabindex="-1" aria-labelledby="nuevoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="nuevoModalLabel">Nuevo Horario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="guardarHorario.php" method="POST">
                            <div class="mb-3">
                                <label for="fecha" class="form-label">Fecha</label>
                                <input type="date" class="form-control" id="fecha" name="fecha" required>
                            </div>
                            <div class="mb-3">
                                <label for="hora" class="form-label">Hora</label>
                                <input type="time" class="form-control" id="hora" name="hora" required>
                            </div>
                            <div class="mb-3">
                                <label for="especialidad" class="form-label">Especialidad</label>
                           

                                <select lass="form-control" id="especialidad" name="especialidad" required>

                                <option value="Medicina General">Medicina General</option>
                                <option value="Medicina Interna">Medicina Interna</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="medico" class="form-label">Médico</label>
                                <select class="form-control" id="medico" name="medico" required>
                                    <!-- Opciones de médicos se llenarán aquí -->
                                    <?php
                                    // Conexión a la base de datos
                                    require '../login/conexion.php';
                                    if ($conexion->connect_error) {
                                        die("Conexión fallida: " . $conexion->connect_error);
                                    }

                                    $sql = "SELECT Num_identificacion, Nombre, Apellido FROM usuarios WHERE rol='medico'";
                                    $result = $conexion->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row['Nombre'] .  "'>" . $row['Nombre'] . " " . $row['Apellido'] . "</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No hay médicos disponibles</option>";
                                    }

                                    $conexion->close();
                                    ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para editar horario -->
        <div class="modal fade" id="editar_modal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editarModalLabel">Editar Horario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="actualizarHorario.php" method="POST">
                            <input type="hidden" id="editar_id" name="id">
                            <div class="mb-3">
                                <label for="editar_fecha" class="form-label">Fecha</label>
                                <input type="date" class="form-control" id="editar_fecha" name="fecha" required>
                            </div>
                            <div class="mb-3">
                                <label for="editar_hora" class="form-label">Hora</label>
                                <input type="time" class="form-control" id="editar_hora" name="hora" required>
                            </div>
                            <div class="mb-3">
                                <label for="editar_especialidad" class="form-label">Especialidad</label>
                                <input type="text" class="form-control" id="editar_especialidad" name="especialidad" required>
                            </div>
                            <div class="mb-3">
                                <label for="editar_medico" class="form-label">Médico</label>
                                <select class="form-control" id="editar_medico" name="medico" required>
                                    <!-- Opciones de médicos se llenarán aquí -->
                                    <?php
                                    
                                    
                                    if ($conexion->connect_error) {
                                        die("Conexión fallida: " . $conexion->connect_error);
                                    }

                                    $sql = "SELECT Num_identificacion, Nombre, Apellido FROM usuarios WHERE rol='medico'";
                                    $result = $conexion->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row['Num_identificacion'] . "'>" . $row['Nombre'] . " " . $row['Apellido'] . "</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No hay médicos disponibles</option>";
                                    }

                                    $conexion->close();
                                    ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Llenar formulario de edición con datos del horario seleccionado
            var editar_modal = document.getElementById('editar_modal');
            editar_modal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var id = button.getAttribute('data-bs-id');

                var inputId = editar_modal.querySelector('#editar_id');
                var inputFecha = editar_modal.querySelector('#editar_fecha');
                var inputHora = editar_modal.querySelector('#editar_hora');
                var inputEspecialidad = editar_modal.querySelector('#editar_especialidad');
                var inputMedico = editar_modal.querySelector('#editar_medico');

                var url = "obtenerHorario.php";
                var formData = new FormData();
                formData.append('id', id);

                fetch(url, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    inputId.value = data.id;
                    inputFecha.value = data.fecha;
                    inputHora.value = data.hora;
                    inputEspecialidad.value = data.especialidad;
                    inputMedico.value = data.medico;
                })
                .catch(error => console.error('Error:', error));
            });
        </script>
    </div>
</body>
</html>

<?php 
}else{
    header("location:inicio.php");
    exit();
}
?>
