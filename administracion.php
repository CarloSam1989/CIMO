<?php
  include_once 'obj/bd.php';
  require_once 'obj/crudNoticia.php';
  require_once 'obj/crudBolsa.php';
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['puesto']) && !isset($_POST['editarEmpleo'])) {
        // Inserción de empleo
        $puesto = $_POST['puesto'];
        $ubicacion = $_POST['ubicacion'];
        $descripcion = $_POST['descripcion'];
        $requisitos = $_POST['requisitos'];

        $empleosInsertar = new EmpleosInsertar();
        $empleosInsertar->insertarEmpleo($puesto, $ubicacion, $descripcion, $requisitos);
    }
  } 
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $empleosEliminar = new EmpleosEliminar();
    $empleosEliminar->eliminarEmpleo($id);
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administración</title>
  <link rel="stylesheet" href="css/css_noticia_admin/reset.css">
  <link rel="stylesheet" href="css/css_noticia_admin/variables.css">
  <link rel="stylesheet" href="css/css_noticia_admin/layout.css">
  <link rel="stylesheet" href="css/css_noticia_admin/navbar.css">
  <link rel="stylesheet" href="css/css_noticia_admin/main.css">
  <link rel="stylesheet" href="css/css_noticia_admin/footer.css">
  <link rel="stylesheet" href="css/css_noticia_admin/buttons.css">
  <link rel="stylesheet" href="css/css_noticia_admin/modals.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="icon" type="image/x-icon" href="img/logocimo.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="css/noticias2.css">
</head>

