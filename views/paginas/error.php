
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
    <link rel="stylesheet" href="../../css/404.css">
    <title>404 Page Not Found</title>
</head>
<body>
    <div class="error-container">
        <canvas id="rainfall"></canvas>
        <h1 class="error-title">404</h1>
        <i class="fa-solid fa-face-sad-tear"></i>
        <i class="fa-solid fa-face-sad-tear"></i>
        <i class="fa-solid fa-face-sad-tear"></i>
        <i class="fa-solid fa-face-sad-tear"></i>

        
        <span class="animate-blink"><p class="error-text"><i class="fa-solid fa-x"></i></span>No se encontró la página <span class="animate-blink"><i class="fa-solid fa-x"></i>
        </span></p>
    </div>
    <script src="https://kit.fontawesome.com/e5d388d5d6.js" crossorigin="anonymous"></script>
    <script src="../../js/error404.js"></script>
</body> 
</html>
