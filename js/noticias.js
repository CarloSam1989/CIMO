function openModal(modalId) {
  document.getElementById(modalId).style.display = 'flex';
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
function openEliminarModal(id) {
  document.getElementById('idEliminar').value = id;
  document.getElementById('eliminarModal').style.display = 'block';
}

function closeModal(modalId) {
  document.getElementById(modalId).style.display = 'none';
}

// Función para cargar categorías
function cargarCategorias() {
  fetch('obj/categorias.php')
      .then(response => response.json())
      .then(data => {
          const select = document.getElementById('opcion');
          select.innerHTML = '';
          data.forEach(categoria => {
              const option = document.createElement('option');
              option.value = categoria.id_categoria;
              option.textContent = categoria.tipo;
              select.appendChild(option);
          });
      })
      .catch(error => console.error('Error:', error));
}

function eliminarNoticia() {
  var id = document.getElementById('idEliminar').value;

  // Enviar la solicitud AJAX para eliminar la noticia
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'obj/eliminar_noticia.php', true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
          // Manejar la respuesta del servidor
          alert(xhr.responseText);
          // Recargar la página después de eliminar
          location.reload();
      }
  };
  xhr.send('id=' + id);
}

const editModal = document.getElementById('editModal');
const modal = document.getElementById('editModal');

const closeBtn = document.querySelector('.close-btn'); // Selecciona el botón de cierre

editModal.addEventListener('click', () => {
  modal.style.display = 'block'; // Muestra el modal
});

closeBtn.addEventListener('click', () => {
  modal.style.display = 'none'; // Oculta el modal
});



