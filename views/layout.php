<?php
// Iniciar sesión si no está iniciada
if (!isset($_SESSION)) {
    session_start();
}
// Verificar si el usuario está autenticado
$auth = $_SESSION['login'] ?? false;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet"/>
    <link rel="shortcut icon" href="../../img/LOGO SAYAFIT ISA (1).ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../../css/style.css" />
    <link rel="stylesheet" type="text/css" href="../../css/productos.css" />
    <title>SAYAFIT</title>
</head>
<body>
   
<?php if ($mostrarEncabezado ?? true): ?>
    <!-- NAVEGADOR -->
    <nav>
      <!-- LOGO -->
      <div class="logo">
        <a href="/"
          ><img src="/img/LOGO SAYAFIT ISA (1).png" alt="logo"
        /></a>
      </div>
      <div class="hamburger">
        <div class="line1"></div>
        <div class="line2"></div>
        <div class="line3"></div>
      </div>
      <ul class="nav-links">
        <li><a href="/nosotros">NOSOTROS</a></li>
        <li><a href="/categorias">CATEGORÍAS</a>
          <!-- <ul>
            <li>Ropa hombre</li>
            <li>Ropa mujer</li>
            <li>Calzado hombre</li>
            <li>Calzado mujer</li>
            <li>Material fitness</li>
          </ul> -->
        </li>
        <li><a href="/nutricion">NUTRICIÓN</a>
          <!-- <ul>
            <li>Alimentación</li>
            <li>Barritas</li>
            <li>Bebidas y suplementos</li>
            <li>Geles energéticas</li>
            <li>Mezcladores</li>
            <li>Té e infusiones</li>
          </ul> -->
        </li>
        <li><a href="/kit-entrenamiento">KIT-ENTRENAMIENTO</a></li>
        <li><a href="/contacto">CONTACTO</a></li>
        <li>
        <?php
        if($auth){
          if (isset($_SESSION['usuario']) && substr($_SESSION['usuario'], -11) !== '@sayafit.com') {
          
           } else{
             echo '<a href="/admin">Admin</a>';
           }
        }
          ?>
        </li>
        <li>
        <?php
        if($auth){
          echo ' <a class="login-button" href="/logout">Cerrar sesión</a>';
        }else{
          echo ' <a class="login-button" href="/login">Login</a>';
        }
        ?>
        </li>
      </ul>
    </nav>
<?php endif; ?>

<?php echo $contenido; ?>

<?php if ($mostrarPie ?? true): ?>
    <!-- BOTONES REDES -->
    <div class="buttons">
        <button class="buttons__toggle"><i class="fa fa-share-alt"></i></button>
        <div class="allbtns">
            <a class="button" href="https://www.instagram.com/gym_sayafit/"><i class="fa-brands fa-instagram"></i>Instagram</a>
            <a class="button" href="https://www.youtube.com/channel/UCGx0olEt69AAmBMPQ58MCwA"><i class="fa-brands fa-youtube"></i>YouTube</a>
            <a class="button" href=""><i class="fa-brands fa-tiktok"></i>TikTok</a>
        </div>
    </div>

    <footer class="redes">
        <div class="iconos-redes">
            <a class="icono" href="https://www.instagram.com/gym_sayafit/"><i class="fa-brands fa-instagram"></i></a>
            <a class="icono" href="https://www.youtube.com/channel/UCGx0olEt69AAmBMPQ58MCwA"><i class="fa-brands fa-youtube"></i></a>
            <a class="icono" href="https://www.tiktok.com/@sayafit"><i class="fa-brands fa-tiktok"></i></a>
        </div>

        &copy Todos los derechos reservados 2024

  <div class="texto-legales">
  <a href="/textos/cookies" target="_blank">Cookies</a>
  |
  <a href="/textos/aviso_legal" target="_blank" >Aviso legal</a>
  |
  <a href="/textos/politica" target="_blank">Política de privacidad</a>
  </footer>
<?php endif; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="../../js/hamburguesa.js"></script>
<script src="../../js/buttons.js"></script>
<script src="../../js/error404.js"></script>
<script src="https://kit.fontawesome.com/e5d388d5d6.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="../../js/main.js"></script>
</body>
</html>