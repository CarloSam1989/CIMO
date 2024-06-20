function openEliminarModal(id) {
    document.getElementById('idEliminar').value = id;
    document.getElementById('eliminarModal').style.display = 'block';
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
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

function openEditModal(id, titulo, contenido, foto) {
    document.getElementById('id_contenido').value = id;
    document.getElementById('titulo').value = titulo;
    document.getElementById('contenido').value = contenido;
    // Si deseas mostrar la foto actual, puedes hacerlo aquí
    var modal = document.getElementById('editModal');
    modal.style.display = 'block';
}

function closeModal(modalId) {
    var modal = document.getElementById(modalId);
    modal.style.display = 'none';
}

// Cerrar el modal cuando se hace clic fuera del contenido del modal
window.addEventListener('click', function(event) {
    var modals = document.querySelectorAll('.modal');
    modals.forEach(function(modal) {
        if (event.target === modal) {
            closeModal(modal.id);
        }
    });
});
