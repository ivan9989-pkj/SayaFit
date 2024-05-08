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

        const descansoSuperior = '1:45 minutos';
        const descansoInferior = '2 minutos';

        const descansoFinal = 'Descanso genérico entre días: 2-3 minutos';

        const ejerciciosPorDia = Math.ceil(empuje.length / diasSemana);

        for (let i = 0; i < diasSemana; i++) {
            rutina += `<div class="dia-entrenamiento">\n`;
            rutina += `<h3>Día ${i + 1} - ${diasEntrenamiento[i % diasEntrenamiento.length]}</h3>\n`;

            const ejerciciosEmpuje = empuje.slice(i * ejerciciosPorDia, (i + 1) * ejerciciosPorDia);
            const ejerciciosTraccion = traccion.slice(i * ejerciciosPorDia, (i + 1) * ejerciciosPorDia);
            const ejerciciosPiernas = piernas.slice(i * ejerciciosPorDia, (i + 1) * ejerciciosPorDia);
            const ejerciciosAbdominales = abdominales.slice(0, 1);

            rutina += `<div class="grupo-muscular">\n`;
            rutina += `<h4>Empuje</h4>\n`;
            rutina += generarDescripcionEjercicios(ejerciciosEmpuje);
            rutina += `<p>Descanso tren superior: ${descansoSuperior}</p>\n`;
            rutina += `</div>\n`;

            rutina += `<div class="grupo-muscular">\n`;
            rutina += `<h4>Tracción</h4>\n`;
            rutina += generarDescripcionEjercicios(ejerciciosTraccion);
            rutina += `<p>Descanso tren inferior: ${descansoInferior}</p>\n`;
            rutina += `</div>\n`;

            rutina += `<div class="grupo-muscular">\n`;
            rutina += `<h4>Piernas</h4>\n`;
            rutina += generarDescripcionEjercicios(ejerciciosPiernas);
            rutina += `</div>\n`;

            rutina += `<div class="grupo-muscular">\n`;
            rutina += `<h4>Abdominales</h4>\n`;
            rutina += generarDescripcionEjercicios(ejerciciosAbdominales);
            rutina += `</div>\n`;

            rutina += `<p>${descansoFinal}</p>\n`;
            rutina += `</div>\n`;
        }

        return rutina;
    }

    function generarDescripcionEjercicios(ejercicios) {
        let descripcion = '';
        for (let ejercicio of ejercicios) {
            descripcion += `<p>${ejercicio}: `;
            descripcion += `${generarSeriesRepeticiones()}</p>\n`;
        }
        return descripcion;
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
