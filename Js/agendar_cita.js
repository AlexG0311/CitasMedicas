document.addEventListener('DOMContentLoaded', function() {
    // Seleccionar todos los botones de agendar cita
    var agendarCitaButtons = document.querySelectorAll('.agendar-cita-btn');

    // Agregar un evento click a cada botón
    agendarCitaButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            // Obtener los datos de fecha, hora y especialidad del botón
            var fecha = button.getAttribute('data-fecha');
            var hora = button.getAttribute('data-hora');
            var especialidad = button.getAttribute('data-especialidad');
            var paciente_id = button.getAttribute('data-paciente-id');

            // Enviar una solicitud AJAX para agregar la cita
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'guardar_cita.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Manejar la respuesta del servidor
                    alert(xhr.responseText); // Puedes mostrar un mensaje de éxito o redireccionar a otra página
                } else {
                    // Manejar errores
                    alert('Hubo un error al agendar la cita.');
                }
            };
            xhr.send('fecha=' + encodeURIComponent(fecha) + '&hora=' + encodeURIComponent(hora) + '&especialidad=' + encodeURIComponent(especialidad) + '&paciente_id=' + encodeURIComponent(paciente_id));
        });
    });
});
