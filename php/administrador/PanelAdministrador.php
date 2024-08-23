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
    <title>Panel de Control - Administrador</title>
    <link rel="stylesheet" href="../../estilos/bootstrap.min.css">
    <link rel="stylesheet" href="../../estilos/panelAdministrador.css">
    
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
        <?php
          echo  "<h2>Bienvenido, Administrador $Nombre $Apellido</h2>"
?>    
            <h3>Gestión de Citas</h3>
            <p>Gestiona las citas, permitiendo la programación y cancelación de citas.</p>

            <h3>Gestión de Documetos</h3>
            <p>Centraliza el control y la administración de todos tus documentos importantes.</p>

            <h3>Gestión de Usuarios</h3>
            <p>Administra los usuarios del sistema, incluyendo la creación, edición y eliminación de cuentas.</p>

            <h3>Configuración de la Cuenta</h3>
            <p>Ajusta la configuración de tu cuenta de administrador, incluyendo la información del perfil y la contraseña.</p>
        </div>
    </div>
</body>
<script src="../Js/PanelAdministrador.js"></script>

</html>

<?php 
}else{
    header("location:inicio.php");
    exit();
}
?>