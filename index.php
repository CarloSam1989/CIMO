<?php 
 include_once 'obj/bd.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CIMO</title>
    <!-- fuente de google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <!-- Resto de css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="img/logocimo.ico">
    <link rel="stylesheet" href="css/carrusel.css">
    <link rel="stylesheet" href="css/cuerpo.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
            <div class="container-fluid">
                <img src="img/logocimo.ico" alt="Logo" class="navbar-logo">
                <a class="navbar-brand" href="#">CIMO</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <?php include_once('obj/bd.php'); ?>
                <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="bolsa.php">Aplicar Empleo</a>
                        </li>
                        <?php if (verificar_sesion()): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="crear_Noticias.php">Crear Noticia</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="crear_Empleo.php">Crear Empleo</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="mostrar_Bacantes.php">Mostrar Bacantes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="slider.php">Slider</a>
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

    <main>
        <div class="carousel-container">
            <div class="carousel-title md-4">Colegio de Ingenieros Mecánicos de El Oro (CIMO)</div>
            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/imagen1.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="img/imagen2.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="img/imagen4.jpg" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <section class="section-cards">
        <?php
        require_once 'obj/crudNoticia.php';

        $tarjetasNoticiasPrincipales = new TarjetaNoticiaPrincipal();
        $tarjetasNoticiasPrincipales->mostrarNoticias();
        ?>    
        </section>        
    </main>

    <footer class="bg-dark text-light">
        <div class="row footer-content">
            <div class="col-12 col-lg-8 order-lg-2">
                <p class="lorem-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Praesent euismod, nisl sit amet consectetur sagittis, nunc nulla aliquet urna,
                    non tincidunt massa eros a tortor. Curabitur vehicula libero nec libero ultricies, 
                    a cursus erat laoreet.Lorem, ipsum dolor sit amet consectetur adipisicing elit. 
                    Quasi reprehenderit, iure ipsam maxime veritatis nihil optio quas eum cum molestias 
                    veniam fugit similique ipsum earum, esse sapiente vel, explicabo qui?
                    Doloribus esse iste, eaque consectetur fugit omnis! Consequuntur assumenda, sit, repudiandae, 
                    libero voluptas eveniet nihil esse molestias tenetur consectetur praesentium voluptate 
                    inventore quos incidunt consequatur numquam ipsum placeat natus quaerat!
                </p>
            </div>
            <div class="col-12 col-lg-4 order-lg-1">
                <form class="form">
                    <p class="form-title">Suscribete con nosotros</p>
                    <div class="input-container">
                        <input type="email" placeholder="Ingrese su email">
                        <span></span>
                    </div>
                    <div class="input-container">
                        <input type="text" placeholder="Ingrese su nombre">
                    </div>
                    <button type="submit" class="submit">
                        Suscribirse
                    </button>
                </form>
            </div>
        </div>
        <p class="footer-copyright">&copy; 2024 BCDGJS. Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <script src="js/carrusel.js"></script>
    <script src="js/boton.js"></script>
    
</body>
</html>