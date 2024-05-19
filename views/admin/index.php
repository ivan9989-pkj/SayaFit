<?php


session_start();


if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    // Si no está autenticado, redirigir a la página de inicio de sesión
    header('Location: /');
    exit;
}

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

<h1> Bienvenido a la Zona Admin</h1>
<?php 
        $mensaje = mostrarNotificacion( intval( $resultado) );
        if($mensaje) { ?>
            <p class="alerta exito"><?php echo s($mensaje); ?></p>
        <?php } 
    ?>

<a href="/admin/crear"  class="btn btn-crear">Crear Productos</a>

<h2>
        PRODUCTOS
</h2>
<table>
   
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Categoria</th>
            <th>Imagen</th>
            <th>Descripcion</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($productos as $producto): ?>
            <tr>
                <td><?php echo $producto->ID_producto; ?></td>
                <td><?php echo $producto->nombre_producto?></td>
                <td><?php echo $producto->precio . " €" ?></td>
                <td><?php echo $producto->stock; ?></td>
                <td><?php echo $producto->ID_categorias; ?></td>
                <td><img src="../../build/imagenes/<?php echo $producto->imagen; ?>" width="50px" height="50px"></td>
                <td><?php echo $producto->descripcion; ?></td>
                <td>
                <form method="post" action="admin/eliminar" class="w-100">
                    <input type="hidden" name="id" value="<?php echo $producto->ID_producto; ?>">
                    <input type="hidden" name="tipo" value="producto">
                    <input type="submit" class="boton-eliminar" value='Eliminar'>
                </form>
                
                     <a href="/admin/actualizar?id=<?php echo $producto->ID_producto?>" class="boton-actualizar">Actualizar</a>
                

                </td>
                
            </tr>
        <?php endforeach ?>    
    </tbody>
</table>

<a href="/admin/categoria/crear"  class="btn btn-crear">Crear Categoria</a>

<h2>Categorias</h2>
<table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Acciones</th>
            </tr>

        </thead>
        <tbody>
            <?php foreach($categorias as $categoria): ?>
                <tr>
                    <td><?php echo $categoria->ID_categoria; ?></td>
                    <td><?php echo $categoria->nombre_categoria ?></td>
                    <td><?php echo $categoria->descripcion ?></td>
                    <td>
                    <form method="post" action="/admin/categoria/eliminar" class="w-100">
                    <input type="hidden" name="id" value="<?php echo $categoria->ID_categoria; ?>">
                    <input type="hidden" name="tipo" value="categorias">
                    <input type="submit" class="boton-eliminar" value='Eliminar'>
                    </form>
                    
                        <a href="/admin/categoria/actualizar?id=<?php echo $categoria->ID_categoria?>" class="boton-actualizar">Actualizar</a>
                    

                    </td>
                </tr>
            <?php endforeach ?>    
        </tbody>
</table>

