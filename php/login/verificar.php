<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <div class="container">
        <h3>Registro de Usuario</h3>
        <?php
        include("conexion.php");

        if (isset($_POST['Registro'])) {
            // Verificar si el correo electrónico ya está en uso
            $email = $_POST['email'];
            $consulta_email = "SELECT correo FROM usuarios WHERE correo = '$email'";
            $resultado_email = mysqli_query($conexion, $consulta_email);

            if (mysqli_num_rows($resultado_email) > 0) {
                // El correo electrónico ya está en uso
                echo "<h3 class='error'>¡El correo electrónico ya está en uso!</h3>";
                echo "<div class='redirect'><button onclick=\"window.location.href='iniciosesion.php'\">Iniciar sesión</button></div>";
                
            } else {
                // El correo electrónico no está en uso, continuar con el registro
                if (strlen($_POST['first_name']) >= 1 && strlen($_POST['last_name']) >= 1 && 
                    strlen($_POST['tipo_identificacion']) >= 1 &&
                    strlen($_POST['id_number']) >= 1 &&
                    strlen($_POST['address']) >= 1 &&
                    strlen($_POST['birthdate']) >= 1 && 
                    strlen($_POST['email']) >= 1 &&
                    strlen($_POST['password']) >= 1) {

                    // Asignar valores de los campos del formulario a variables
                    $Nombres = $_POST["first_name"];
                    $Apellidos = $_POST["last_name"];
                    $tipo_identificacion = $_POST["tipo_identificacion"];
                    $id_number = $_POST["id_number"];
                    $direccion = $_POST["address"];
                    $fecha_nacimiento = $_POST["birthdate"];
                    $email = $_POST["email"];
                    $contraseña = $_POST["password"];
                    
                    // Encriptar la contraseña
                    $hashed_password = password_hash($contraseña, PASSWORD_DEFAULT);

                    // Consulta para insertar el nuevo registro en la base de datos
                    $consulta = "INSERT INTO usuarios (Nombre, Apellido, TipoIdentificacion, Num_identificacion, direccion, Fecha_nacimiento, correo, Contraseña) VALUES ('$Nombres','$Apellidos','$tipo_identificacion','$id_number','$direccion','$fecha_nacimiento','$email','$hashed_password')";
                    
                    // Ejecutar la consulta
                    $resultado = mysqli_query($conexion, $consulta);

                    if ($resultado) {
                        header("Location: ../inicio/iniciosesion.php");
                    } else {
                        echo "<h3 class='error'>¡No te has registrado correctamente!</h3>";
                    }            
                } else {
                    echo "<h3 class='error'>¡Completa todos los campos!</h3>";
                }
            }
        }
        ?>
        <!-- Contenido del formulario de registro -->
    </div>
</body>
</html>
