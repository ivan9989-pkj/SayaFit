
<?php

// En tu vista donde no quieres mostrar el encabezado y el pie de página
$mostrarEncabezado = false;
$mostrarPie = false;

?>



<?php
function calcularCaloriasQuemadas($sexo, $altura, $peso, $ejercicio, $duracion)
{
    // Calcular IMC
    $altura_metros = $altura / 100;
    $imc = $peso / ($altura_metros * $altura_metros);

    // Determinar categoría basada en IMC
    if ($imc < 18.5) {
        $categoria = "Bajo peso";
    } elseif ($imc >= 18.5 && $imc <= 24.9) {
        $categoria = "Normal";
    } elseif ($imc >= 25 && $imc <= 29.9) {
        $categoria = "Sobrepeso";
    } else {
        $categoria = "Obesidad";
    }

    // Calcular calorías quemadas basadas en el ejercicio y duración
    switch ($ejercicio) {
        case "natacion":
            $MET = 7;
            break;
        case "alterofilia":
            $MET = 6;
            break;
        case "correr":
            $MET = 9;
            break;
        case "bicicleta":
            $MET = 8;
            break;
        default:
            $MET = 0;
            break;
    }

    $calorias_quemadas = $MET * $peso * ($duracion / 60); // Convertir duración a horas

    // Devolver resultados
    return array(
        "imc" => $imc,
        "categoria" => $categoria,
        "calorias_quemadas" => $calorias_quemadas
    );
}

// Definir variables para mostrar el resultado
$resultado_texto = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Si es una solicitud POST, calcular las calorías quemadas y mostrar los resultados
    $resultado = calcularCaloriasQuemadas($_POST["sexo"], $_POST["altura"], $_POST["peso"], $_POST["ejercicio"], $_POST["duracion"]);
    $resultado_texto = "¡Has quemado " . $resultado['calorias_quemadas'] . " calorías!";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Calorías Quemadas</title>
    <link rel="stylesheet" href="../../css/calc-kcal.css">
</head>
<style>
    /* Estilos para el mensaje de resultado */
    #resultado {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #f4f4f4;
        color: #333;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        z-index: 9999;
        font-size: 24px;
        display:
            <?php echo ($resultado_texto !== '') ? 'block' : 'none'; ?>;
    }
</style>

<body>
<button id="btnVolverInicio" class="btn-volver">Volver</button>
    <div class="container">
       
        <h1>Calculadora de Calorías Quemadas</h1>
        <form action="/kit-entrenamiento/calc" method="post">
            <label for="sexo">Sexo:</label>
            <select name="sexo" id="sexo">
                <option value="hombre">Hombre</option>
                <option value="mujer">Mujer</option>
            </select>

            <label for="altura">Altura (cm):</label>
            <input type="number" name="altura" id="altura" required>

            <label for="peso">Peso (kg):</label>
            <input type="number" name="peso" id="peso" required>

            <label for="ejercicio">Ejercicio:</label>
            <select name="ejercicio" id="ejercicio">
                <option value="natacion">Natación</option>
                <option value="alterofilia">Levantamiento de pesas (Alterofilia)</option>
                <option value="correr">Correr</option>
                <option value="bicicleta">Bicicleta</option>
            </select>

            <label for="duracion">Duración del ejercicio (minutos):</label>
            <input type="number" name="duracion" id="duracion" required>

            <label for="intensidad">Intensidad del ejercicio (1 al 10):</label>
            <input type="range" name="intensidad" id="intensidad" min="1" max="10" step="1">
            <output for="intensidad" id="intensidadOutput">5</output>

            <input type="submit" value="Calcular">
        </form>
    </div>
    <div id="resultado" style="<?php if ($resultado_texto !== '')
        echo 'display:block;'; ?>">
        <?php echo $resultado_texto; ?>
    </div>

    <script src="../../js/calculadorakcal.js"></script>
    <script>
        document.getElementById('btnVolverInicio').addEventListener('click', function () {
            window.location.href = '/kit-entrenamiento';
        });
    </script>
</body>

</html>