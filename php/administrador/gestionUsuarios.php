
<?php
session_start();


if(isset($_SESSION['Nombre']) && isset($_SESSION['Num_identificacion'])){

    $Nombre = $_SESSION['Nombre'];
    $Apellido = $_SESSION['Apellido'];
    $Num_identificacion = $_SESSION['Num_identificacion'];
  

?>
<?php
require '../login/conexion.php';

// Obtener el número de identificación del formulario si existe
$numIdentificacion = isset($_GET['numero_identificacion']) ? $_GET['numero_identificacion'] : '';


// Modificar la consulta SQL en función de si se proporcionó un número de identificación
if (!empty($numIdentificacion)) {
    // Utiliza prepared statements para prevenir inyecciones SQL
    $stmt = $conexion->prepare("SELECT * FROM `usuarios` WHERE Num_identificacion = ?");
    $stmt->bind_param("s", $numIdentificacion);
    $stmt->execute();
    $usuarios = $stmt->get_result();
} else {
    $sqlUsuarios = "SELECT * FROM `usuarios`";
    $usuarios = $conexion->query($sqlUsuarios);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Usuarios - Administrador</title>
    <link rel="stylesheet" href="../../estilos/bootstrap.min.css">
    <link rel="stylesheet" href="../../estilos/PanelAdministrador.css">
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
                <li><a href="gestionUsuarios.php">Gestión de Usuarios</a></li>
                <li><a href="gestionHorarios.php">Gestión de Horarios</a></li>
                <li><a href="configuracionAdministrador.php">Configuración</a></li>
                <li><a href="../cerrarsesion.php">Cerrar Sesión</a></li>
            </ul>
        </div>

        <div class="content">
            <div class="tabla_">

            
                <a href="#" class="dark-btn" data-bs-toggle="modal" data-bs-target="#nuevo_modal"><i class="fa-solid fa-circle-plus"></i> Nuevo usuario</a>
                <br><br>
                <form action="gestionUsuarios.php" method="GET">
                    <input type="text" name="numero_identificacion" placeholder="Buscar por número de identificación" required>
                    <button type="submit" class="dark-btn">Buscar</button>
                </form>
                <br>
                <div style="overflow-x:auto;">
                    <table>
                        <thead>
                            <tr>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>TipoIdentificacion</th>
                                <th>Numero identificacion</th>
                                <th>Direccion</th>
                                <th>Fecha Nacimiento</th>
                                <th>Correo</th>
                                <th>Contraseña</th>
                                <th>Rol</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row_usuario = $usuarios->fetch_assoc()) { ?>
                                <tr>
                                    <td><?= $row_usuario['Nombre'] ?></td>
                                    <td><?= $row_usuario['Apellido'] ?></td>
                                    <td><?= $row_usuario['TipoIdentificacion'] ?></td>
                                    <td><?= $row_usuario['Num_identificacion'] ?></td>
                                    <td><?= $row_usuario['direccion'] ?></td>
                                    <td><?= $row_usuario['Fecha_nacimiento'] ?></td>
                                    <td><?= $row_usuario['correo'] ?></td>
                                    <td><?= $row_usuario['Contraseña'] ?></td>
                                    <td><?= $row_usuario['rol'] ?></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editar_modal" data-bs-id="<?= $row_usuario['Num_identificacion']; ?>"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <?php
        include("editar_modal.php");
        include("nuevo_modal.php");
        ?>

        <script>
            let editar_modal = document.getElementById('editar_modal');

            editar_modal.addEventListener('shown.bs.modal', event => {
                let button = event.relatedTarget;
                let id = button.getAttribute('data-bs-id');

                let inputNombre = editar_modal.querySelector('.modal-body #nombre');
                let inputApellido = editar_modal.querySelector('.modal-body #apellidos');
                let inputTipoid = editar_modal.querySelector('.modal-body #id_type');
                let inputNum_id = editar_modal.querySelector('.modal-body #cedula');
                let inputDireccion = editar_modal.querySelector('.modal-body #direccionResidencia');
                let inputFechaNac = editar_modal.querySelector('.modal-body #fechaNacimiento');
                let inputemail = editar_modal.querySelector('.modal-body #email');
                let inputcontraseña = editar_modal.querySelector('.modal-body #contraseña');
                let inputTipoU = editar_modal.querySelector('.modal-body #user_type');

                let url = "getUsuarios.php";
                let formData = new FormData();
                formData.append('cedula', id);

                fetch(url, {
                    method: "POST",
                    body: formData
                }).then(response => response.json())
                    .then(data => {
                        inputNombre.value = data.Nombre;
                        inputApellido.value = data.Apellido;
                        inputTipoid.value = data.TipoIdentificacion;
                        inputNum_id.value = data.Num_identificacion;
                        inputDireccion.value = data.direccion;
                        inputFechaNac.value = data.Fecha_nacimiento;
                        inputemail.value = data.correo;
                        inputcontraseña.value = data.Contraseña;
                        inputTipoU.value = data.rol;
                    }).catch(err => console.log(err));
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