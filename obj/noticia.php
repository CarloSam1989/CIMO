<?php
require_once 'crudNoticia.php';

function handleFileUpload($file) {
    $uploadDir = '../uploads/';
    $uploadFile = $uploadDir . basename($file['name']);

    if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
        return $uploadFile;
    } else {
        return null;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Crear noticia
    if (isset($_POST['titulo']) && !isset($_POST['noticiaId'])) {
        $titulo = $_POST['titulo'];
        $contenido = $_POST['contenido'];
        $foto = '';

        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $foto = handleFileUpload($_FILES['imagen']);
        }

        $crearNoticia = new CrearNoticia();
        if ($crearNoticia->insertarNoticia($titulo, $contenido, $foto)) {
            echo "<script>alert('Noticia creada exitosamente');</script>";
        } else {
            echo "<script>alert('Error al crear la noticia');</script>";
        }
    }

    // Editar noticia
    if (isset($_POST['noticiaId'])) {
        $id = intval($_POST['noticiaId']);
        $titulo = $_POST['titulo'];
        $contenido = $_POST['contenido'];
        $foto = $_POST['currentFoto'] ?? null; // Obtener la foto actual si no se sube una nueva

        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $foto = handleFileUpload($_FILES['imagen']);
        }

        $editarNoticia = new EditarNoticia();
        if ($editarNoticia->actualizarNoticia($id, $titulo, $contenido, $foto)) {
            echo "<script>alert('Noticia actualizada exitosamente');</script>";
        } else {
            echo "<script>alert('Error al actualizar la noticia');</script>";
        }
    }

    // Eliminar noticia
    if (isset($_POST['eliminarNoticiaId'])) {
        $id = intval($_POST['eliminarNoticiaId']);

        $eliminarNoticia = new EliminarNoticia();
        if ($eliminarNoticia->eliminarNoticia($id)) {
            echo "<script>alert('Noticia eliminada exitosamente');</script>";
        } else {
            echo "<script>alert('Error al eliminar la noticia');</script>";
        }
    }
}
?>
