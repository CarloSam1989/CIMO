<?php
require_once 'config.php';

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

class EmpleosInsertar {
    public function insertarEmpleo($puesto, $ubicacion, $descripcion, $requisitos) {
        $fecha_publicacion = date('Y-m-d');

        $database = new DatabaseConnection();
        $conn = $database->getConnection();

        $sql = "INSERT INTO empleos (Puesto, ubicacion, descripcion, requisitos, fecha_publicacion) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $puesto, $ubicacion, $descripcion, $requisitos, $fecha_publicacion);

        if ($stmt->execute()) {
            $stmt->close();
            $database->closeConnection();
            echo "<script>window.location.href = 'crear_Empleo.php';</script>";

            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            $stmt->close();
            $database->closeConnection();
            return false;
        }
    }
}
class EmpleosEliminar {
    public function eliminarEmpleo($id) {
        $database = new DatabaseConnection();
        $conn = $database->getConnection();

        $sql = "DELETE FROM empleos WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $stmt->close(); 
            $database->closeConnection();
            echo "<script>window.location.href = '../crear_Empleo.php';</script>";

            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            $stmt->close();
            $database->closeConnection();
            return false;
        }
    }
}
class EmpleosActualizar {
    public function actualizarEmpleo($id, $puesto, $ubicacion, $descripcion, $requisitos) {
        $database = new DatabaseConnection();
        $conn = $database->getConnection();

        $sql = "UPDATE empleos SET Puesto = ?, ubicacion = ?, descripcion = ?, requisitos = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $puesto, $ubicacion, $descripcion, $requisitos, $id);

        if ($stmt->execute()) {
            $stmt->close();
            $database->closeConnection();
            echo "<script>window.location.href = 'crear_Empleo.php';</script>";
            exit();
        } else {
            echo "Error al actualizar el empleo: " . $conn->error;
            $stmt->close();
            $database->closeConnection();
            return false;
        }
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['empleoId'])) {
    $id = intval($_POST['empleoId']);
    $puesto = $_POST['puesto'];
    $ubicacion = $_POST['ubicacion'];
    $descripcion = $_POST['descripcion'];
    $requisitos = $_POST['requisitos'];

    $empleosActualizar = new EmpleosActualizar();
    $empleosActualizar->actualizarEmpleo($id, $puesto, $ubicacion, $descripcion, $requisitos);
}
class EmpleosTabla {
    public function mostrarEmpleos() {
        $database = new DatabaseConnection();
        $conn = $database->getConnection();

        $sql = "SELECT id, Puesto, ubicacion, descripcion, requisitos FROM empleos";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<table class="table table-striped table-hover text-center">';
            echo '<thead>';
            echo '<tr class="text-center">';
            echo '<th scope="col">#</th>';
            echo '<th scope="col">Puesto</th>';
            echo '<th scope="col">Ubicación</th>';
            echo '<th scope="col">Descripción</th>';
            echo '<th scope="col">Requisitos</th>';
            echo '<th scope="col"></th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            while($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td scope="row">' . htmlspecialchars($row["id"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["Puesto"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["ubicacion"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["descripcion"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["requisitos"]) . '</td>';
                echo '<td>';
                echo '<div class="botones">';
                echo '<button class="bin-button" type="button" data-id="' . $row['id'] . '" data-bs-toggle="modal" data-bs-target="#eliminarEmpleo">';
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
                echo '<button class="edit-button" type="button" data-id="' . $row['id'] . '" data-puesto="' . htmlspecialchars($row['Puesto'], ENT_QUOTES, 'UTF-8') . '" data-ubicacion="' . htmlspecialchars($row['ubicacion'], ENT_QUOTES, 'UTF-8') . '" data-descripcion="' . htmlspecialchars($row['descripcion'], ENT_QUOTES, 'UTF-8') . '" data-requisitos="' . htmlspecialchars($row['requisitos'], ENT_QUOTES, 'UTF-8') . '" data-bs-toggle="modal" data-bs-target="#editarEmpleoModal">';
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
            echo "No hay empleos disponibles";
        }

        $database->closeConnection();
    }
}
class EmpleosTarjetas {
    public function mostrarEmpleos() {
        $database = new DatabaseConnection();
        $conn = $database->getConnection();

        $sql = "SELECT id, Puesto, ubicacion, descripcion, requisitos, fecha_publicacion FROM empleos";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="oferta">';
                echo '<h2>' . htmlspecialchars($row["Puesto"]) . '</h2>';
                echo '<p><strong>Ubicación:</strong> ' . htmlspecialchars($row["ubicacion"]) . '</p>';
                echo '<p><strong>Descripción:</strong> ' . htmlspecialchars($row["descripcion"]) . '</p>';
                echo '<p><strong>Requisitos:</strong> ' . htmlspecialchars($row["requisitos"]) . '</p>';
                echo '<p><strong>Fecha de publicación:</strong> ' . htmlspecialchars($row["fecha_publicacion"]) . '</p>';
                echo '<button class="btn btn-primary" type="button" onclick="openAplicarEmpleoModal(' . $row['id'] . ')">Aplicar</button>';
                echo '</div>';
            }
        } else {
            echo "No hay empleos disponibles";
        }

        $database->closeConnection();
    }
}
class AplicarEmpleo {
    private $database;

