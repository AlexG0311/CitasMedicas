<?php
session_start();


if(isset($_SESSION['Nombre']) && isset($_SESSION['Num_identificacion'])){

    $Nombre = $_SESSION['Nombre'];
    $Apellido = $_SESSION['Apellido'];
    $Tipo_identifcacion = $_SESSION['TipoIdentificacion'];
    $correo = $_SESSION['correo'];
    $direccion = $_SESSION['direccion'];
    $Num_identificacion = $_SESSION['Num_identificacion'];
?>
    
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control - Medico</title>
    <link rel="stylesheet" href="../../estilos/bootstrap.min.css">
    <link rel="stylesheet" href="../../estilos/PanelInstructor.css">
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
        <?php
          echo  "<h2>Bienvenido,  Medico $Nombre $Apellido </h2>"
?>

<h3>Citas Médicas</h3>
<p>Gestiona las citas médicas de tus pacientes, incluyendo la programación y cancelación de citas.</p>

<h3>Documentos</h3>
<p>Administra los documentos médicos, como historias clínicas, recetas y resultados de pruebas.</p>
<h3>Calendario Citas</h3>
<p>Consulta y organiza tu calendario de citas médicas de manera eficiente.</p>

            <h3>Configuración de la Cuenta</h3>
            <p>Ajusta la configuración de tu cuenta, incluyendo la información del perfil y la contraseña.</p>
        </div>
    </div>
</body>
<script src="../Js/PanelInstructor.js"></script>
</html>
<?php 
}else{
    header("location:inicio.php");
    exit();
}
?>