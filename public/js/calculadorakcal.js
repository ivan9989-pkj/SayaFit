document.addEventListener('DOMContentLoaded', function() {
    // Función para manejar el evento de cambio de intensidad en la calculadora de calorías quemadas
    const intensidadInput = document.getElementById('intensidad');
    const intensidadOutput = document.getElementById('intensidadOutput');

    intensidadInput.addEventListener('input', function() {
        intensidadOutput.value = intensidadInput.value;
    });

    // Función para manejar el envío del formulario de la calculadora de calorías quemadas
    const formCalorias = document.querySelector('#formCalorias');
    formCalorias.addEventListener('submit', function(event) {
        event.preventDefault(); // Evitar el envío predeterminado del formulario

        const formData = new FormData(formCalorias);
        const xhr = new XMLHttpRequest();
        xhr.open('POST', formCalorias.action);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                const resultadoDiv = document.getElementById('resultadoCalorias');
                const caloriasQuemadasSpan = document.getElementById('caloriasQuemadas');
                caloriasQuemadasSpan.textContent = response.calorias_quemadas.toFixed(2); // Mostrar 2 decimales
                resultadoDiv.style.display = 'block'; // Mostrar el mensaje de resultado
            }
        };
        xhr.send(new URLSearchParams(formData)); // Codificar los datos del formulario como parámetros de URL
    });

    // Función para manejar el envío del formulario del generador de rutinas de gimnasio
    const rutinaForm = document.getElementById('rutinaForm');
    const rutinaContainer = document.getElementById('rutinaContainer');
    const rutinaTexto = document.getElementById('rutinaTexto');

    rutinaForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Evitar el envío predeterminado del formulario

        // Obtener los valores del formulario
        const diasSemana = parseInt(document.getElementById('diasSemana').value);
        const objetivo = document.getElementById('objetivo').value;

        // Generar y mostrar la rutina
        const rutina = generarRutina(diasSemana, objetivo);
        mostrarRutina(rutina);
    });

    // Función para generar la rutina de entrenamiento
    function generarRutina(diasSemana, objetivo) {
        let rutina = '';

        // Definir los ejercicios por grupo muscular
        const empuje = ['Press de banca', 'Press militar', 'Extensiones de tríceps en polea alta'];
        const traccion = ['Dominadas o Remo con barra', 'Curl de bíceps con barra'];
        const piernas = ['Sentadillas', 'Peso muerto', 'Hip thrust'];
        const abdominales = ['Crunch abdominal'];

        // Definir los días de entrenamiento y tiempos de descanso
        const diasEntrenamiento = ['Empuje (Pecho, Hombros, Tríceps)', 'Tracción (Espalda, Bíceps)', 'Piernas'];
        const descansoSuperior = '1:45 minutos';
        const descansoInferior = '2 minutos';
        const descansoFinal = 'Descanso genérico entre días: 2-3 minutos';

        const ejerciciosPorDia = Math.ceil(empuje.length / diasSemana);

        // Iterar sobre los días de la semana para generar la rutina
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

    // Función para generar la descripción de los ejercicios
    function generarDescripcionEjercicios(ejercicios) {
        let descripcion = '';
        for (let ejercicio of ejercicios) {
            descripcion += `<p>${ejercicio}: `;
            descripcion += `${generarSeriesRepeticiones()}</p>\n`;
        }
        return descripcion;
    }

    // Función para generar el número de series y repeticiones aleatorias
    function generarSeriesRepeticiones() {
        const series = Math.floor(Math.random() * (4 - 3 + 1)) + 3; // Entre 3 y 4 series
        const repeticiones = Math.floor(Math.random() * (12 - 8 + 1)) + 8; // Entre 8 y 12 repeticiones
        return `${series} series de ${repeticiones} repeticiones`;
    }

    // Función para mostrar la rutina de entrenamiento
    function mostrarRutina(rutina) {
        rutinaTexto.innerHTML = rutina;
        rutinaContainer.style.display = 'block'; // Mostrar el contenedor de la rutina
    }
});

  // Desaparecer el mensaje de resultado después de 4 segundos
  setTimeout(function() {
    document.getElementById('resultado').style.display = 'none';
}, 3500);