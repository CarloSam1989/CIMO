<?php
// Incluye el archivo de configuración
include 'config.php';

// Función para conectar a la base de datos
function conectar(){
    // Crear una conexión a la base de datos
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    return $conn;
}

// Función de inicio de sesión
function login($usuario, $pass){
    $conexion = conectar();
    $sql = $conexion->prepare("SELECT id_persona, password FROM persona WHERE correo = ?");
    if (!$sql) {
        die("Error en la preparación de la consulta: " . $conexion->error);
    }
    
    $sql->bind_param("s", $usuario);
    $sql->execute();
    $sql->store_result();

    if ($sql->num_rows > 0) {
        $sql->bind_result($id, $hashed_password);
        $sql->fetch(); // Obtener resultados

        if (password_verify($pass, $hashed_password)) {
            session_start();
            $_SESSION['id'] = $id;
            header('Location: menu.php');
            exit();
        }
    }
    header('Location: error.php');
    exit();
}

// Redirección si el usuario está logueado
function verificar_sesion() {
    session_start();
    if (!isset($_SESSION['id'])) {
        header('Location: index.php');
        exit();
    }
}
?>
