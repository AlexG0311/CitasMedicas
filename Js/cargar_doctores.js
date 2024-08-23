function cargarDoctores() {
    var especialidadSeleccionada = document.getElementById("especialidad").value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../paciente/cargar_medicos.php?especialidad=" + especialidadSeleccionada, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById("medicos").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}
