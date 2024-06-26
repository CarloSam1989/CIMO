<?php
$target_dir = "img/carrusel/";
$target_file = $target_dir . basename($_FILES["imagen"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["imagen"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "El archivo no es una imagen.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Lo siento, el archivo ya existe.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["imagen"]["size"] > 500000) {
    echo "Lo siento, tu archivo es demasiado grande.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    echo "Lo siento, solo se permiten archivos JPG, JPEG, PNG y GIF.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Lo siento, tu archivo no fue subido.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
        // Insertar ruta de imagen en la base de datos
        $conn = new mysqli('localhost', 'usuario', 'contraseña', 'base_de_datos');
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }
        $sql = "INSERT INTO carrusel (ruta_imagen) VALUES ('$target_file')";
        if ($conn->query($sql) === TRUE) {
            echo "La imagen ". htmlspecialchars( basename( $_FILES["imagen"]["name"])). " ha sido subida.";
        } else {
            echo "Error al guardar la imagen en la base de datos: " . $conn->error;
        }
        $conn->close();
    } else {
        echo "Lo siento, hubo un error al subir tu archivo.";
    }
}
?>
