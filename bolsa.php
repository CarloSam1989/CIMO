<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bolsa de Trabajo</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bolsa_trabajo.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
            <div class="container-fluid">
                <img src="img/logocimo.ico" alt="Logo" class="navbar-logo">
                <a class="navbar-brand" href="form.html">CIMO</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01"
                    aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Noticias</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contactos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Acerca de</a>
                        </li>
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
                        <div class="dropdown ms-3">
                            <button class="btn btn-link dropdown-toggle text-light" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="#">Configuración del perfil</a></li>
                                <li><a class="dropdown-item" href="#" id="logout">Cerrar sesión</a></li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <main class="container mt-4">
        <h1 class="text-center mb-4">Bolsa de Trabajo</h1>

        <div class="oferta">
            <h2>Desarrollador Web</h2>
            <p><strong>Empresa:</strong> EjemploTech</p>
            <p><strong>Ubicación:</strong> Ciudad de Ejemplo</p>
            <p><strong>Descripción:</strong> Estamos buscando un desarrollador web con experiencia en HTML, CSS y JavaScript. Se requiere conocimientos en frameworks como React o Angular.</p>
            <p><strong>Requisitos:</strong> Experiencia mínima de 2 años, manejo de bases de datos SQL y NoSQL.</p>
            <p><strong>Fecha de publicación:</strong> 17 de junio de 2024</p>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#jobFormModal">Publicar Empleo</button>
        </div>

        <div class="oferta">
            <h2>Diseñador Gráfico</h2>
            <p><strong>Empresa:</strong> CreativosX</p>
            <p><strong>Ubicación:</strong> Ciudad Creativa</p>
            <p><strong>Descripción:</strong> Estamos buscando un diseñador gráfico creativo y proactivo. Debe tener experiencia en Adobe Illustrator, Photoshop y otras herramientas de diseño.</p>
            <p><strong>Requisitos:</strong> Portfolio de trabajos anteriores, capacidad para trabajar en equipo y bajo presión.</p>
            <p><strong>Fecha de publicación:</strong> 15 de junio de 2024</p>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#jobFormModal">Publicar Empleo</button>
        </div>
    </main>

    <footer class="text-center mt-4">
        <p>&copy; 2024 BCDGJS. Todos los derechos reservados.</p>
    </footer>

    <!-- Modal -->
    <div class="modal fade" id="jobFormModal" tabindex="-1" aria-labelledby="jobFormModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="jobFormModalLabel">Formulario de Publicación de Empleo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="post">
                        <div class="mb-3">
                            <label for="empresa" class="form-label">Empresa:</label>
                            <input type="text" id="empresa" name="empresa" class="form-control" required>
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
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha de publicación:</label>
                            <input type="date" id="fecha" name="fecha" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Publicar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
        <script src="js/boton.js"></script>
        <script src="js/cerrar_sesion.js"></script>
</body>
</html>
