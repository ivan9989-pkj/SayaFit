<fieldset>
    <legend>Información del Producto</legend>
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre_producto" name="producto[nombre_producto]" placeholder="Nombre del Producto" value="<?php echo s($producto->nombre_producto);?>">
    <label for="descripcion">Descripcion:</label>
    <textarea name="producto[descripcion]" id="descripcion" cols="30" rows="10"><?php echo s($producto->descripcion)?></textarea>
    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="producto[precio]" placeholder="Precio" value="<?php echo s($producto->precio)?>">
    <fieldset>
        <legend>Categoria</legend>

        <select name="producto[ID_categorias]" id="ID_categorias">
            <option selected value="">--Seleccione la Categoria--</option>
            <?php foreach($categorias as $categoria){?>
                <option <?php echo $producto->ID_categorias=== $categoria->ID_categoria ? 'selected' : ''?> value="<?php echo s($categoria->ID_categoria);?>"><?php echo s($categoria->nombre_categoria). " "  ?></option>
           <?php } ?>
        </select>
    </fieldset>
    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" name="producto[imagen]">
    <?php if($producto->imagen){?>
        <img src="/imagenes/<?php echo $producto->imagen ?>">
    <?php } ?>
    <label for="stock">Stock:</label>
    <input type="number" id="stock" name="producto[stock]" placeholder="Stock" value="<?php echo s($producto->stock)?>">
</fieldset>