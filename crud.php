<?php

require_once 'obj/config.php';

class DatabaseConnection {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        $this->conn->close();
    }
}

class ContentCreator {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function addContent($titulo, $cuerpo, $tipo, $imagen) {
        $stmt = $this->conn->prepare("SELECT id_categoria FROM categoria WHERE tipo = ?");
        $stmt->bind_param("s", $tipo);
        $stmt->execute();
        $stmt->bind_result($id_categoria);
        $stmt->fetch();
        $stmt->close();

        if ($id_categoria) {
            $estado = 1;

            $target_dir = "uploads/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $target_file = $target_dir . basename($imagen['name']);

            if (move_uploaded_file($imagen['tmp_name'], $target_file)) {
                $stmt = $this->conn->prepare("INSERT INTO contenido (titulo, cuerpo, id_categoria, foto, estado) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("ssisi", $titulo, $cuerpo, $id_categoria, $target_file, $estado);

                if ($stmt->execute()) {
                    return 'Nuevo contenido agregado exitosamente.';
                } else {
                    return 'Error: ' . $stmt->error;
                }
                $stmt->close();
            } else {
                return 'Error al subir la imagen.';
            }
        } else {
            return 'Categoría no válida.';
        }
    }
}

class ContentDeleter {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function deleteContent($id) {
        $stmt = $this->conn->prepare("DELETE FROM contenido WHERE id_contenido = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return "Noticia eliminada exitosamente.";
        } else {
            return "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

class ContentEditor {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function editContent($id, $titulo, $cuerpo, $imagen) {
        if (empty($id) || empty($titulo) || empty($cuerpo)) {
            return 'Error: Faltan datos en el formulario.';
        }

        // Verificar si se subió una nueva imagen
        if ($imagen && $imagen['error'] == UPLOAD_ERR_OK) {
            $target_dir = "uploads/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $target_file = $target_dir . basename($imagen['name']);

            if (move_uploaded_file($imagen['tmp_name'], $target_file)) {
                $stmt = $this->conn->prepare("UPDATE contenido SET titulo = ?, cuerpo = ?, foto = ? WHERE id_contenido = ?");
                $stmt->bind_param("sssi", $titulo, $cuerpo, $target_file, $id);
            } else {
                return 'Error al subir la imagen.';
            }
        } else {
            $stmt = $this->conn->prepare("UPDATE contenido SET titulo = ?, cuerpo = ? WHERE id_contenido = ?");
            $stmt->bind_param("ssi", $titulo, $cuerpo, $id);
        }

        if ($stmt->execute()) {
            return 'Noticia editada exitosamente.';
        } else {
            error_log('Error: ' . $stmt->error); // Log del error
            return 'Error: ' . $stmt->error;
        }

        $stmt->close();
    }
}

//mostrar categoría
class CategoryManager {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getActiveCategories() {
        $result = $this->conn->query("SELECT id_categoria, tipo FROM categoria WHERE estado = 1");

        if ($result->num_rows > 0) {
            $categories = [];
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }
            return $categories;
        } else {
            return [];
        }
    }

    public function addCategory($categoria, $estado) {
        $stmt = $this->conn->prepare("INSERT INTO categoria (tipo, estado) VALUES (?, ?)");
        $stmt->bind_param("si", $categoria, $estado);

        if ($stmt->execute()) {
            return 'Nueva categoría agregada exitosamente.';
        } else {
            return 'Error: ' . $stmt->error;
        }

        $stmt->close();
    }
}

class ContentManager {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getContents() {
        $result = $this->conn->query("SELECT id_contenido, titulo, cuerpo, foto, fecha_creacion FROM contenido");

        if ($result->num_rows > 0) {
            $contents = [];
            while ($row = $result->fetch_assoc()) {
                $contents[] = $row;
            }
            return $contents;
        } else {
            return [];
        }
    }
}

?>