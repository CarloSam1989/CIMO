<?php
// Incluye el archivo de configuración
include 'config.php';

function conectar(){
    // Crear una conexión a la base de datos
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

    return $conn;
}

function login($usuario,$pass){
    $pass = password_hash($pass, PASSWORD_DEFAULT);
    $conexion=conectar();
    $sql = $conexion->prepare("SELECT id_persona as id FROM persona WHERE correo = ? ");
    $sql->bind_param("s", $usuario);
    $sql->execute();
    $sql->store_result();
    if($sql->num_rows > 0){
        $sql->bind_result($id, $password);
        if(passowrd_verify($pass, $password)){
            session_start();
            $_SESSION['id']=$id;
            return 1;
        }else{
            return 0;
        }
    }else{
        return 0;
    }
}

?>