
<?php

// En tu vista donde no quieres mostrar el encabezado y el pie de página
$mostrarEncabezado = false;
$mostrarPie = false;

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../../css/login.css" />
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
  <title>LOGIN |sayafit</title>
</head>

<body class=" flex justify-center items-center min-h-screen">

<button id="btnVolverInicio" class="btn-volver">Volver al inicio</button>

  <div class="wrapper">
    <span class="bg-animate"></span>
    <span class="bg-animate2"></span>
    
    <!-- FORMULARIO INICIAR SESION -->

    <div class="form-box login">
      <h2 class="animation text-3xl text-white items-center" style="--i:0; --j:21">Iniciar sesión</h2>
      <form method="POST" name="loginForm" novalidate>
        <div class="input-box animation relative w-full h-12 my-6" style="--i:1; --j:22;">
          <input type="email" name="email" required />
          <label>Usuario</label>
          <i class="fa-solid fa-user"></i>
        </div>
        <div class="input-box animation" style="--i:2; --j:23;">
          <input type="password" name="passwd" required />
          <label>Contraseña</label>
          <i class="fa-solid fa-lock"></i>
        </div>
        <button type="submit" class="btn animation" style="--i:3; --j:24;">Iniciar Sesión</button>
        <div class="logreg-link animation" style="--i:4; --j:25;">
          <p>
            ¿No tienes cuenta? <a href="" class="register-link">Regístrate</a>
          </p>
        </div>
      </form>
    </div>
    <div class="info-text login">
      <h2 class="animation" style="--i:0;">¡Hola amig@!</h2>
      <p class="animation" style="--i:1;">Nos alegra verte de nuevo.</p>
    </div>

    <!-- FORMULARIO DE REGISTRO -->

    <div class="form-box register">
      <h2 class="animation" style="--i:17; --j:0;">Regístrate</h2>
      <form method="POST" name="signUpForm" action="/registro">
        <div class="input-box animation" style="--i:18; --j:1;">
          <input type="text" name="nombre" required />
          <label>Usuario</label>
          <i class="fa-solid fa-user"></i>
        </div>
        <div class="input-box animation" style="--i:19; --j:2;">
          <input type="email" name="email" required />
          <label>Email</label>
          <i class="fa-solid fa-envelope"></i>
        </div>
        <div class="input-box animation" style="--i:20; --j:3;">
          <input type="password" name="passwd" required />
          <label>Contraseña</label>
          <i class="fa-solid fa-lock"></i>
        </div>
        <button type="submit" class="btn animation" style="--i:21; --j:4;">Regístrate</button>
        <div class="logreg-link animation" style="--i:22; --j:5;">
          <p>
            ¿Ya tienes cuenta?
            <a href="" class="login-link">Iniciar Sesión</a>
          </p>
        </div>
      </form>
    </div>
    <div class="info-text register">
      <h2 class="animation" style="--i:17; --j:0;">Hola amig@!</h2>
      <p class="animation" style="--i:18; --j:1;">Nos alegra volver a verte. </p>
    </div>
  </div>

 

  <!-- SCRIPTS -->
  <script src="../../js/script.js"></script>
  <script src="https://kit.fontawesome.com/e5d388d5d6.js" crossorigin="anonymous"></script>
  <script>
    document.getElementById('btnVolverInicio').addEventListener('click', function() {
    window.location.href = '../index.php';
  });
  </script>
  
</body>

</html>
