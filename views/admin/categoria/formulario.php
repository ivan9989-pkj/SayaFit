<fieldset>
    <legend>Información Categoria</legend>
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="categorias[nombre_categoria]" placeholder="Nombre del Categoria" value="<?php echo s($categoria->nombre_categoria); ?>">
    <label for="descripcion">Descripción:</label>
    <textarea name="categorias[descripcion]" id="descripcion" cols="30" rows="10"><?php echo s($categoria->descripcion) ?></textarea>
</fieldset>