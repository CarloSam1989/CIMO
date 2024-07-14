<?php
require_once 'crudBolsa.php'; // Ajusta la ruta según tu estructura de archivos

if (!class_exists('DatabaseConnection')) {
    die('La clase DatabaseConnection no se pudo importar correctamente.');
}

class AgregarUsuario {
    public function insertarUsuario($nombre, $apellido, $cedula, $password, $correo) {
        $database = new DatabaseConnection();
        $conn = $database->getConnection();

        $hashedPassword = md5($password);

        $sql = "INSERT INTO persona (nombre, apellido, cedula, password, correo) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $nombre, $apellido, $cedula, $hashedPassword, $correo);

        if ($stmt->execute()) {
            $stmt->close();
            $database->closeConnection();
            echo "<script>window.location.href = '../crear_Usuario.php';</script>";
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            $stmt->close();
            $database->closeConnection();
            return false;
        }
    }
}

class EditarUsuario {
    public function actualizarUsuario($id_persona, $nombre, $apellido, $cedula, $password, $correo) {
        $database = new DatabaseConnection();
        $conn = $database->getConnection();

        $hashedPassword = md5($password);

        $sql = "UPDATE persona SET nombre = ?, apellido = ?, cedula = ?, password = ?, correo = ? WHERE id_persona = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $nombre, $apellido, $cedula, $hashedPassword, $correo, $id_persona);

        if ($stmt->execute()) {
            $stmt->close();
            $database->closeConnection();
            echo "<script>window.location.href = '../crear_Usuario.php';</script>";
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            $stmt->close();
            $database->closeConnection();
            return false;
        }
    }
}

class EliminarUsuario {
    public function eliminarUsuario($id_persona) {
        $database = new DatabaseConnection();
        $conn = $database->getConnection();

        $sql = "DELETE FROM persona WHERE id_persona = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_persona);

        if ($stmt->execute()) {
            $stmt->close();
            $database->closeConnection();
            echo "<script>window.location.href = '../crear_Usuario.php';</script>";
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
    if (isset($_POST['usuarioIdEditar']) && !empty($_POST['usuarioIdEditar'])) {
        // Editar usuario
        $id_persona = $_POST['usuarioIdEditar'];
        $nombre = $_POST['nombreEditar'];
        $apellido = $_POST['apellidoEditar'];
        $cedula = $_POST['cedulaEditar'];
        $password = $_POST['passwordEditar'];
        $correo = $_POST['correoEditar'];

        $usuario = new EditarUsuario();
        $usuario->actualizarUsuario($id_persona, $nombre, $apellido, $cedula, $password, $correo);
    } elseif (isset($_POST['usuarioIdEliminar']) && !empty($_POST['usuarioIdEliminar'])) {
        // Eliminar usuario
        $id_persona = $_POST['usuarioIdEliminar'];

        $usuario = new EliminarUsuario();
        $usuario->eliminarUsuario($id_persona);
    } elseif (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['cedula']) && isset($_POST['password']) && isset($_POST['correo'])) {
        // Agregar usuario
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $cedula = $_POST['cedula'];
        $password = $_POST['password'];
        $correo = $_POST['correo'];

        $usuario = new AgregarUsuario();
        $usuario->insertarUsuario($nombre, $apellido, $cedula, $password, $correo);
    }
}
class MostrarUsuarios {
    public function mostrarUsuarios() {
        $database = new DatabaseConnection();
        $conn = $database->getConnection();

        $sql = "SELECT id_persona, nombre, apellido, cedula, correo FROM persona";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<table class="table table-striped table-hover text-center">';
            echo '<thead>';
            echo '<tr class="text-center">';
            echo '<th scope="col">ID</th>';
            echo '<th scope="col">Nombre</th>';
            echo '<th scope="col">Apellido</th>';
            echo '<th scope="col">Cédula</th>';
            echo '<th scope="col">Correo</th>';
            echo '<th scope="col">Acciones</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td scope="row">' . htmlspecialchars($row["id_persona"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["nombre"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["apellido"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["cedula"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["correo"]) . '</td>';
                echo '<td>';
                echo '<div class="botones">';
                echo '<button class="bin-button eliminar-button" type="button" data-id="' . $row['id_persona'] . '" data-bs-toggle="modal" data-bs-target="#eliminarUsuario">';
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
                echo '<button class="edit-button" type="button" data-id="' . $row['id_persona'] . '" data-nombre="' . htmlspecialchars($row['nombre'], ENT_QUOTES, 'UTF-8') . '" data-apellido="' . htmlspecialchars($row['apellido'], ENT_QUOTES, 'UTF-8') . '" data-cedula="' . htmlspecialchars($row['cedula'], ENT_QUOTES, 'UTF-8') . '" data-correo="' . htmlspecialchars($row['correo'], ENT_QUOTES, 'UTF-8') . '" data-bs-toggle="modal" data-bs-target="#editarUsuario">';
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
            echo "No hay usuarios disponibles";
        }

        $database->closeConnection();
    }
}

?>
