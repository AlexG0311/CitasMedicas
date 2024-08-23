<?php
include("../login/conexion.php");
if(isset($_POST['Agregar'])) {
    // Verificar si los campos no están vacíos
    if(!empty($_POST['nombres']) && !empty($_POST['primer_apellido']
    && !empty($_POST['segundo_apellido'])  && !empty($_POST['numero_identificacion']))
    && !empty($_POST['especialidad'])) {
        // Los campos no están vacíos, procesar el formulario
        $nombres = $_POST['nombres'];
        $primer_apellido = $_POST['primer_apellido'];
        $segundo_apellido = $_POST['segundo_apellido'];
        $numero_identificacion = $_POST['numero_identificacion'];
        $especialidad = $_POST['especialidad'];
        
        $sql =  "INSERT INTO `medico`(`nombre`, `apellido1`, `apellido2`, `Num_identificacion`, `especialidad`) VALUES ('$nombres','$primer_apellido','$segundo_apellido','$numero_identificacion','$especialidad')";
        $resultado = mysqli_query($conexion, $sql);
        // Aquí puedes realizar las operaciones necesarias, como insertar en la base de datos, etc.
        if($resultado){
        echo "Paciente agregado correctamente";
        }else{
         echo "Error al agregar paciente";
        }
    }else{
        echo "Por favor, complete todos los campos";
    }
}
?>
