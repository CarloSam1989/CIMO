function openEliminarModal(id) {
    document.getElementById('idEliminar').value = id;
    document.getElementById('eliminarModal').style.display = 'block';
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

function deleteContent(id) {
    if (confirm('¿Estás seguro de que deseas eliminar esta noticia?')) {
      // Crear un formulario para enviar la solicitud POST
      var form = document.createElement('form');
      form.method = 'POST';
      form.action = 'eliminar.php'; // Asegúrate de que la ruta sea correcta
  
      var input = document.createElement('input');
      input.type = 'hidden';
      input.name = 'idEliminar';
      input.value = id;
  
      form.appendChild(input);
      document.body.appendChild(form);
      form.submit();
    }
}

function openModal(modalId) {
    document.getElementById(modalId).style.display = 'flex';
  }
  
  function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

function agregarTipo() {
    var modal = document.getElementById('agregar');
    modal.style.display = 'block';
}

function cerrarModal() {
    var modal = document.getElementById('agregar');
    modal.style.display = 'none';
}

// Cerrar el modal cuando se hace clic fuera del contenido del modal
window.addEventListener('click', function(event) {
    var modal = document.getElementById('agregar');
    if (event.target === modal) {
        cerrarModal();
    }
});
