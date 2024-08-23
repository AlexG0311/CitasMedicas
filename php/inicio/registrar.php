<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../estilos/Registro.css">
    <title>Registrarse - EduCecar</title>
</head>
<body>
    <header>
        <div class="logo">
            <img src="https://i.postimg.cc/595JKrHN/JDMB1-N-removebg-preview.png" alt="EduCecar" width="45%">
        </div>
        <nav>
            <ul>
                <li><a href="inicio.php">Inicio</a></li>
                <li><a href="Iniciosesion.php" class="boton-iniciar-sesion">Iniciar Sesión</a></li>
            </ul>
        </nav>
    </header>
    <h2 class="titulo">Registro</h2>
    
    <section>
        <form action="../login/verificar.php" method = "POST">

            <label>Nombres</label>
            <input type="text" placeholder="..." id="first_name" required  name = "first_name" >
            
            <label>Apellidos</label>
            <input type="text" placeholder="..." id="last_name" required   name = "last_name" >
            
            <label>Tipo de identificación</label>
            <select id="id_type" required  name = "tipo_identificacion"         >
                <option value="Cédula de Ciudadanía (CC)"  >Cédula de Ciudadanía (CC)</option>
                <option value="Tarjeta de Identidad (TI)" >Tarjeta de Identidad (TI)</option>
                <option value="Cédula de Extranjería (CE)"  >Cédula de Extranjería (CE)</option>
                <option value="Pasaporte"   >Pasaporte</option>
            </select>
            
            <label>Número de identificación</label>
            <input type="text" placeholder="..." id="id_number" required    name = "id_number"    >
            
            <label>Dirección de residencia</label>
            <input type="text" placeholder="Formato: barrio, calle, Carrera, numero" id="address" required  name = "address">
           
            <label>Fecha de Nacimiento</label>
            <input type="date" id="birthdate" required  name = "birthdate">
            
            <label>Correo Electrónico</label>
            <input type="email" placeholder="..." id="email" required   name = "email">
           
            <label>Contraseña</label>
            <input type="password" placeholder="..." id="password" required name = "password" >


            <input type="submit" value="Registro"  name ="Registro">


        </form>
        <p>¿Ya tienes una cuenta? <a href="Iniciosesion.php">Iniciar Sesión</a></p>
    </section>

    <div class="image-container">
        <img class="image-container" src="https://i.postimg.cc/L5jkSW-6z/Dise-o-sin-t-tulo-removebg-preview.png" alt="image-container">
    </div>
    <script src="../Js/signup.js"></script>







    <?php

include("verificar.php")


?>

</body>



</html>
