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
    $conexion=conectar();
    $sql = $conexion->prepare("SELECT * FROM persona WHERE correo = c and password=p ");
    $sql->bind_param("c", $usuario);
    $sql->bind_param("p", $pass);
    $sql->execute();
    $sql->store_result();
    if($sql->num_rows > 0){
        $sql->bind_result($id, $id_persona);
        $sql->bind_result($password, $password);
        $sql->bind_result($correo, $correo);
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