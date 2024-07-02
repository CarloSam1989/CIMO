<?php
require_once 'crudBolsa.php';
if (!class_exists('DatabaseConnection')) {
    die('La clase DatabaseConnection no se pudo importar correctamente.');
}
class CrearNoticia {
    public function insertarNoticia($titulo, $contenido, $foto) {
        $fecha_creacion = date('Y-m-d H:i:s'); // Obtener la fecha y hora actual

        $database = new DatabaseConnection();
        $conn = $database->getConnection();

        $sql = "INSERT INTO noticia (titulo, cuerpo, foto, estado, fecha_creacion) VALUES (?, ?, ?, 1, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $titulo, $contenido, $foto, $fecha_creacion);

        if ($stmt->execute()) {
            $stmt->close();
            $database->closeConnection();
            echo "<script>window.location.href = '../crear_Noticias.php';</script>";

            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            $stmt->close();
            $database->closeConnection();
            return false;
        }
    }
}

class EliminarNoticia {
    public function eliminarNoticia($id) {
        $database = new DatabaseConnection();
        $conn = $database->getConnection();

        $sql = "DELETE FROM noticia WHERE id_contenido = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $stmt->close();
            $database->closeConnection();
            echo "<script>window.location.href = '../crear_Noticias.php';</script>";

            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            $stmt->close();
            $database->closeConnection();
            return false;
        }
    }
}

class NoticiasTabla {
    public function mostrarNoticias() {
        $database = new DatabaseConnection();
        $conn = $database->getConnection();

        $sql = "SELECT id_contenido, titulo, cuerpo, foto FROM noticia";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<table class="table table-striped table-hover text-center">';
            echo '<thead>';
            echo '<tr class="text-center">';
            echo '<th scope="col">#</th>';
            echo '<th scope="col">Título</th>';
            echo '<th scope="col">Contenido</th>';
            echo '<th scope="col">Imagen</th>';
            echo '<th scope="col"></th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td scope="row">' . htmlspecialchars($row["id_contenido"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["titulo"]) . '</td>';
                echo '<td>' . htmlspecialchars(substr($row["cuerpo"], 0, 50)) . '...</td>';
                echo '<td>';
                if ($row['foto']) {
                    echo '<img src="uploads/' . htmlspecialchars($row["foto"]) . '" alt="Noticia" width="80">';
                } else {
                    echo 'No hay ninguna imagen';
                }
                echo '</td>';
                echo '<td>';
                echo '<div class="botones">';
                echo '<button class="bin-button" type="button" data-id="' . $row['id_contenido'] . '" data-bs-toggle="modal" data-bs-target="#eliminarNoticiaModal">';
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
                echo '<button class="edit-button" type="button" data-id="' . $row['id_contenido'] . '" data-titulo="' . htmlspecialchars($row['titulo'], ENT_QUOTES, 'UTF-8') . '" data-contenido="' . htmlspecialchars($row['cuerpo'], ENT_QUOTES, 'UTF-8') . '" data-bs-toggle="modal" data-bs-target="#editarNoticiaModal">';
                echo '<svg class="edit-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">';
                echo '<path d="M3 17.25V21H6.75L17.81 9.94L14.06 6.19L3 17.25Z" fill="white"></path>';
                echo '<path d="M20.71 7.04C21.1 6.65 21.1 6.02 20.71 5.63L18.37 3.29C17.98 2.9 17.35 2.9 16.96 3.29L14.86 5.39L18.61 9.14L20.71 7.04Z" fill="white"></path>';
                echo '</svg>';
                echo '</button>';

                echo '</div>';
                echo '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo "No hay noticias disponibles";
        }

        $database->closeConnection();
    }
}


class EditarNoticia {
    public function actualizarNoticia($id, $titulo, $contenido, $foto = null) {
        $database = new DatabaseConnection();
        $conn = $database->getConnection();

        if ($foto) {
            $sql = "UPDATE noticia SET titulo = ?, cuerpo = ?, foto = ? WHERE id_contenido = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $titulo, $contenido, $foto, $id);
        } else {
            $sql = "UPDATE noticia SET titulo = ?, cuerpo = ? WHERE id_contenido = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $titulo, $contenido, $id);
        }

        if ($stmt->execute()) {
            $stmt->close();
            $database->closeConnection();
            echo "<script>window.location.href = '../crear_Noticias.php';</script>";

            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            $stmt->close();
            $database->closeConnection();
            return false;
        }
    }
}
class TarjetaMostrarNoticia {
    public function mostrarNoticias() {
        $database = new DatabaseConnection();
        $conn = $database->getConnection();

        $sql = "SELECT id_contenido, titulo, cuerpo, foto, fecha_creacion FROM noticia";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="tarjeta_noticia">';
                echo '<div class="tarjeta_header">';
                echo '<h2 class="text-center">' . htmlspecialchars($row["titulo"]) . '</h2>';
                echo '</div>';
                echo '<div class="tarjeta_body">';
                echo '<p class="card-text">' . htmlspecialchars(substr($row["cuerpo"], 0, 100)) . '...</p>';
                echo '<div class="image">';
                if ($row['foto']) {
                    echo '<img src="uploads/' . htmlspecialchars($row["foto"]) . '" alt="Imagen de la noticia">';
                } else {
                    echo '<img src="img/default-image.jpg" alt="Imagen por defecto">';
                }
                echo '</div>';
                echo '</div>';
                echo '<div class="footer">';
                echo '<p class="date">' . htmlspecialchars($row["fecha_creacion"]) . '</p>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "No hay noticias disponibles";
        }

        $database->closeConnection();
    }
}
class TarjetaNoticiaPrincipal {
    public function mostrarNoticias() {
        $database = new DatabaseConnection();
        $conn = $database->getConnection();

        $sql = "SELECT id_contenido, titulo, cuerpo, foto, fecha_creacion FROM noticia";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<div class="cards-container">';
            while ($row = $result->fetch_assoc()) {
                echo '<div class="card col-sm-12 col-md-6">';
                echo '<div class="card-image">';
                if ($row['foto']) {
                    echo '<img src="uploads/' . htmlspecialchars($row["foto"]) . '" alt="Imagen noticia ' . htmlspecialchars($row["id_contenido"]) . '">';
                } else {
                    echo '<img src="img/default-image.jpg" alt="Imagen por defecto">';
                }
                echo '</div>';
                echo '<p class="card-title text-primary">' . htmlspecialchars($row["titulo"]) . '</p>';
                echo '<p class="card-body">' . htmlspecialchars(substr($row["cuerpo"], 0, 100)) . '... <a href="mostrar_Noticias.php">Leer más</a></p>';
                echo '<p class="footer">';
                echo '<span class="date">' . htmlspecialchars(date("d/m/Y", strtotime($row["fecha_creacion"]))) . '</span>';
                echo '</p>';
                echo '</div>';
            }
            echo '</div>';
        } else {
            echo "No hay noticias disponibles";
        }

        $database->closeConnection();
    }
}
?>
