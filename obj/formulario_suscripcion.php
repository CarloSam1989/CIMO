<?php
include 'obj/bd.php'; // Archivo de conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

    if ($email && $name) {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO subscribers (email, name) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $name);

        if ($stmt->execute()) {
            header('Location: thank_you.html'); // Redirige a una página de agradecimiento
        } else {
            header('Location: error.html?error=subscription_failed');
        }

        $stmt->close();
        $conn->close();
    } else {
        header('Location: error.html?error=invalid_input');
    }
} else {
    header('Location: error.html?error=invalid_request');
}
?>
