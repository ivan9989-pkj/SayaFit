<?php


session_start();

// Verificar sesión
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header('Location: /'); // Redirigir al usuario a la página de inicio de sesión si no está autenticado
    exit;
}

// Si el usuario intenta acceder a /admin sin estar autenticado, redirigirlo a la página actual
if ($_SERVER['REQUEST_URI'] === '/admin' && (!isset($_SESSION['login']) || $_SESSION['login'] !== true)) {
    header('Location: ' . $_SERVER['REQUEST_URI']);
    exit;
}

?>

<main class="contenedor-crear">
        <h1> Crear Producto</h1>
        <?php foreach($errores as $error){ ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
        <?php } ?>
        <br>
        <a href="../admin" class="boton-regreso">Volver Admin</a>
        <form class="formularios" method="POST"  enctype="multipart/form-data">
            <?php include __DIR__.'/formulario.php' ?>
            <input type="submit" value="Crear Producto" class="boton-crear">
        </form>
</main>

