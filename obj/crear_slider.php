<?php
require_once 'crudBolsa.php'; // Ajusta la ruta según tu estructura de archivos

if (!class_exists('DatabaseConnection')) {
    die('La clase DatabaseConnection no se pudo importar correctamente.');
}
class CrearImagen {
    public function insertarImagen($ruta_imagen) {
        $database = new DatabaseConnection();
        $conn = $database->getConnection();

        $sql = "INSERT INTO carrusel (ruta_imagen) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $ruta_imagen);

        if ($stmt->execute()) {
            $stmt->close();
            $database->closeConnection();
            echo "<script>window.location.href = '../crear_slider.php';</script>";
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            $stmt->close();
            $database->closeConnection();
            return false;
        }
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
        $target_dir = "../uploads/"; // Asegúrate de que esta ruta es correcta y tiene permisos de escritura
        $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Verificar si el archivo es una imagen real o falsa
        $check = getimagesize($_FILES["imagen"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "El archivo no es una imagen.";
            $uploadOk = 0;
        }

        // Permitir ciertos formatos de archivo
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Lo siento, solo se permiten archivos JPG, JPEG, PNG y GIF.";
            $uploadOk = 0;
        }

        // Verificar si $uploadOk es 0 por un error
        if ($uploadOk == 0) {
            echo "Lo siento, tu archivo no fue subido.";
        // Si todo está bien, intentar subir el archivo
        } else {
            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
                $imagen = new CrearImagen();
                $imagen->insertarImagen($target_file);
            } else {
                echo "Lo siento, hubo un error al subir tu archivo.";
            }
        }
    } else {
        echo "No se ha enviado ninguna imagen o hubo un error en la subida.";
    }
}
class CarruselTabla {
    public function mostrarImagenes() {
        $database = new DatabaseConnection();
        $conn = $database->getConnection();

        $sql = "SELECT id, ruta_imagen FROM carrusel";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<table class="table table-striped table-hover text-center">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>ID</th>';
            echo '<th>Imagen</th>';
            echo '<th>Acciones</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td scope="row">' . htmlspecialchars($row["id"]) . '</td>';
                echo '<td><img src="uploads/' . htmlspecialchars($row["ruta_imagen"]) . '" alt="Imagen" width="80"></td>';
                echo '<td class="text-center">';
                echo '<div class="botones d-flex flex-column align-items-center">';
                echo '<button class="bin-button" type="button" data-id="' . $row['id'] . '" data-bs-toggle="modal" data-bs-target="#eliminarImagen">';
                echo '<svg class="bin-top" viewBox="0 0 39 7" fill="none" xmlns="http://www.w3.org/2000/svg">';
                echo '<line y1="5" x2="39" y2="5" stroke="white" stroke-width="4"></line>';
                echo '<line x1="12" y1="1.5" x2="26.0357" y2="1.5" stroke="white" stroke-width="3"></line>';
                echo '</svg>';
                echo '<svg class="bin-bottom" viewBox="0 0 33 39" fill="none" xmlns="http://www.w3.org/2000/svg">';
                echo '<mask id="path-1-inside-1_8_19" fill="white">';
                echo '<path d="M0 0H33V35C33 37.2091 31.2091 39 29 39H4C1.79086 39 0 37.2091 0 35V0Z"></path>';
                echo '</mask>';
                echo '<path d="M0 0H33H0ZM37 35C37 39.4183 33.4183 43 29 43H4C-0.418278 43 -4 39.4183 -4 35H4H29H37ZM4 43C-0.418278 43 -4 39.4183 -4 35V0H4V35V43ZM37 0V35C37 39.4183 33.4183 43 29 43V35V0H37Z" fill="white" mask="url(#path-1-inside-1_8_19)"></path>';
                echo '<path d="M12 6L12 29" stroke="white" stroke-width="4"></path>';
                echo '<path d="M21 6V29" stroke="white" stroke-width="4"></path>';
                echo '</svg>';
                echo '</button>';
                echo '</div>';
                echo '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo "No hay imágenes disponibles";
        }

        $database->closeConnection();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['imagenIdEliminar'];
    $database = new DatabaseConnection();
    $conn = $database->getConnection();

    // Obtener la ruta de la imagen para eliminar el archivo
    $sql = "SELECT ruta_imagen FROM carrusel WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($ruta_imagen);
    $stmt->fetch();
    $stmt->close();

    // Eliminar el archivo de la imagen
    if (file_exists("../uploads/" . $ruta_imagen)) {
        unlink("../uploads/" . $ruta_imagen);
    }

    // Eliminar el registro de la base de datos
    $sql = "DELETE FROM carrusel WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $stmt->close();
        $database->closeConnection();
        echo "<script>window.location.href = '../crear_slider.php';</script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        $stmt->close();
        $database->closeConnection();
        return false;
    }
}

class MostrarSlider {
    public function obtenerImagenes() {
        $database = new DatabaseConnection();
        $conn = $database->getConnection();

        $sql = "SELECT ruta_imagen FROM carrusel";
        $result = $conn->query($sql);

        $imagenes = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $imagenes[] = $row['ruta_imagen'];
            }
        }

        $database->closeConnection();
        return $imagenes;
    }

    public function generarSliderHTML() {
        $imagenes = $this->obtenerImagenes();
        $active = 'active';
        
        if (empty($imagenes)) {
            $imagenes = ['../img/imagen1.jpg', '../img/imagen2.jpg', '../img/imagen3.jpg'];
        }

        $html = '';

        foreach ($imagenes as $imagen) {
            $ruta = 'uploads/' . htmlspecialchars($imagen);
            if (!file_exists($ruta)) {
                static $counter = 0;
                $defaultImages = ['../img/imagen1.jpg', '../img/imagen2.jpg', '../img/imagen3.jpg'];
                $ruta = $defaultImages[$counter % count($defaultImages)];
                $counter++;
            }
            $html .= '<div class="carousel-item ' . $active . '">';
            $html .= '<img src="' . $ruta . '" class="d-block w-100" alt="...">';
            $html .= '</div>';
            $active = '';
        }
        return $html;
    }
}
?>
