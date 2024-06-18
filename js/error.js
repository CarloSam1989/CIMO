

// Redireccionar automáticamente después de 3 segundos
setTimeout(function(){
    window.location.href = 'login.html'; // Cambia 'login.php' a la URL correcta de tu página de login
}, 3000); // Redireccionar después de 3 segundos (3000 milisegundos)

// Función para redireccionar al hacer clic en el botón
function redirectLogin() {
    window.location.href = 'login.html'; // Cambia 'login.php' a la URL correcta de tu página de login
}