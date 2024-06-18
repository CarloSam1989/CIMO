<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Carrusel - CIMO</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/admin.css"> <!-- Estilo personalizado para la administración -->
</head>
<body>
    <header>
        <!-- Aquí puedes incluir el encabezado si lo necesitas -->
    </header>

    <main class="container">
        <h1>Administrar Carrusel</h1>
        <!-- Aquí van los formularios y secciones para administrar el carrusel -->

        <!-- Ejemplo de formulario para agregar una nueva imagen al carrusel -->
        <section id="agregar-imagen">
            <h2>Agregar Imagen</h2>
            <form action="procesar.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="imagen">Seleccionar Imagen</label>
                    <input type="file" class="form-control" id="imagen" name="imagen" required>
                </div>
                <button type="submit" class="btn btn-primary">Agregar Imagen</button>
            </form>
        </section>

        <!-- Aquí se pueden agregar secciones para eliminar, actualizar y visualizar imágenes del carrusel -->

    </main>

    <footer>
        <!-- Pie de página si es necesario -->
    </footer>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
