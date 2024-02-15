<fieldset>
                        <legend>Información Producto</legend>
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" placeholder="Nombre del Producto" value="<?php echo s($producto->nombre);?>">
                        <label for="precio">Precio:</label>
                        <input type="number" id="precio" name="precio" placeholder="Precio" value="<?php echo s($producto->precio);?>">
                        <label for="stock">Stock:</label>
                        <input type="number" id="stock" name="stock" placeholder="Stocks" <?php echo s($producto->stock);?>>
                        <label for="descripcion">Descripción:</label>
                        <textarea name="descripcion" id="descripcion" cols="30" rows="10" ><?php echo s($producto->descripcion);?></textarea>
                        <label for="imagen">Imagen:</label>
                        <input type="file" id="imagen" name="imagen">
                        <input type="submit" value="Crear Propiedad" class="boton-crear">
</fieldset>