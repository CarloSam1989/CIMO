<?php
    include_once 'obj/bd.php';
    require_once 'obj/crudUsuario.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
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
                        <li class="nav-item">
                            <a class="nav-link" href="bolsa.php">Bolsa de trabajo</a>
                        </li>
                        <?php if (verificar_sesion()): ?>
                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Administrar</a>
                            <div class="dropdown-menu" data-bs-popper="static">
                                <a class="dropdown-item" href="crear_Noticias.php">Crear Nueva Noticia</a>
                                <a class="dropdown-item" href="mostrar_noticias.php">Noticias Creadas</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="crear_Empleo.php">Crear Empleo</a>
                                <a class="dropdown-item" href="mostrar_Bacantes.php">Mostrar Bacantes</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="crear_slider.php">Slider</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="crear_Usuario.php">Crear Usuario</a>
                            </div>
                        </li>
                        <?php else: ?>
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
                <h2>Usuarios</h2>
                <button class="agregar" type="button" data-bs-toggle="modal" data-bs-target="#agregarUsuario">
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
        $usuariosTabla = new MostrarUsuarios();
        $usuariosTabla->mostrarUsuarios();
        ?>
    </div>   

    </main>
    
<!-- Modal para agregar un usuario -->
<div class="modal fade" id="agregarUsuario" tabindex="-1" aria-labelledby="agregarUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarUsuarioLabel">Agregar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="obj/crudUsuario.php" method="post">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido:</label>
                    <input type="text" id="apellido" name="apellido" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="cedula" class="form-label">Cédula:</label>
                    <input type="text" id="cedula" name="cedula" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo:</label>
                    <input type="email" id="correo" name="correo" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Agregar</button>
            </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal para eliminar un usuario -->
<div class="modal fade" id="eliminarUsuario" tabindex="-1" aria-labelledby="eliminarUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <form action="obj/crudUsuario.php" method="post">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminarUsuarioLabel">¿ESTÁ SEGURO EN ELIMINAR EL USUARIO?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Está seguro de que desea eliminar este usuario? Esta acción es irreversible y se perderán todos los datos de él.</p>
                <input type="hidden" id="usuarioIdEliminar" name="usuarioIdEliminar" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger" id="confirmarEliminar">Eliminar</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- Modal para editar un usuario -->
<div class="modal fade" id="editarUsuario" tabindex="-1" aria-labelledby="editarUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarUsuarioLabel">Editar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="obj/crudUsuario.php" method="post">
                <input type="hidden" id="usuarioIdEditar" name="usuarioIdEditar" value="">
                <div class="mb-3">
                    <label for="nombreEditar" class="form-label">Nombre:</label>
                    <input type="text" id="nombreEditar" name="nombreEditar" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="apellidoEditar" class="form-label">Apellido:</label>
                    <input type="text" id="apellidoEditar" name="apellidoEditar" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="cedulaEditar" class="form-label">Cédula:</label>
                    <input type="text" id="cedulaEditar" name="cedulaEditar" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="passwordEditar" class="form-label">Contraseña:</label>
                    <input type="text" id="passwordEditar" name="passwordEditar" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="correoEditar" class="form-label">Correo:</label>
                    <input type="email" id="correoEditar" name="correoEditar" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </form>

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
            var eliminarButtons = document.querySelectorAll('.eliminar-button');
            eliminarButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var id = button.getAttribute('data-id');
                    document.getElementById('usuarioIdEliminar').value = id;
                });
            });

            var editarButtons = document.querySelectorAll('.edit-button');
            editarButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var id = button.getAttribute('data-id');
                    var nombre = button.getAttribute('data-nombre');
                    var apellido = button.getAttribute('data-apellido');
                    var cedula = button.getAttribute('data-cedula');
                    var correo = button.getAttribute('data-correo');
                    var password = button.getAttribute('data-password'); // Añadir la contraseña

                    document.getElementById('usuarioIdEditar').value = id;
                    document.getElementById('nombreEditar').value = nombre;
                    document.getElementById('apellidoEditar').value = apellido;
                    document.getElementById('cedulaEditar').value = cedula;
                    document.getElementById('correoEditar').value = correo;
                    document.getElementById('passwordEditar').value = password; // Mostrar la contraseña
                });
            });
        });
    </script>
   
</body>
</html>
