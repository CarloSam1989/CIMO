<?php
include 'obj/bd.php';

function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['usuario']) && isset($_POST['pass'])){
        $usuario = sanitize_input($_POST['usuario']);
        $pass = sanitize_input($_POST['pass']);

        if (login($usuario, $pass)) {
            header('Location: index.html');
            exit();
        } else {
            header('Location: error.html?error=login_failed');
            exit();
        }
    } else {
        header('Location: error.html?error=missing_fields');
        exit();
    }
} else {
    header('Location: error.html?error=invalid_request');
    exit();
}

function login($usuario, $pass) {
    // Conectar a la base de datos usando declaraciones preparadas
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT password FROM usuarios WHERE username = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();
        
        if (password_verify($pass, $hashed_password)) {
            $stmt->close();
            $conn->close();
            return true;
        }
    }

    $stmt->close();
    $conn->close();
    return false;
}
?>
