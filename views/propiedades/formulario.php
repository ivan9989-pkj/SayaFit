<fieldset>
                        <legend>Información Producto</legend>
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="producto[nombre]" placeholder="Nombre del Producto" value="<?php echo s( $producto->nombre); ?>">
                        <label for="precio">Precio:</label>
                        <input type="number" id="precio" name="producto[precio]" placeholder="Precio" value="<?php echo s($producto->precio); ?>">
                        <label for="stock">Stock:</label>
                        <input type="number" id="stock" name="producto[stock]" placeholder="Stocks" value="<?php echo s($producto->stock) ?>">
                        <label for="imagen">Imagen:</label>
                        <input type="file" id="imagen" name="producto[imagen]">
                        <?php if($producto->imagen) { ?>
                            <img src="/imagenes/<?php echo $producto->imagen ?>" class="imagen-small">
                        <?php } ?>
                        <label for="descripcion">Descripción:</label>
                        <textarea name="producto[descripcion]" id="descripcion" cols="30" rows="10"><?php echo s($producto->descripcion) ?></textarea>
</fieldset>