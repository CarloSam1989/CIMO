<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CIMO - Reportes</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="img/logocimo.ico">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/tabla .css">
    <link rel="stylesheet" href="css/menu.css">
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
                            <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="33" viewBox="0 0 512 512"
                                    height="33">
                                    <g fill-rule="evenodd" clip-rule="evenodd">
                                        <path fill="#3a5ba2"
                                            d="m256.23 512c140.58 0 255.77-115.19 255.77-255.77 0-141.046-115.19-256.23-255.77-256.23-141.046 0-256.23 115.184-256.23 256.23 0 140.58 115.184 255.77 256.23 255.77z">
                                        </path>
                                        <path fill="#fff"
                                            d="m224.023 160.085c0-35.372 28.575-63.946 63.938-63.946h48.072v63.946h-32.199c-8.608 0-15.873 7.257-15.873 15.873v32.192h48.072v63.938h-48.072v144.22h-63.938v-144.22h-48.065v-63.938h48.065z">
                                        </path>
                                    </g>
                                </svg></span>
                            <span class="text1 text-dark">Síguenos</span>
                            <span class="text2">1,2k</span>
                        </button>
                        <div class="dropdown ms-3">
                            <button class="btn btn-link dropdown-toggle text-light" type="button"
                                id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
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
        <h2 class="text-center mb-4">Subir Reportes</h2>
        <div class="table-responsive">
            <table id="reportes" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Datos de ejemplo -->
                    <tr>
                        <td>1</td>
                        <td>Reporte de ventas</td>
                        <td>2024-06-01</td>
                        <td>
                            <button class="btn btn-primary btn-sm ver-btn">Ver</button>
                            <button class="btn btn-eliminar btn-sm eliminar-btn">Eliminar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Reporte de inventario</td>
                        <td>2024-06-02</td>
                        <td>
                            <button class="btn btn-primary btn-sm ver-btn">Ver</button>
                            <button class="btn btn-eliminar btn-sm eliminar-btn">Eliminar</button>
                        </td>
                    </tr>
                    <!-- Agrega más filas según sea necesario -->
                </tbody>
            </table>
        </div>
    </main>
    <footer class="text-center mt-4">
        <p>&copy; 2024 BCDGJS. Todos los derechos reservados.</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $('#reportes').DataTable({
                "language": { "url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json" }
            });

            $('#reportes').on('click', '.ver-btn', function () {
                var tr = $(this).closest('tr');
                var data = tr.find('td');
                var details = `
                    <tr class="details-row">
                        <td colspan="4">
                            <table class="table">
                                <tr><th>ID</th><td>${data.eq(0).text()}</td></tr>
                                <tr><th>Nombre</th><td>${data.eq(1).text()}</td></tr>
                                <tr><th>Fecha</th><td>${data.eq(2).text()}</td></tr>
                            </table>
                        </td>
                    </tr>
                `;

                // Remove existing detail rows
                tr.next('.details-row').remove();

                // Add the details row after the current row
                tr.after(details);
            });

            $('#reportes').on('click', '.eliminar-btn', function () {
                var row = $(this).closest('tr');
                var toast = new bootstrap.Toast(document.querySelector('.toast'));

                $('.btn-se').on('click', function () {
                    if ($(this).hasClass('btn-primary')) {
                        // Eliminar el reporte
                        row.remove();
                        toast.hide();
                        // Mostrar notificación de eliminación exitosa
                        $('.toast-eliminado').toast('show');
                    } else if ($(this).hasClass('btn-secondary')) {
                        // Si el botón es "Cancelar", simplemente cierra el toast.
                        toast.hide();
                    }
                });

                toast.show(); // Mostrar la notificación después de configurar los botones.
            });
        });
    </script>
    <script src="js/boton.js"></script>
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">Eliminar Reporte</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            ¿Estás seguro de que deseas eliminar este reporte?
            <div class="mt-2 pt-2 border-top">
                <button type="button" class="btn btn-primary btn-se">Aceptar</button>
                <button type="button" class="btn btn-secondary btn-se" data-bs-dismiss="toast">Cancelar</button>
            </div>
        </div>
    </div>
    <!-- Notificación de eliminación exitosa -->
    <div class="toast toast-eliminado" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body">
            Se ha eliminado el reporte correctamente.
            <div class="mt-2 pt-2 border-top">
                <button type="button" class="btn btn-primary btn-se" data-bs-dismiss="toast">Aceptar</button>
            </div>
        </div>
    </div>
    <script src="js/boton.js"></script>
    <script src="js/cerrar_sesion.js"></script>

</body>

</html>