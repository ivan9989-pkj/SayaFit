<?php include __DIR__ . '/../layout.php'; ?>

<h1>Carrito de Compras</h1>

<ul>
    <?php foreach ($productosEnCarrito as $producto): ?>
        <li>
            <?php echo $producto['nombre']; ?> - <?php echo $producto['precio']; ?>
            <form method="POST" action="/carrito/eliminar">
                <input type="hidden" name="idProducto" value="<?php echo $producto['id']; ?>">
                <button type="submit">Eliminar</button>
            </form>
            <form method="POST" action="/carrito/actualizar">
                <input type="hidden" name="idProducto" value="<?php echo $producto['id']; ?>">
                <input type="number" name="cantidad" value="1">
                <button type="submit">Actualizar Cantidad</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>

<a href="/carrito/finalizar">Finalizar Compra</a>

<?php include __DIR__ . '/../footer.php'; ?>
