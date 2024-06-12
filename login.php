<?php
include 'bd.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar si las variables están definidas
    if(isset($_POST['usuario']) && isset($_POST['pass'])){
        $usuario = $_POST['usuario'];
        $pass = $_POST['pass'];

        // Intentar iniciar sesión
        if (login($usuario, $pass)) {
            // Redirigir al usuario a la página del menú si el inicio de sesión es exitoso
            header('Location: menu.php');
            exit();
        } else {
            // Redirigir al usuario a la página de error si las credenciales son incorrectas
            header('Location: error.php');
            exit();
        }
    } else {
        // Redirigir al usuario a la página de error si las variables no están definidas
        header('Location: error.php');
        exit();
    }
} else {
    // Redirigir al usuario a la página de error si la solicitud no es de tipo POST
    header('Location: error.php');
    exit();
}
?>