    public function __construct() {
        $this->database = new DatabaseConnection();
    }

    public function procesarAplicacion($empleo_id, $nombre_candidato, $email, $telefono, $cv) {
        $conn = $this->database->getConnection();
        $fecha_aplicacion = date('Y-m-d');
        $cv_url = '';

        // Manejo de la carga del CV
        if (isset($cv) && $cv['error'] === UPLOAD_ERR_OK) {
            $cv_url = '../uploads/' . basename($cv['name']);
            move_uploaded_file($cv['tmp_name'], $cv_url);
            $cv_url = 'uploads/' . basename($cv['name']);
        }

        $sql = "INSERT INTO aplicar_empleo (empleo_id, nombre_candidato, email, telefono, cv_url, fecha_aplicacion) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssss", $empleo_id, $nombre_candidato, $email, $telefono, $cv_url, $fecha_aplicacion);

        if ($stmt->execute()) {
            $stmt->close();
            $this->database->closeConnection();
            echo "<script>alert('Aplicación enviada exitosamente'); window.location.href = '../bolsa.php';</script>";
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            $stmt->close();
            $this->database->closeConnection();
            return false;
        }
    }
}
class MostrarAplicaciones {
    public function mostrarAplicaciones() {
        $database = new DatabaseConnection();
        $conn = $database->getConnection();

        $sql = "SELECT ae.id, e.Puesto, ae.nombre_candidato, ae.email, ae.telefono, ae.cv_url, ae.fecha_aplicacion 
                FROM aplicar_empleo ae 
                JOIN empleos e ON ae.empleo_id = e.id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<table class="table table-striped table-hover text-center">';
            echo '<thead>';
            echo '<tr class="text-center">';
            echo '<th scope="col">#</th>';
            echo '<th scope="col">Puesto</th>';
            echo '<th scope="col">Nombre del Candidato</th>';
            echo '<th scope="col">Email</th>';
            echo '<th scope="col">Teléfono</th>';
            echo '<th scope="col">CV</th>';
            echo '<th scope="col">Fecha de Aplicación</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            while($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td scope="row">' . htmlspecialchars($row["id"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["Puesto"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["nombre_candidato"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["email"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["telefono"]) . '</td>';
                echo '<td><a href="' . htmlspecialchars($row["cv_url"]) . '" target="_blank">Ver CV</a></td>';
                echo '<td>' . htmlspecialchars($row["fecha_aplicacion"]) . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo "No hay aplicaciones disponibles";
        }

        $database->closeConnection();
    }
}
?>
