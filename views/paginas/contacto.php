<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../build/css/style.css">
    <link rel="stylesheet" type="text/css" href="../../build/css/Inicio.css">
    <link rel="stylesheet" type="text/css" href="../../build/css/contacto.css">
</head>
<h2>Si quiere comunicarse con Nosotros Contactenos por aqui</h2>
<form class="contacto" id="form">
    <fieldset>
        <legend>
            Información Personal
        </legend>

        <label for="from_name">Nombre:</label>
        <input type="text" placeholder=" Tu Nombre" name="from_name" id="from_name">

        <label for="email">E-mail:</label>
        <input type="email" placeholder="Tu E-mail" name="email_id" id="email_id">

        <label for="mensaje">Mensaje:</label>
        <textarea name="message" id="message" placeholder="Tu Mensaje" cols="30" rows="10"></textarea>
        <button type="submit" id="button">Enviar</button>
    </fieldset>
</form>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
<script type="text/javascript">
    emailjs.init('INte1CFDC9D5IPyqP');
    
    document.getElementById('button').addEventListener('click', function(event) {
        event.preventDefault();

        this.textContent = 'Enviando...';

        const serviceID = 'default_service';
        const templateID = 'template_r21i4pk';

        emailjs.sendForm(serviceID, templateID, this.form)
            .then(() => {
                this.textContent = 'Enviar';
                alert('¡Enviado!');
            }, (err) => {
                this.textContent = 'Enviar';
                alert(JSON.stringify(err));
            });
    });
</script>