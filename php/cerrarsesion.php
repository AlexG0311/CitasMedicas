<?php

session_start();

if(isset($_SESSION['Nombre']) && isset($_SESSION['Num_identificacion'])) {



    // Eliminar todas las variables de sesión
    session_unset();
    
    // Destruir la sesión
    session_destroy();
    
    header("Location: ../php/inicio/iniciosesion.php");

} else {
    echo "No existe sesión";
}
















?>