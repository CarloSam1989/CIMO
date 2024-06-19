<?php
$id = $_POST['id'];

// Conectar a la base de datos y obtener la ruta de la imagen
$conn = new mysqli('localhost', 'usuario', 'contraseña', 'base_de_datos');
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
$sql = "SELECT ruta_imagen FROM carrusel WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$ruta_imagen = $row['ruta_imagen'];

// Eliminar la imagen del servidor
if (file_exists($ruta_imagen)) {
    unlink($ruta_imagen);
}

// Eliminar la entrada de la base de datos
$sql = "DELETE FROM carrusel WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    echo "La imagen ha sido eliminada.";
} else {
    echo "Error al eliminar la imagen de la base de datos: " . $conn->error;
}
$conn->close();
?>
