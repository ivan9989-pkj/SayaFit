<?php

// En tu vista donde no quieres mostrar el encabezado y el pie de página
$mostrarEncabezado = false;
$mostrarPie = false;

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/rutinas.css">
    <title>Asignador de Rutina de Gimnasio</title>
</head>
<body>
<button id="btnVolverInicio" class="btn-volver">Volver</button>

    <h1>Asignador de Rutina de Gimnasio - Sayafit</h1>
    <form id="rutinaForm">
        <label for="diasSemana">¿Cuántos días a la semana planeas entrenar?</label>
        <input type="number" id="diasSemana" name="diasSemana" min="1" max="7" required><br><br>
        
        <label for="objetivo">¿Cuál es tu objetivo?</label>
        <select id="objetivo" name="objetivo" required>
            <option class="black-text-option" value="masa">Ganar masa muscular</option>
            <option class="black-text-option"value="perder">Perder peso</option>
            <option class="black-text-option" value="mantenimiento">Mantenimiento de cuerpo</option>
        </select><br><br>

        <button type="submit">Generar Rutina</button>
    </form>

    <div id="rutinaContainer" style="display:none;">
        <h2>Rutina de Entrenamiento:</h2>
        <table>
            <thead>
                <tr>
                    <th>Día</th>
                    <th>Grupo Muscular</th>
                    <th>Ejercicios</th>
                    <th>Series y Repeticiones</th>
                </tr>
            </thead>
            <tbody id="rutinaTexto"></tbody>
        </table>
    </div>
    <script src="../../js/rutinas.js"></script>
    <script>
             document.getElementById('btnVolverInicio').addEventListener('click', function () {
            window.location.href = '/kit-entrenamiento';
        });
    </script>
</body>
</html>