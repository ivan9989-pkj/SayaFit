<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./build/css/login.css">
</head>

<?php foreach($errores as $error): ?>
    <div class="alerta error">
        <?php echo $error; ?>
    </div>
<?php endforeach; ?>

<div class="wrapper">
    <div class="form-wrapper sign-in">
        <form method="POST" name="loginForm" novalidate>
            <h2>Login</h2>
            <div class="input-group">
                <input id="email" name="email" type="email" required>
                <label for="email">E-mail:</label>
            </div>
            <div class="input-group">
                <input id="password" name="password" type="password" required>
                <label for="password">Password:</label>
            </div>
            <button type="submit">Login</button>
            <div class="signUp-link">
                <p>¿No tienes una cuenta? <a href="#" class="signUpBtn-link">Sign Up</a></p>
            </div>
            <div class="google">
                <button type="button" class="boton-google"><a href="/">Volvamos a la Página Principal</a></button>
            </div>
        </form>
    </div>
    <div class="form-wrapper sign-up">
        <form method="POST" name="signUpForm" action="/registro"> <!-- Cambio en el atributo action -->
            <h2>Sign Up</h2>
            <div class="input-group">
                <input id="nombre-input" name="nombre" type="text" required>
                <label for="nombre">Nombre:</label>
            </div>
            <div class="input-group">
                <input id="email-input" name="email" type="email" required>
                <label for="email">Email</label>
            </div>
            <div class="input-group">
                <input id="password-input" name="password" type="password" required>
                <label for="password">Password</label>
            </div>
            <button type="submit">Sign Up</button>
            <div class="signUp-link">
                <p> ¿Ya tienes una cuenta? <a href="#" class="signInBtn-link">Sign Login</a></p>
            </div>
        </form>
    </div>
</div>

<script>
    const signInBtnLink = document.querySelector('.signInBtn-link');
    const signUpBtnLink = document.querySelector('.signUpBtn-link');
    const wrapper = document.querySelectorAll('.wrapper')[0]; // Selecciona el primer .wrapper

    signUpBtnLink.addEventListener('click', () => {
        wrapper.classList.add('active');
    });

    signInBtnLink.addEventListener('click', () => {
        wrapper.classList.remove('active');
    });
</script>
