<?php
// Incluir el archivo de configuración para la conexión a la base de datos
require_once 'config.php';

// Crear la conexión
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se ha enviado una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    // Preparar y ejecutar la consulta
    $stmt = $conn->prepare("DELETE FROM contenido WHERE id_contenido = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Noticia eliminada exitosamente.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
}

$conn->close();
?>
