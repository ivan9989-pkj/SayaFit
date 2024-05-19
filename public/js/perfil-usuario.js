const cambiarFondoBtn = document.getElementById('cambiarFondoBtn');
const cambiarAvatarBtn = document.getElementById('cambiarAvatarBtn');
const inputCambiarFondo = document.getElementById('inputCambiarFondo');
const inputCambiarAvatar = document.getElementById('inputCambiarAvatar');
const portada = document.getElementById('portada');
const avatar = document.getElementById('avatar');

cambiarFondoBtn.addEventListener('click', () => {
    inputCambiarFondo.click();
});

cambiarAvatarBtn.addEventListener('click', () => {
    inputCambiarAvatar.click();
});

inputCambiarFondo.addEventListener('change', (event) => {
    const file = event.target.files[0];
    const reader = new FileReader();
    reader.onload = function () {
        portada.style.backgroundImage = `url('${reader.result}')`;
    };
    reader.readAsDataURL(file);
});

inputCambiarAvatar.addEventListener('change', (event) => {
    const file = event.target.files[0];
    const reader = new FileReader();
    reader.onload = function () {
        avatar.src = reader.result;
    };
    reader.readAsDataURL(file);
});

// Cambios de datos 
const cambiarUsuarioBtn = document.getElementById('cambiarUsuarioBtn');
const cambiarContrasenaBtn = document.getElementById('cambiarContrasenaBtn');
const nombreUsuarioSpan = document.getElementById('nombreUsuario');
const emailUsuarioSpan = document.getElementById('emailUsuario');

cambiarUsuarioBtn.addEventListener('click', () => {
    const nuevoNombreUsuario = prompt('Introduce el nuevo nombre de usuario:');
    if (nuevoNombreUsuario) {
        nombreUsuarioSpan.textContent = nuevoNombreUsuario;
        actualizarUsuarioEnServidor(nuevoNombreUsuario);
    }
});

cambiarContrasenaBtn.addEventListener('click', () => {
    const nuevaContrasena = prompt('Introduce la nueva contraseña:');
    if (nuevaContrasena) {
        actualizarContrasenaEnServidor(nuevaContrasena);
    }
});

// Funciones para actualizar en el servidor
function actualizarUsuarioEnServidor(nuevoNombreUsuario) {
    fetch('actualizar-usuario.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ nuevoNombreUsuario })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error al actualizar el nombre de usuario');
        }
        alert('Nombre de usuario actualizado exitosamente.');
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Hubo un problema al actualizar el nombre de usuario.');
    });
}

function actualizarContrasenaEnServidor(nuevaContrasena) {
    fetch('actualizar-passwd.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ nuevaContrasena })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error al actualizar la contraseña');
        }
        alert('Contraseña actualizada exitosamente.');
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Hubo un problema al actualizar la contraseña.');
    });
}
