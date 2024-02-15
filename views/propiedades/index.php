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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../../build/css/style.css">
   
</head>
<body>
    

<h1>Bienvenido  A la Zona Admin</h1>

<?php 
        $mensaje = mostrarNotificacion( intval( $resultado) );
        if($mensaje) { ?>
            <p class="alerta exito"><?php echo s($mensaje); ?></p>
        <?php } 
    ?>

<a href="/propiedades/crear" class="boton-regreso2">Crear Productos</a>
<br>

<table class="admin-tabla">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Imagen</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Acciones</th>

        </tr>
    </thead>
    <tbody>
    <?php foreach ($productos as $producto): ?>
        <tr>
            <td><?php echo $producto->id; ?></td>
            <td><?php echo $producto->nombre ?></td>
            <td><img src="../../build/imagenes/<?php echo $producto->imagen ?>" width="50px" height="50px"></td>
            <td><?php echo $producto->precio . " €" ?></td>
            <td><?php echo $producto->stock ?></td>
            <td>
                <form method="post" action="propiedades/eliminar" class="w-100">
                    <input type="hidden" name="id" value="<?php echo $producto->id; ?>">
                    <input type="hidden" name="tipo" value="producto">
                    <input type="submit" class="boton-eliminar" value='Eliminar'>
                </form>
                
                     <a href="/propiedades/actualizar?id=<?php echo $producto->id?>" class="boton-actualizar">Actualizar</a>
                

            </td>
        </tr>
        
    <?php endforeach ?>
</tbody>

</table>




<!-- <script type="text/javascript">
     function confirmEliminado() {
            return window.confirm( '¿Seguro que quiere borrar la propiedad?' );
        }
</script> -->
</body>
</html>