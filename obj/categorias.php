<?php
// Incluir el archivo de configuración para la conexión a la base de datos
require_once 'config.php';

// Crear la conexión
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener las categorías
$result = $conn->query("SELECT id_categoria, tipo FROM categoria WHERE estado = 1");

$categorias = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categorias[] = $row;
    }
}

// Devolver las categorías en formato JSON
echo json_encode($categorias);

$conn->close();
?>
