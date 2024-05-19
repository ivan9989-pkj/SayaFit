<head>
    <link rel="stylesheet" type="text/css" href="../../css/contacto.css" />
</head>


<title>Contacto - Sayafit</title>

<body>
    <div class="contact-container">
        <h1>Contacto</h1>
        <p>¡Hola! Bienvenido a Sayafit, tu gimnasio virtual donde te ayudamos a alcanzar tus metas de salud y
            bienestar desde la comodidad de tu hogar. Si tienes alguna pregunta, sugerencia o simplemente deseas
            ponerte en contacto con nosotros, no dudes en hacerlo a través del formulario a continuación. Estamos
            aquí para ayudarte en todo lo que necesites.</p> <!-- Descripción extendida -->

        <br><br><br>


        <div class="contact-form">
            <form id="form">
                <div class="field">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" id="name" placeholder="Nombre" required>
                </div>
                <div class="field">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" placeholder="Email" required>
                </div>
                <div class="field">
                    <label for="subject">Asunto</label>
                    <input type="text" name="subject" id="subject" placeholder="Asunto" required>
                </div>
                <div class="field">
                    <label for="message">Mensaje</label>
                    <textarea type="text" name="message" id="message" placeholder="Mensaje" required></textarea>
                </div>

                <div class="form-group">
                    <label>Acepto los avisos legales</label>
                    <input type="checkbox" id="legal" name="legal" required>
                </div>

                <input type="submit" id="button" class= "btn btn-success" value="Enviar mensaje">
            </form>
        </div>
    </div>
   
</body>
<script type="text/javascript"
  src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>

<script type="text/javascript">
  emailjs.init('4Wr0vSusUM_PW1ylG')
</script>

<script>
    const btn = document.getElementById('button');

document.getElementById('form')
 .addEventListener('submit', function(event) {
   event.preventDefault();

   btn.value = 'Enviando...';

   const serviceID = 'default_service';
   const templateID = 'template_t663jfv';

   emailjs.sendForm(serviceID, templateID, this)
    .then(() => {
      btn.value = 'Enviar mensaje';
      alert('Mensaje enviado correctamente!');
    }, (err) => {
      btn.value = 'Enviar mensaje';
      alert(JSON.stringify(err));
    });
});
</script>

</html>