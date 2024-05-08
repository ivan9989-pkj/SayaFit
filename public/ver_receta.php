<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Receta - Sayafit</title>
    <link rel="stylesheet" href="/public/build/css/stylesdieta.css">
</head>
<body>
    <div class="container">
        <?php
        // Verificar si se ha proporcionado el parámetro "titulo" en la URL
        if (isset($_GET['titulo'])) {
            // Recupera el título de la receta desde la URL
            $titulo_receta = $_GET['titulo'];

            // Aquí deberías conectar con la base de datos y obtener los detalles de la receta
            // Por ejemplo:
            $sql = "SELECT * FROM recetas WHERE titulo = '$titulo_receta'";
            $resultado = $conexion->query($sql);

            // Si la receta existe en la base de datos, mostrar sus detalles
            // Si no, mostrar un mensaje de error
            $receta_encontrada = true; 
            if ($receta_encontrada) {
                echo "<h1>$titulo_receta</h1>";
                echo "<p><strong>Preparación:</strong></p>";
                echo "<p>Aquí iría la preparación de la receta.</p>";
            } else {
                echo "<p>No se encontró la receta.</p>";
            }
        } else {
            echo "<p>No se proporcionó el título de la receta.</p>";
        }
        ?>
        <a href="javascript:history.go(-1)">Volver</a>
    </div>
</body>
</html>
