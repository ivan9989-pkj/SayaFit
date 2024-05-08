document.addEventListener('DOMContentLoaded', function() {
    const intensidadInput = document.getElementById('intensidad');
    const intensidadOutput = document.getElementById('intensidadOutput');

    intensidadInput.addEventListener('input', function() {
        intensidadOutput.value = intensidadInput.value;
    });

    const form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        // No es necesario prevenir el envío predeterminado del formulario aquí, ya que queremos que se envíe
        
        const formData = new FormData(form);
        const xhr = new XMLHttpRequest();
        xhr.open('POST', form.action);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                const resultadoDiv = document.getElementById('resultado');
                const caloriasQuemadasSpan = document.getElementById('caloriasQuemadas');
                caloriasQuemadasSpan.textContent = response.calorias_quemadas.toFixed(2); // Mostrar 2 decimales
                resultadoDiv.style.display = 'block'; // Mostrar el mensaje
            }
        };
        xhr.send(new URLSearchParams(formData)); // Codificar los datos del formulario como parámetros de URL
    });
});
