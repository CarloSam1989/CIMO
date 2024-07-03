<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Carrusel - CIMO</title>
    <!-- Fuente de Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <!-- Resto de CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="img/logocimo.ico">
    <link rel="stylesheet" href="css/carrusel.css">
    <link rel="stylesheet" href="css/cuerpo.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/admin.css"> <!-- Estilo personalizado para la administración -->
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
            <div class="container-fluid">
                <img src="img/logocimo.ico" alt="Logo" class="navbar-logo">
                <a class="navbar-brand" href="form.html">CIMO</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
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
                        <li class="nav-item">
                            <a class="nav-link" href="#">Slaider</a>
                        </li>                               
                    </ul>
                    <form class="d-flex">
                        <button class="boton-social" id="social"> 
                          <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="33" viewBox="0 0 512 512" height="33"><g fill-rule="evenodd" clip-rule="evenodd"><path fill="#3a5ba2" d="m256.23 512c140.58 0 255.77-115.19 255.77-255.77 0-141.046-115.19-256.23-255.77-256.23-141.046 0-256.23 115.184-256.23 256.23 0 140.58 115.184 255.77 256.23 255.77z"></path><path fill="#fff" d="m224.023 160.085c0-35.372 28.575-63.946 63.938-63.946h48.072v63.946h-32.199c-8.608 0-15.873 7.257-15.873 15.873v32.192h48.072v63.938h-48.072v144.22h-63.938v-144.22h-48.065v-63.938h48.065z"></path></g></svg></span>
                          <span class="text1 text-dark">Síguenos</span>
                          <span class="text2">1,2k</span> 
                        </button>
                        <a href="logout.php" class="btn-login"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>                       
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <main class="container">
        <h1>Administrar Carrusel</h1>
        
        <!-- Sección para agregar una nueva imagen al carrusel -->
        <section id="agregar-imagen">
            <h2>Agregar Imagen</h2>
            <form action="procesar.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="imagen" class="form-label">Seleccionar Imagen</label>
                    <input type="file" class="form-control" id="imagen" name="imagen" required>
                </div>
                <button type="submit" class="btn btn-primary">Agregar Imagen</button>
            </form>
        </section>

        <!-- Sección para visualizar imágenes del carrusel -->
        <section id="visualizar-imagenes">
            <h2>Imágenes del Carrusel</h2>
            <div class="row">
            <?php
                include 'obj/bd.php';
                include 'obj/conexion.php'

                ?>
            </div>
        </section>
    </main>

    <footer class="bg-dark text-light text-center py-3">
        &copy; 2024 CIMO. Todos los derechos reservados.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
