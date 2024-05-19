<?php

$alimentacion = "../../img/alimentacion.png";
$barritas = "../../img/barritas.png";
$bebidas_y_suplementos = "../../img/bebidas y suplementos.png";
$geles_energéticas = "../../img/geles-energeticos.png";
$mezcladores = "../../img/mezcladores.png";
$te_e_infusiones = "../../img/te-e-infusiones.png";

?>


<section class="section">
        <div class="container">
            <h1 class="categorias">NUTRICIÓN</h1>
            <div class="section-cards">
                <div class="section-card">
                    <p>ALIMENTACIÓN</p>
                        <a href="/nutricion/alimentacion">
                            <img src="<?= $alimentacion ?>"  alt="alimentacion" width="200" height="150">
                        </a>
                </div>
                <div class="section-card">
                    <p>BARRITAS</p>
                    <a href="/nutricion/barritas">
                        <img src="<?= $barritas ?>" alt="barritas" width="200" height="150">
                    </a>
                </div>

                <div class="section-card">
                    <p>BEBIDAS Y SUPLEMENTOS</p>
                    <a href="/nutricion/bebidas-y-suplementos">
                        <img src="<?= $bebidas_y_suplementos ?>" alt="bebidas y suplementos" width="200" height="150">
                    </a>
                </div>

                <div class="section-card">
                    <p>GELES ENERGÉTICAS</p>
                    <a href="/nutricion/geles-energetica">
                        <img src="<?= $geles_energéticas ?>" alt="geles energeticas" width="200" height="150">
                    </a>
                </div>

                <div class="section-card">
                    <p>MEZCLADORES</p>
                    <a href="/nutricion/mezcladores">
                    <img src="<?= $mezcladores ?>" alt="mezcladores" width="200" height="150">
                    </a>
                </div>

                <div class="section-card">
                    <p>TÉ E INFUSIONES</p>
                    <a href="/nutricion/te-e-infusiones">
                        <img src="<?= $te_e_infusiones?>" alt="te e infusiones" width="200" height="150">
                    </a>
                </div>
            </div>
        </div>
    </section>