<body> 
  <header>
      <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
          <div class="container-fluid">
              <img src="img/logocimo.ico" alt="Logo" class="navbar-logo">
              <a class="navbar-brand" href="index.php">CIMO</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <?php include_once('obj/bd.php'); ?>
              <div class="collapse navbar-collapse" id="navbarColor01">
                  <ul class="navbar-nav me-auto">
                      <?php if (verificar_sesion()): ?>
                          <li class="nav-item">
                              <a class="nav-link" href="noticias.php">Noticias Creadas</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="bolsa.php">Empleos Creados</a>
                          </li>
                          <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Administrar</a>
                              <div class="dropdown-menu" data-bs-popper="static">
                                  <a class="dropdown-item" href="#" id="agregarNoticia">Noticias</a>
                                  <a class="dropdown-item" href="#" id="crearEmpleo">Empleos</a>
                                  <a class="dropdown-item" href="#" id="mostrarEmpleos">Bacantes</a>
                                  <a class="dropdown-item" href="#" id="">Modal</a>
                              </div>
                          </li>
                      <?php else: ?>
                          <li class="nav-item">
                              <a class="nav-link" href="login.html">Login</a>
                          </li>
                      <?php endif; ?>
                  </ul>
                  <form class="d-flex">
                      <?php if (verificar_sesion()): ?>
                          <div class="dropdown">
                              <button class="btn btn-link dropdown-toggle text-light" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                  <i class="fas fa-user"></i>
                              </button>
                              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                  <li><a class="dropdown-item" href="logout.php">Cerrar sesión</a></li>
                              </ul>
                          </div>
                      <?php endif; ?>
                  </form>
              </div>
          </div>
      </nav>
  </header>
  <h1 class="text-center mb-4" style="margin-top: 50px;">Administración</h1>
  <main class="d-flex">
    <section class="contenedor" id="contenedorNoticia" style="display:none;">
      <div class="table-responsive">
        <div class="table-header">
          <h2>Noticias Creadas</h2>
          <button class="agregar" type="button"  data-bs-toggle="modal" data-bs-target="#crearNoticiaModal">
            <span class="agregar__text">Nuevo</span>
            <span class="agregar__icon">
              <svg class="svg" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                <line x1="12" x2="12" y1="5" y2="19"></line>
                <line x1="5" x2="19" y1="12" y2="12"></line>
              </svg>
            </span>
          </button>
        </div>
        <?php
          $noticiasTabla = new NoticiasTabla();
          $noticiasTabla->mostrarNoticias();
        ?>
      </div>
    </section>
    <section class="contenedor" id="contenedorBolsaTrabajo" style="display:none;">
      <div class="table-responsive">
          <div class="table-header">
            <h2>Empleos creados</h2>
            <button class="agregar" type="button" data-bs-toggle="modal" data-bs-target="#crearEmpleoModal">
              <span class="agregar__text">Nuevo</span>
              <span class="agregar__icon">
                <svg class="svg" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                  <line x1="12" x2="12" y1="5" y2="19"></line>
                  <line x1="5" x2="19" y1="12" y2="12"></line>
                </svg>
              </span>
            </button>
          </div>
          <?php
            $empleosTabla = new EmpleosTabla();
            $empleosTabla->mostrarEmpleos();
          ?>
      </div>  
    </section>
    <section class="contenedor" id="contenedorEmpleos" style="display:none;">
      <div class="table-responsive">
          <div class="table-header">
            <h2>Bacantes</h2>
          </div>
          <?php
            require_once 'obj/crudBolsa.php';

            $mostrarAplicaciones = new MostrarAplicaciones();
            $mostrarAplicaciones->mostrarAplicaciones();
          ?>
      </div>  
    </section>
  </main> 

  <!-- Modal para crear noticias -->
  <div class="modal fade" id="crearNoticiaModal" tabindex="-1" aria-labelledby="crearNoticiaModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="crearNoticiaModalLabel">Crear Noticia</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form id="crearNoticiaForm" action="obj/noticia.php" method="post" enctype="multipart/form-data">
                      <div class="mb-3">
                          <label for="titulo" class="form-label">Título:</label>
                          <input type="text" id="titulo" name="titulo" class="form-control" required>
                      </div>
                      <div class="mb-3">
                          <label for="contenido" class="form-label">Contenido:</label>
                          <textarea id="contenido" name="contenido" rows="4" class="form-control" required></textarea>
                      </div>
                      <div class="mb-3">
                          <label for="imagen" class="form-label">Imagen:</label>
                          <input type="file" id="imagen" name="imagen" class="form-control" accept="image/*">
                      </div>
                      <button type="submit" class="btn btn-primary">Crear Noticia</button>
                  </form>
              </div>
          </div>
      </div>
  </div>
  <!-- Modal para editar noticia -->
  <div class="modal fade" id="editarNoticiaModal" tabindex="-1" aria-labelledby="editarNoticiaModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="editarNoticiaModalLabel">Editar Noticia</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form id="editarNoticiaForm" action="obj/noticia.php" method="post" enctype="multipart/form-data">
                      <input type="hidden" id="editar-noticia-id" name="noticiaId">
                      <div class="mb-3">
                          <label for="editar-titulo" class="form-label">Título:</label>
                          <input type="text" id="editar-titulo" name="titulo" class="form-control" required>
                      </div>
                      <div class="mb-3">
                          <label for="editar-contenido" class="form-label">Contenido:</label>
                          <textarea id="editar-contenido" name="contenido" rows="4" class="form-control" required></textarea>
                      </div>
                      <div class="mb-3">
                          <label for="editar-imagen" class="form-label">Imagen (opcional):</label>
                          <input type="file" id="editar-imagen" name="imagen" class="form-control" accept="image/*">
                      </div>
                      <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                  </form>
              </div>
          </div>
      </div>
  </div>
  <!-- Modal para eliminar noticia -->
  <div class="modal fade" id="eliminarNoticiaModal" tabindex="-1" aria-labelledby="eliminarNoticiaModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="eliminarNoticiaModalLabel">¿ESTÁ SEGURO EN ELIMINAR ESTA NOTICIA?</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <p>¿Está seguro de que desea eliminar todo el contenido de la noticia? Esta acción es irreversible y se perderán todos los datos de ella.</p>
                  <input type="hidden" id="noticiaIdEliminar" value="">
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-danger" id="confirmarEliminarNoticia">Eliminar</button>
              </div>
          </div>
      </div>
  </div>


  <!-- Modal crear empleo -->
  <div class="modal fade" id="crearEmpleoModal" tabindex="-1" aria-labelledby="crearEmpleoModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="jobFormModalLabel">Publicar Empleo</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form action="administracion.php" method="post"> <!-- Cambiado para enviar a administracion.php -->
                      <div class="mb-3">
                          <label for="puesto" class="form-label">Puesto:</label>
                          <input type="text" id="puesto" name="puesto" class="form-control" required>
                      </div>
                      <div class="mb-3">
                          <label for="ubicacion" class="form-label">Ubicación:</label>
                          <input type="text" id="ubicacion" name="ubicacion" class="form-control" required>
                      </div>
                      <div class="mb-3">
                          <label for="descripcion" class="form-label">Descripción:</label>
                          <textarea id="descripcion" name="descripcion" rows="4" class="form-control" required></textarea>
                      </div>
                      <div class="mb-3">
                          <label for="requisitos" class="form-label">Requisitos:</label>
                          <textarea id="requisitos" name="requisitos" rows="4" class="form-control" required></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary">Publicar</button>
                  </form>
              </div>
          </div>
      </div>
  </div>
  <!-- Modal para editar un empleo -->
  <div class="modal fade" id="editarEmpleoModal" tabindex="-1" aria-labelledby="editarEmpleoModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="editarEmpleoModalLabel">Editar Empleo</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form id="editarEmpleoForm" action="administracion.php" method="post">
                      <input type="hidden" id="editar-empleo-id" name="empleoId">
                      <div class="mb-3">
                          <label for="editar-puesto" class="form-label">Puesto:</label>
                          <input type="text" id="editar-puesto" name="puesto" class="form-control" required>
                      </div>
                      <div class="mb-3">
                          <label for="editar-ubicacion" class="form-label">Ubicación:</label>
                          <input type="text" id="editar-ubicacion" name="ubicacion" class="form-control" required>
                      </div>
                      <div class="mb-3">
                          <label for="editar-descripcion" class="form-label">Descripción:</label>
                          <textarea id="editar-descripcion" name="descripcion" rows="4" class="form-control" required></textarea>
                      </div>
                      <div class="mb-3">
                          <label for="editar-requisitos" class="form-label">Requisitos:</label>
                          <textarea id="editar-requisitos" name="requisitos" rows="4" class="form-control" required></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                  </form>
              </div>
          </div>
      </div>
  </div>
  <!-- Modal para eliminar empleo -->
  <div class="modal fade" id="eliminarEmpleo" tabindex="-1" aria-labelledby="eliminarEmpleoLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="eliminarEmpleoLabel">¿ESTÁ SEGURO EN ELIMINAR ESTE EMPLEO?</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <p>¿Está seguro de que desea eliminar todo el contenido del empleo? Esta acción es irreversible y se perderán todos los datos de ella.</p>
                  <input type="hidden" id="empleoIdEliminar" value="">
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-danger" id="confirmarEliminar">Eliminar</button>
              </div>
          </div>
      </div>
  </div>


  <script src="js/administracion.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


  <footer class="text-center mt-4">
    <p>&copy; 2024 BCDGJS. Todos los derechos reservados.</p>
  </footer>

  <script>
    document.getElementById('agregarNoticia').addEventListener('click', function(event) {
      event.preventDefault();
      document.getElementById('contenedorBolsaTrabajo').style.display = 'none'; // Ocultar otra sección
      document.getElementById('contenedorEmpleos').style.display = 'none'; // Ocultar otra sección
      document.getElementById('contenedorNoticia').style.display = 'block'; // Mostrar esta sección
    });

    document.getElementById('crearEmpleo').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('contenedorNoticia').style.display = 'none'; // Ocultar otra sección
        document.getElementById('contenedorEmpleos').style.display = 'none'; // Ocultar otra sección
        document.getElementById('contenedorBolsaTrabajo').style.display = 'block'; // Mostrar esta sección
    });

    document.getElementById('mostrarEmpleos').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('contenedorNoticia').style.display = 'none'; // Ocultar otra sección
        document.getElementById('contenedorBolsaTrabajo').style.display = 'none'; // Ocultar otra sección
        document.getElementById('contenedorEmpleos').style.display = 'block'; // Mostrar esta sección
    });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var empleoIdEliminar;

      // Capturar el ID del empleo al abrir el modal
      document.querySelectorAll('.bin-button').forEach(button => {
          button.addEventListener('click', function() {
              empleoIdEliminar = this.getAttribute('data-id');
              document.getElementById('empleoIdEliminar').value = empleoIdEliminar;
          });
      });

      // Manejar la eliminación del empleo
      document.getElementById('confirmarEliminar').addEventListener('click', function() {
          var id = document.getElementById('empleoIdEliminar').value;

          // Lógica para eliminar el empleo
          var xhr = new XMLHttpRequest();
          xhr.open('POST', 'administracion.php', true);
          xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
          xhr.onload = function () {
              if (xhr.status === 200) {
                  // Redirigir o actualizar la página después de la eliminación
                  window.location.href = 'administracion.php';
              } else {
                  alert('Error al eliminar el empleo.');
              }
          };
          xhr.send('id=' + id);
      });
    });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Capturar el evento al hacer clic en el botón de editar
      document.querySelectorAll('.edit-button').forEach(button => {
          button.addEventListener('click', function() {
              var empleoId = this.getAttribute('data-id');
              var puesto = this.getAttribute('data-puesto');
              var ubicacion = this.getAttribute('data-ubicacion');
              var descripcion = this.getAttribute('data-descripcion');
              var requisitos = this.getAttribute('data-requisitos');

              // Asignar los valores a los campos del modal
              document.getElementById('editar-empleo-id').value = empleoId;
              document.getElementById('editar-puesto').value = puesto;
              document.getElementById('editar-ubicacion').value = ubicacion;
              document.getElementById('editar-descripcion').value = descripcion;
              document.getElementById('editar-requisitos').value = requisitos;
          });
      });
    });

  </script>
  <script>
      document.addEventListener('DOMContentLoaded', function() {
          var noticiaIdEliminar;

          // Capturar el ID de la noticia al abrir el modal
          document.querySelectorAll('.bin-button').forEach(button => {
              button.addEventListener('click', function() {
                  noticiaIdEliminar = this.getAttribute('data-id');
                  document.getElementById('noticiaIdEliminar').value = noticiaIdEliminar;
              });
          });

          // Manejar la eliminación de la noticia
          document.getElementById('confirmarEliminarNoticia').addEventListener('click', function() {
              var id = document.getElementById('noticiaIdEliminar').value;

              // Enviar el formulario para eliminar la noticia
              var form = document.createElement('form');
              form.method = 'POST';
              form.action = 'obj/noticia.php';

              var input = document.createElement('input');
              input.type = 'hidden';
              input.name = 'eliminarNoticiaId';
              input.value = id;

              form.appendChild(input);
              document.body.appendChild(form);
              form.submit();
          });
      });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      document.querySelectorAll('.edit-button').forEach(button => {
          button.addEventListener('click', function() {
              var noticiaId = this.getAttribute('data-id');
              var titulo = this.getAttribute('data-titulo');
              var contenido = this.getAttribute('data-contenido');

              document.getElementById('editar-noticia-id').value = noticiaId;
              document.getElementById('editar-titulo').value = titulo;
              document.getElementById('editar-contenido').value = contenido;
          });
      });
    });

  </script>
</body>
</html>