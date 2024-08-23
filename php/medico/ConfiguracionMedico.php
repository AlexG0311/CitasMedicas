<?php
session_start();

if(isset($_SESSION['Nombre']) && isset($_SESSION['Num_identificacion']) ){
    $Nombre = $_SESSION['Nombre'];
    $Apellido = $_SESSION['Apellido'];
    $Tipo_identifcacion = $_SESSION['TipoIdentificacion'];
    $correo = $_SESSION['correo'];
    $direccion = $_SESSION['direccion'];
    $Num_identificacion = $_SESSION['Num_identificacion'];
    $Contraseña = $_SESSION['Contraseña'];
    $Fecha = $_SESSION['Fecha_nacimiento'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración Medico</title>
    <link rel="stylesheet" href="../../estilos/bootstrap.min.css">
    <link rel="stylesheet" href="../../estilos/panelEstudiante.css">
    <link rel="stylesheet" href="../../estilos/configuracion.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="../../Js/configuracion.js"></script>
    <style>
        
        .content {
            flex: 1;
            padding: 10px;
        }

        .eye-icon {
            position: absolute;
            top: 35%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
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
            <li><a href="PanelMedico.php">Inicio</a></li>
                <li><a href="GestionDeCitasMedico.php">Citas Medicas</a></li>
                <li><a href="GestionDocumentosMedico.php">Documentos</a></li>
                <li><a href="CalendarioMedico.php">Calendario Citas</a></li>
                <li><a href="ConfiguracionMedico.php">Configuración</a></li>
                <li><a href="../cerrarsesion.php">Cerrar Sesión</a></li>
            </ul>
        </div>

        <div class="content">
            <h2>Configuración</h2>

            <form action="actualizar_datos_paciente.php" method="post">
                <label for="cedula">Cédula:</label>
                <input type="text" id="cedula" name="cedula" value="<?php echo $Num_identificacion; ?>" readonly>

                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $Nombre; ?>" readonly>

                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" value="<?php echo $Apellido; ?>" readonly>

                <label for="tipo_identificacion">Tipo identificación:</label>
                <input type="text" id="tipo_identificacion" name="tipo_identificacion" value="<?php echo $Tipo_identifcacion; ?>" readonly>

                <label for="direccionResidencia">Dirección:</label>
                <input type="text" id="direccionResidencia" name="direccionResidencia" value="<?php echo $direccion; ?>" readonly>

                <label for="fechaNacimiento">Fecha Nacimiento:</label>
                <input type="text" id="fechaNacimiento" name="fechaNacimiento" value="<?php echo $Fecha; ?>" readonly>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $correo; ?>" readonly>

                <label for="contrasena">Contraseña Actual:</label>
                <div style="position: relative;">
                    <input type="password" id="contrasena" name="contrasena" value="<?php echo $Contraseña; ?>" readonly>
                    <i class="fas fa-eye eye-icon" id="eyeIcon" onclick="mostrarContraseña()"></i>
                </div>

                <button type="button" class="dark-btn" onclick="habilitarEdicion()">Modificar</button>
                <button type="submit" class="dark-btn" id="btnActualizar" disabled>Actualizar</button>
                <button type="button" class="dark-btn" onclick="eliminarCuenta()">Eliminar</button>
            </form>
        </div>
    </div>
  
    <script>
        function habilitarEdicion() {
            document.getElementById('nombre').removeAttribute('readonly');
            document.getElementById('apellido').removeAttribute('readonly');
            document.getElementById('tipo_identificacion').removeAttribute('readonly');
            document.getElementById('direccionResidencia').removeAttribute('readonly');
            document.getElementById('fechaNacimiento').removeAttribute('readonly');
            document.getElementById('email').removeAttribute('readonly');
            document.getElementById('contrasena').removeAttribute('readonly');
            document.getElementById('btnActualizar').removeAttribute('disabled');
        }

        function mostrarContraseña() {
            var contrasena = document.getElementById("contrasena");
            var eyeIcon = document.getElementById("eyeIcon");
            if (contrasena.type === "password") {
                contrasena.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                contrasena.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }

        function eliminarCuenta() {
            if (confirm("¿Estás seguro de que deseas eliminar tu cuenta?")) {
                window.location.href = "eliminar_cuenta.php";
            }
        }
    </script>
</body>

</html>

<?php 
}else{
    header("location:inicio.php");
    exit();
}
?>
