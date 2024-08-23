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
    <title>Gestion documentos - Citatech</title>
    <link rel="stylesheet" href="../../estilos/bootstrap.min.css">
    <link rel="stylesheet" href="../../estilos/PanelAdministrador.css">

    <script src="../../Js/gestionVideos.js"></script>
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
        <header>
            <h2>Gestión de documentos</h2>
        </header>

       

    </div>
</div>
</body>
</html>

<?php 
}else{
    header("location:inicio.php");
    exit();
}
?>