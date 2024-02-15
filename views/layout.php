<?php
// Iniciar sesión si no está iniciada
if (!isset($_SESSION)) {
    session_start();
}
// Verificar si el usuario está autenticado
$auth = $_SESSION['login'] ?? false;



// Verificar la ruta actual
$rutaActual = $_SERVER['REQUEST_URI'];
$mostrarHeaderFooter = strpos($rutaActual, '/login') === false; // Mostrará true si no estamos en la página /login
// Verificar la ruta actual
$rutaActual2 = $_SERVER['REQUEST_URI'];
$mostrarHeaderFooter2 = strpos($rutaActual, '/login') === false; // Mostrará true si no estamos en la página /login

// Mostrar el encabezado y el pie de página solo si no estamos en la página /login
if ($mostrarHeaderFooter && $mostrarHeaderFooter2) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../build/css/style.css">
    <link rel="stylesheet" type="text/css" href="../../build/css/productos.css">
    <script src="../../build/js/login.js"></script>
</head>
<body>
    
    <header class="heade  ">
        <div class="contenedor">
            <div class="barra">
                <a href="/">
                    <img class="Foto-logo" src="../../build/img/Foto-logo.png" alt="Logotipo de SayaSport">
                </a>

                <div class="derecha">
                    <img src="" alt="">
                    <nav class="navegador">
                        <a href="/">Inicio</a>
                        <a href="/nosotros">Nosotros</a>
                        <a href="/productos">Productos</a>
                        <a href="/contacto">Contacto</a>
                        <?php 
                        if ($auth) {
                            echo '<a href="/logout">Cerrar Sesión</a>';
                        } else {
                            echo '<a href="/login">Login</a>';
                        }
                        ?>
                    </nav>
                </div>

            </div>
        </div>
    
    </header>




<?php
} // Fin del if que verifica si se debe mostrar el header y el footer

echo $contenido; // Mostrar el contenido de la página

if ($mostrarHeaderFooter && isset($mostrarFooter) && $mostrarFooter) {
    include __DIR__ . "/footer.php"; // Incluir el footer solo si no estamos en la página /login
}

if ($mostrarHeaderFooter) {
?>
</body>
</html>



<?php
} // Fin del if que verifica si se debe mostrar el header y el footer
?>
