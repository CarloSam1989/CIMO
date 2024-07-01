<?php
require_once 'crudBolsa.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $empleo_id = $_POST['empleo_id'];
    $nombre_candidato = $_POST['nombre_candidato'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $cv = $_FILES['cv'];

    $aplicarEmpleo = new AplicarEmpleo();
    $aplicarEmpleo->procesarAplicacion($empleo_id, $nombre_candidato, $email, $telefono, $cv);
}
?>