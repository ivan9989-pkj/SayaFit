<h2>Productos en Venta</h2>
    <section class="sectio">
        <div class="contenedora-productos">
        <?php foreach($datos as $dato): ?>
    <div class="producto">
        <picture>
            <img src="../../build/imagenes/<?php echo $dato->imagen ?>">
        </picture>
        <div class="contenido-producto">
            <h3><?php echo $dato->nombre ?></h3>
            <p class="descripcion">Descripción:  <?php echo $dato->descripcion ?></p>
                <div class="productos">

                    <p class="precio">Precio:  <?php echo $dato->precio ?> €</p>

                </div>

                <div class="productos">

                    <p class="stock">En venta: <?php echo $dato->stock?></p>

                </div>
                
            
            <a href="" class="boton-negro-block">
                Comprar
            </a>
        </div> <!--contenido-producto -->
    </div><!--producto -->
    <?php endforeach ?>


         </div><!--contenedora-productos -->

    </section>