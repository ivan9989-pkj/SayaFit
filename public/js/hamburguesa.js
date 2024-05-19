$(document).ready(function() {
    // Selección de elementos con jQuery
    const $hamburger = $(".hamburger");
    const $navLinks = $(".nav-links");
    const $links = $(".nav-links li");

    // Selecciona los submenús de "Categorías" y "Nutrición"
    const $submenuCategorias = $('.nav-links li:nth-child(3) ul');
    const $submenuNutricion = $('.nav-links li:nth-child(4) ul');

    // Manejo del evento de clic en el botón de la hamburguesa
    $hamburger.on('click', () => {
        // Oculta los submenús de "Categorías" y "Nutrición"
        $submenuCategorias.hide();
        $submenuNutricion.hide();

        // Anima los enlaces
        $navLinks.toggleClass("open");
        $links.each(function() {
            $(this).toggleClass("fade");
        });

        // Animación del botón de la hamburguesa
        $hamburger.toggleClass("toggle");
    });
});