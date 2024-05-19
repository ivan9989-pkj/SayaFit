<!-- C A R D S -->
 
<div class="product-container">
 <?php foreach($datos as $dato): ?>
<div class="product-card-fitness">
    <img class="img-fitness" src="../../build/imagenes/<?php echo $dato['imagen'] ?>" alt="Imagen del producto">
    <div class="product-info">
        <h3><?php echo $dato['nombre_producto'] ?></h3>
        <p><?php echo $dato['descripcion'] ?></p>
        <p>Stock: <span><?php echo $dato['stock'] ?></span></p>
        <p>Precio: <span><?php echo $dato['precio'] ?>€</span></p>

        <form action="/carrito" method="post">
            <input type="hidden" name="product_id" value="<?php echo $dato['ID_producto']; ?>">
            <input type="number" name="quantity" value="1" min="1">
            <button type="submit" class="btn-add-carrito">Agregar al Carrito</button>
        </form>
    </div>
</div>
<?php endforeach;?>
</div>