const wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-link');

registerLink.onclick = (event) => {
    event.preventDefault(); // Evita el comportamiento predeterminado del enlace
    wrapper.classList.add('active');
};

loginLink.onclick = (event) => {
    event.preventDefault(); // Evita el comportamiento predeterminado del enlace
    wrapper.classList.remove('active');
};