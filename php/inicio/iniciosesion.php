<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../estilos/Login.css">
    <title>Iniciar Sesión - EduCecar</title>
</head>
<body>
    <header>
        <div class="logo">
            <img src="https://i.postimg.cc/595JKrHN/JDMB1-N-removebg-preview.png" alt="EduCecar" width="45%">
        </div>
        <nav>
            <ul>
                <li><a href="inicio.php">Inicio</a></li>
                <li><a href="registrar.php" class="boton-iniciar-sesion">registrarse</a></li>
            </ul>
        </nav>
    </header>
    
    <section>
        <h2>Iniciar Sesión</h2>
        <form action="../login/verificarsesion.php" method="POST">
            <label>Email</label>          
            <input type="email" placeholder="..." id="correo" name="correo" required autofocus>
            <label>Contraseña</label>
            <input type="password" placeholder="..." id="Contraseña" required name="Contraseña">
            <input type="submit" value="Ingresar" name="Ingresar">
        </form>
        <br> <br>
        <?php
        if (isset($_GET['error']) && $_GET['error'] == 'true') {
            echo '<div class="error-message">Falló la autenticación: Ingresaste el correo o contraseña incorrecto.</div>';
        }
        ?>



        <p>No tienes una cuenta? <a href="registrar.php">Registro</a></p>
    </section>


    
</body>

</html>
