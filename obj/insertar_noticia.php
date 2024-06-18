<?php
// Incluir el archivo de configuración para la conexión a la base de datos
require_once 'config.php';

$titulo = $_POST['titulo'];
$cuerpo = $_POST['contenido'];
$tipo = $_POST['opcion'];

// Obtener el id_categoria basado en el tipo seleccionado
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT id_categoria FROM categoria WHERE tipo = ?");
$stmt->bind_param("s", $tipo);
$stmt->execute();
$stmt->bind_result($id_categoria);
$stmt->fetch();
$stmt->close();

// Verificar si se obtuvo un id_categoria válido
if ($id_categoria) {
    $estado = 1; // Asumimos que el estado es activo (1) por defecto

   // Procesar la imagen
    $imagen = $_FILES['imagen']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($imagen);

    // Subir imagen al servidor
    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file)) {
        // Preparar y ejecutar la consulta
        $stmt = $conn->prepare("INSERT INTO contenido (titulo, cuerpo, id_categoria, foto, estado) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisi", $titulo, $cuerpo, $id_categoria, $target_file, $estado);

        if ($stmt->execute()) {
            echo "Nuevo contenido agregado exitosamente.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error al subir la imagen.";
    }

} else {
    echo "Error: Categoría no válida.";
}

$conn->close();
?>
