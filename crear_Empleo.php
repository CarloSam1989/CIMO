<?php
    include_once 'obj/bd.php';
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
    <title>Crear Empleo</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/css_noticia_admin/main.css">
    <link rel="stylesheet" href="css/css_noticia_admin/buttons.css">
    <link rel="stylesheet" href="css/css_noticia_admin/noticias.css">
    <link rel="stylesheet" href="css/css_noticia_admin/layout.css">
    <link rel="stylesheet" href="css/css_noticia_admin/variables.css">
    <link rel="icon" type="image/x-icon" href="img/logocimo.ico">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Noticias</a>
                                <div class="dropdown-menu" data-bs-popper="static">
                                    <a class="dropdown-item" href="crear_Noticias.php">Crear Nueva Noticia</a>
                                    <a class="dropdown-item" href="mostrar_noticias.php">Noticias Creadas</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Bolsa de trabajo</a>
                                <div class="dropdown-menu" data-bs-popper="static">
                                    <a class="dropdown-item" href="crear_Empleo.php">Crear Empleo</a>
                                    <a class="dropdown-item" href="mostrar_Bacantes.php">Mostrar Bacantes</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Slaider</a>
                                <div class="dropdown-menu" data-bs-popper="static">
                                    <a class="dropdown-item" href="crear_slider.php">Cargar imágenes</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Usuarios</a>
                                <div class="dropdown-menu" data-bs-popper="static">
                                    <a class="dropdown-item" href="crear_Usuario.php">Administrar Usuarios</a>
                                </div>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="bolsa.php">Bolsa de trabajo</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="login.html">Login</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                    <form class="d-flex">
                        <button class="boton-social" id="social"> 
                            <span class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="33" viewBox="0 0 512 512" height="33">
                                    <g fill-rule="evenodd" clip-rule="evenodd">
                                        <path fill="#3a5ba2" d="m256.23 512c140.58 0 255.77-115.19 255.77-255.77 0-141.046-115.19-256.23-255.77-256.23-141.046 0-256.23 115.184-256.23 256.23 0 140.58 115.184 255.77 256.23 255.77z"></path>
                                        <path fill="#fff" d="m224.023 160.085c0-35.372 28.575-63.946 63.938-63.946h48.072v63.946h-32.199c-8.608 0-15.873 7.257-15.873 15.873v32.192h48.072v63.938h-48.072v144.22h-63.938v-144.22h-48.065v-63.938h48.065z"></path>
                                    </g>
                                </svg>
                            </span>
                            <span class="text1 text-dark">Síguenos</span>
                            <span class="text2">1,2k</span> 
                        </button>
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
    <main class="container text_center mt-4">

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

    </main>
    
  <!-- Modal crear empleo -->
  <div class="modal fade" id="crearEmpleoModal" tabindex="-1" aria-labelledby="crearEmpleoModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="jobFormModalLabel">Publicar Empleo</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form action="crear_Empleo.php" method="post"> <!-- Cambiado para enviar a crear_Empleo.php -->
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
                  <form id="editarEmpleoForm" action="crear_Empleo.php" method="post">
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

    <footer class="text-center mt-4">
        <p>&copy; 2024 BCDGJS. Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="js/boton.js"></script>

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
          xhr.open('POST', 'crear_Empleo.php', true);
          xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
          xhr.onload = function () {
              if (xhr.status === 200) {
                  // Redirigir o actualizar la página después de la eliminación
                  window.location.href = 'crear_Empleo.php';
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

</body>
</html>
