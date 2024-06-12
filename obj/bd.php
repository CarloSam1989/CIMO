<?php
// Incluye el archivo de configuración
include 'config.php';

// Función para establecer la conexión a la base de datos
function conectar() {
    // Crear una conexión a la base de datos
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    return $conn;
}

// Función de inicio de sesión
function login($usuario, $pass) {
    // Conectar a la base de datos
    $conexion = conectar();

    // Preparar la consulta SQL
    $sql = $conexion->prepare("SELECT id_persona, password FROM persona WHERE correo = ?");
    $sql->bind_param("s", $usuario);
    $sql->execute();
    $sql->store_result();

    // Verificar si el usuario existe
    if ($sql->num_rows > 0) {
        // Vincular resultados
        $sql->bind_result($id, $hashed_password);
        $sql->fetch(); // Obtener los resultados

        // Verificar la contraseña
        if (password_verify($pass, $hashed_password)) {
            // Iniciar sesión y almacenar el ID del usuario en la sesión
            session_start();
            $_SESSION['id'] = $id;
            return 1; // Inicio de sesión exitoso
        } else {
            return 0; // Contraseña incorrecta
        }
    } else {
        return 0; // Usuario no encontrado
    }
}
?>
