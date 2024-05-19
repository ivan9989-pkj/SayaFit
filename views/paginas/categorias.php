  <!-- CONTENIDO -->

  <?php 
        $ropa_hombre = "../../img/ropa-deportiva-hombre-removebg-preview.png";
        $ropa_mujer = "../../img/ropa-deportiva-mujer-removebg-preview.png";
        $calzado_hombre = "../../img/calzado-hombre.png";
        $calzado_mujer = "../../img/calzado-mujer.png";
        $material_fitness = "../../img/material-fitness.png";
    ?>

    <section class="section">
        <div class="container">
            <h1 class="categorias">CATEGORÍAS</h1>
            <div class="section-cards">
                <div class="section-card">
                <p>ROPA HOMBRE</p>
                <a href="/categorias/ropa_hombre">
                <img src="<?= $ropa_hombre ?>" alt="Ropa de hombre" width ="200" height="200">
                </a>
            </div>
                <div class="section-card">
                <p>ROPA MUJER</p>
                    <a href="/categorias/ropa_mujer">
                        <img src="<?= $ropa_mujer?>" alt="Ropa de mujer" width ="200" height="200">
                    </a>
                </div>

                <div class="section-card">
                <p>CALZADO HOMBRE</p>
                    <a href="/categorias/calzado_hombre">
                        <img src="<?= $calzado_hombre?>" alt="Calzado de hombre" width ="200" height="200">
                    </a>
                </div>

                <div class="section-card">
                <p>CALZADO MUJER</p>
                    <a href="/categorias/calzado_mujer">
                        <img src="<?= $calzado_mujer?>" alt="Calzado de mujer" width ="200" height="200">
                    </a>
                </div>

                <div class="section-card">
                <p>MATERIAL FITNESS</p>
                    <a href="/categorias/material_fitness">
                    <img src="<?= $material_fitness?>" alt="Material Fitness" width ="200" height="200">
                    </a>
                </div>
            </div>
        </div>
    </section>