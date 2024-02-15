<?php
    if(!isset($_SESSION)){
        session_start();
    }
    $auth=$_SESSION['login'] ?? false;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../build/css/style.css">
   
</head>
<body>
    
    <header class="heade">
                    <div class="contenedor">
                        <div class="barra">
                            <a href="/">
                                <img class="Foto-logo" src="../../build/img/Foto-logo.png" alt="Logotipo de SayaSport">
                            </a>
    
                            <div class="derecha">
                                <img src="" alt="">
                                <nav class="navegador">
                                    <a href="/">Inicio</a>
                                    <a href="/nosotros.php">Nosotros</a>
                                    <a href="/productos.php">Productos</a>
                                    <a href="/contactos.php">Contacto</a>
                                    <a href="/carrito.php">Carrito</a>
                                    <?php 
                                    if($auth){?>
                                    <a href="../../cerrar-sesion.php">Cerrar Sesión</a>
                                    <?php } else { ?>
                                        <a href="../../login.php">Login</a>
                                    <?php }?>
                                </nav>
                            </div>
    
                        </div>
                    </div>
    
    </header>
</body>
</html>


