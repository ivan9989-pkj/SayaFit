<?php


session_start();

// Verificar sesión
if (
    isset($_SESSION['usuario']) && 
    substr($_SESSION['usuario'], -11) !== '@sayafit.com'
) {
    // Si el usuario está autenticado y su email no termina en "@sayafit.com", redirigir a la página de inicio de sesión
    header('Location: /');
    exit;
}


// Si el usuario intenta acceder a /admin sin estar autenticado, redirigirlo a la página actual
if ($_SERVER['REQUEST_URI'] === '/admin' && (!isset($_SESSION['login']) || $_SESSION['login'] !== true)) {
    header('Location: ' . $_SERVER['REQUEST_URI']);
    exit;
}


?>


<head>
<link rel="stylesheet" type="text/css" href="../../css/admin.css" />
</head>



<main>
    <h1>Actualizar Categoria</h1>
    <?php foreach($errores as $error){ ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>

    <?php } ?>

    <a href="/admin" class="btn btn-volver" style="margin-left: -350px;">Volver Admin</a>
    <form method="POST" enctype="multipart/form-data">
        <?php include __DIR__ . '/formulario.php';?>
        <input type="submit" value="Actualizar Categoria" class="boton-crear">
    </form>

</main>