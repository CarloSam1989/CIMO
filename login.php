<?php
include 'obj/bd.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['usuario']) && isset($_POST['pass'])){
        $usuario = $_POST['usuario'];
        $pass = $_POST['pass'];

        if (login($usuario, $pass)) {
            header('Location: index.php');
            exit();
        } else {
            header('Location: error.php');
            exit();
        }
    } else {
        header('Location: error.php');
        exit();
    }
} else {
    header('Location: error.php');
    exit();
}
?>
