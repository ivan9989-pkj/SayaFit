<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de Plan de Dietas - Resultado</title>
    <link rel="stylesheet" href="/public/build/css/stylesdieta.css">
</head>
<body>
    <div class="container">
        <?php
        // Verificar si se ha enviado el formulario
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Recuperar los datos del formulario
            $nombre = $_POST['nombre'];
            $dias = $_POST['dias'];
            $fecha_inicio = $_POST['fecha_inicio'];
            $ingredientes = $_POST['ingredientes'];

            // Aquí iría la lógica para procesar los datos y generar el plan de dietas

            // Por ahora, mostramos un mensaje de confirmación básico
            echo "<h2>¡Plan de dietas generado con éxito para $nombre!</h2>";
            echo "<p>Número de días de entrenamiento por semana: $dias</p>";
            echo "<p>Fecha de inicio: $fecha_inicio</p>";
            echo "<p>Ingredientes que le gustaría incluir: $ingredientes</p>";
        } else {
            // Si no se ha enviado el formulario, mostrar un mensaje de error
            echo "<p>No se ha enviado el formulario correctamente.</p>";
        }
        ?>
        <a href="formulario.html">Volver al formulario</a>
    </div>
</body>
</html>
