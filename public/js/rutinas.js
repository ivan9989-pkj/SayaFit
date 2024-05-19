document.addEventListener("DOMContentLoaded", function() {
    const rutinaForm = document.getElementById('rutinaForm');
    const rutinaContainer = document.getElementById('rutinaContainer');
    const rutinaTexto = document.getElementById('rutinaTexto');

    rutinaForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Evitar que se recargue la página al enviar el formulario

        const diasSemana = parseInt(document.getElementById('diasSemana').value);
        const objetivo = document.getElementById('objetivo').value;

        const rutina = generarRutina(diasSemana, objetivo);
        mostrarRutina(rutina);
    });

    function generarRutina(diasSemana, objetivo) {
        let rutina = '';
        const empuje = ['Press de banca', 'Press militar', 'Extensiones de tríceps en polea alta'];
        const traccion = ['Dominadas o Remo con barra', 'Curl de bíceps con barra'];
        const piernas = ['Sentadillas', 'Peso muerto', 'Hip thrust'];
        const abdominales = ['Crunch abdominal'];

        const diasEntrenamiento = ['Empuje (Pecho, Hombros, Tríceps)', 'Tracción (Espalda, Bíceps)', 'Piernas'];

        const ejerciciosPorDia = Math.ceil(empuje.length / diasSemana);

        for (let i = 0; i < diasSemana; i++) {
            const ejerciciosEmpuje = empuje.slice(i * ejerciciosPorDia, (i + 1) * ejerciciosPorDia).join(', ');
            const ejerciciosTraccion = traccion.slice(i * ejerciciosPorDia, (i + 1) * ejerciciosPorDia).join(', ');
            const ejerciciosPiernas = piernas.slice(i * ejerciciosPorDia, (i + 1) * ejerciciosPorDia).join(', ');
            const ejerciciosAbdominales = abdominales.slice(0, 1).join(', ');

            rutina += `<tr>
                          <td rowspan="4">Día ${i + 1}</td>
                          <td>Empuje</td>
                          <td>${ejerciciosEmpuje}</td>
                          <td>${generarSeriesRepeticiones()}</td>
                       </tr>`;
            rutina += `<tr>
                          <td>Tracción</td>
                          <td>${ejerciciosTraccion}</td>
                          <td>${generarSeriesRepeticiones()}</td>
                       </tr>`;
            rutina += `<tr>
                          <td>Piernas</td>
                          <td>${ejerciciosPiernas}</td>
                          <td>${generarSeriesRepeticiones()}</td>
                       </tr>`;
            rutina += `<tr>
                          <td>Abdominales</td>
                          <td>${ejerciciosAbdominales}</td>
                          <td>${generarSeriesRepeticiones()}</td>
                       </tr>`;
        }

        return rutina;
    }

    function generarSeriesRepeticiones() {
        const series = Math.floor(Math.random() * (4 - 3 + 1)) + 3; // Entre 3 y 4 series
        const repeticiones = Math.floor(Math.random() * (12 - 8 + 1)) + 8; // Entre 8 y 12 repeticiones
        return `${series} series de ${repeticiones} repeticiones`;
    }

    function mostrarRutina(rutina) {
        rutinaTexto.innerHTML = rutina;
        rutinaContainer.style.display = 'block'; // Mostrar el contenedor de la rutina
    }
});