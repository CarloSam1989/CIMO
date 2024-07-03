
<?php
$servername = "tu_servidor";
$username = "tu_usuario";
$password = "tu_contraseña";
$dbname = "tu_base_de_datos";

try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        throw new Exception("Conexión fallida: " . $conn->connect_error);
    }

    $sql = "SELECT id, ruta_imagen FROM carrusel";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '
            <div class="col-md-4">
                <div class="card">
                    <img src="' . $row['ruta_imagen'] . '" class="card-img-top" alt="Imagen ' . $row['id'] . '">
                    <div class="card-body">
                        <form action="actualizar.php" method="POST" enctype="multipart/form-data" class="mb-2">
                            <input type="hidden" name="id" value="' . $row['id'] . '">
                            <div class="mb-3">
                                <label for="imagen' . $row['id'] . '" class="form-label">Actualizar Imagen</label>
                                <input type="file" class="form-control" id="imagen' . $row['id'] . '" name="imagen" required>
                            </div>
                            <button type="submit" class="btn btn-warning">Actualizar</button>
                        </form>
                        <form action="eliminar.php" method="POST">
                            <input type="hidden" name="id" value="' . $row['id'] . '">
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>';
        }
    } else {
        echo '<p>No hay imágenes en el carrusel.</p>';
    }

    $conn->close();
} catch (Exception $e) {
    echo '<p>Error al conectar con la base de datos: ' . $e->getMessage() . '</p>';
}
?>
