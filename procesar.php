<?php
// Conexión a la base de datos (suponiendo que ya tienes la conexión configurada)

// Manejo de la subida de imágenes
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["imagen"])) {
    $targetDir = "uploads/"; // Directorio donde se guardarán las imágenes
    $targetFile = $targetDir . basename($_FILES["imagen"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

    // Verificar si el archivo es una imagen real
    $check = getimagesize($_FILES["imagen"]["tmp_name"]);
    if($check !== false) {
        echo "El archivo es una imagen - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "El archivo no es una imagen.";
        $uploadOk = 0;
    }

    // Verificar si el archivo ya existe
    if (file_exists($targetFile)) {
        echo "Lo siento, el archivo ya existe.";
        $uploadOk = 0;
    }

    // Verificar el tamaño máximo del archivo (opcional)
    if ($_FILES["imagen"]["size"] > 500000) {
        echo "Lo siento, el archivo es muy grande.";
        $uploadOk = 0;
    }

    // Permitir ciertos formatos de archivo (puedes ajustarlo según tus necesidades)
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Lo siento, solo se permiten archivos JPG, JPEG, PNG y GIF.";
        $uploadOk = 0;
    }

    // Verificar si $uploadOk está establecido en 0 por un error
    if ($uploadOk == 0) {
        echo "Lo siento, tu archivo no fue subido.";
    // Si todo está bien, intenta subir el archivo
    } else {
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $targetFile)) {
            echo "El archivo ". htmlspecialchars( basename( $_FILES["imagen"]["name"])). " ha sido subido.";
            // Aquí puedes guardar la información en la base de datos y relacionarla con el carrusel
        } else {
            echo "Lo siento, hubo un error al subir tu archivo.";
        }
    }
}
?>
