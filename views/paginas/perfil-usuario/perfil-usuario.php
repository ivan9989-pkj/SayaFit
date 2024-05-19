<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/perfil-usuario.css">
    <title>Perfil de Usuario</title>
</head>

<body>
    <section class="seccion-perfil-usuario">
        <div class="perfil-usuario-header">
            <div class="perfil-usuario-portada" id="portada">
                <div class="perfil-usuario-avatar">
                    <img src="/public/img/avatar perfil mujer.png" alt="img-avatar" id="avatar">
                    <input type="file" id="inputCambiarAvatar" style="display: none;">
                    <button type="button" class="boton-avatar" id="cambiarAvatarBtn">
                        <i class="fa-solid fa-pencil"></i>
                    </button>
                </div>
                <input type="file" id="inputCambiarFondo" style="display: none;">
                <button type="button" class="boton-portada" id="cambiarFondoBtn">
                    <i class="fas fa-image"></i> Cambiar fondo
                </button>
            </div>
        </div>
        <div class="perfil-usuario-body">
            <div class="perfil-usuario-bio">
                <h3 class="titulo">Ithaisa Sánchez González</h3>
                <p class="texto">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
            <div class="perfil-usuario-footer">
                <ul class="lista-datos">
                    <li><i class="icono fas fa-user"></i> Usuario: <span id="nombreUsuario">Ithaisa Sánchez
                            González</span> <button id="cambiarUsuarioBtn"><i class="fas fa-pencil-alt"></i></button>
                    </li>
                    <li><i class="icono fas fa-envelope"></i> Email: <span id="emailUsuario">correo@example.com</span>
                    </li>
                    <li><i class="icono fas fa-lock"></i>Contraseña: <button id="cambiarContrasenaBtn"><i
                                class="fas fa-pencil-alt"></i></button></li>
                </ul>
            </div>
            <!-- <div class="redes-sociales">
            <a href="" class="boton-redes facebook fab fa-facebook-f"><i class="icon-facebook"></i></a>
            <a href="" class="boton-redes twitter fab fa-twitter"><i class="icon-twitter"></i></a>
            <a href="" class="boton-redes instagram fab fa-instagram"><i class="icon-instagram"></i></a>
        </div> -->
        </div>
    </section>

    <script src="https://kit.fontawesome.com/e5d388d5d6.js" crossorigin="anonymous"></script>
    <script src="/public/js/perfil-usuario.js"></script>
</body>

</html>