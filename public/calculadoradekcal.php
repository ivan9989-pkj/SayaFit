<?php
function calcularCaloriasQuemadas($sexo, $altura, $peso, $ejercicio, $duracion) {
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

// Verificar si se envió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Si es una solicitud POST, calcular las calorías quemadas y devolver los resultados como JSON
    $resultado = calcularCaloriasQuemadas($_POST["sexo"], $_POST["altura"], $_POST["peso"], $_POST["ejercicio"], $_POST["duracion"]);
    echo json_encode($resultado);
}
?>
