var personModal = document.getElementById("personModal");
var openPersonModalBtn = document.getElementById("openPersonModalBtn");
var closePersonModalBtn = personModal.getElementsByClassName("close")[0];
var personForm = document.getElementById("personForm");

// Obtener los elementos necesarios para el modal de contenido con select
var contentModal = document.getElementById("contentModal");
var openContentModalBtn = document.getElementById("openContentModalBtn");
var closeContentModalBtn = contentModal.getElementsByClassName("close")[0];
var selectContent = document.getElementById("selectContent");
var selectBtn = document.getElementById("selectBtn");

// Función para abrir el modal de registro de persona
openPersonModalBtn.onclick = function() {
  personModal.style.display = "block";
}

// Función para cerrar el modal de registro de persona
closePersonModalBtn.onclick = function() {
  personModal.style.display = "none";
}

// Función para abrir el modal de contenido con select
openContentModalBtn.onclick = function() {
  contentModal.style.display = "block";
}

// Función para cerrar el modal de contenido con select
closeContentModalBtn.onclick = function() {
  contentModal.style.display = "none";
}

// Cerrar los modales si el usuario hace clic fuera de ellos
window.onclick = function(event) {
  if (event.target == personModal || event.target == contentModal) {
    personModal.style.display = "none";
    contentModal.style.display = "none";
  }
}

// Manejar el envío del formulario de registro de persona
personForm.onsubmit = function(event) {
  event.preventDefault(); // Evitar que el formulario se envíe de manera predeterminada
  // Aquí puedes agregar tu lógica para manejar el envío del formulario de persona, como enviar los datos a un servidor
  // Luego, puedes cerrar el modal si el registro se realiza con éxito
  personModal.style.display = "none";
}

// Manejar la selección en el modal de contenido con select
selectBtn.onclick = function() {
  var selectedOption = selectContent.value;
  // Aquí puedes agregar tu lógica para manejar la opción seleccionada, como mostrar contenido relacionado en la página
  // Luego, puedes cerrar el modal de contenido con select
  contentModal.style.display = "none";
}


