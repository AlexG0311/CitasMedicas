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
