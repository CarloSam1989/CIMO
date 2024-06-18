<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Noticias-Admin</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="icon" type="image/x-icon" href="img/logocimo.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="css/noticias.css">
  <link rel="stylesheet" href="css/noticias2.css">
</head>

<body> 
<header>
    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
      <div class="container-fluid">
        <img src="img/logocimo.ico" alt="Logo" class="navbar-logo">
        <a class="navbar-brand" href="index.html">CIMO</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01"
        aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link" href="#">Noticias</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contactos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Acerca de</a>
          </li>
        </ul>
        <form class="d-flex">
        </form>
      </div>
    </div>
  </nav>
</header>
<main class="d-flex">
  <div class="table-responsive">
    <div class="table-header">
      <h2>Listado Noticias</h2>
      <button class="agregar" type="button" onclick="openModal('agregarModal')">
        <span class="agregar__text">Nuevo</span>
        <span class="agregar__icon">
          <svg class="svg" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
            <line x1="12" x2="12" y1="5" y2="19"></line>
            <line x1="5" x2="19" y1="12" y2="12"></line>
          </svg>
        </span>
      </button>
    </div>
    <table class="table table-striped table-hover text-center">
      <thead>
        <tr class="text-center">
          <th scope="col">#</th>
          <th scope="col">Título</th>
          <th scope="col">Contenido</th>
          <th scope="col">Imagen</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
      <?php
        // Incluir el archivo de configuración para la conexión a la base de datos
        require_once 'obj/config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Mostrar las noticias
        $result = $conn->query("SELECT id_contenido, titulo, cuerpo, foto FROM contenido");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td scope="row">' . $row['id_contenido'] . '</td>';
                echo '<td>' . $row['titulo'] . '</td>';
                echo '<td>' . substr($row['cuerpo'], 0, 50) . '...</td>';
                echo '<td>';
                if ($row['foto']) {
                  echo '<img src="' . $row['foto'] . '" alt="Noticia' . '" width="80">';
                } else {
                    echo 'No hay niniguna imagen image';
                }
                echo '</td>';
                echo '<td>
                          <div class="botones">
                            <button class="bin-button" type="button" onclick="openEliminarModal(' . $row['id_contenido'] . ')">
                              <svg class="bin-top" viewBox="0 0 39 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <line y1="5" x2="39" y2="5" stroke="white" stroke-width="4"></line>
                                <line x1="12" y1="1.5" x2="26.0357" y2="1.5" stroke="white" stroke-width="3"></line>
                              </svg>
                              <svg class="bin-bottom" viewBox="0 0 33 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <mask id="path-1-inside-1_8_19" fill="white">
                                  <path d="M0 0H33V35C33 37.2091 31.2091 39 29 39H4C1.79086 39 0 37.2091 0 35V0Z"></path>
                                </mask>
                                <path d="M0 0H33H0ZM37 35C37 39.4183 33.4183 43 29 43H4C-0.418278 43 -4 39.4183 -4 35H4H29H37ZM4 43C-0.418278 43 -4 39.4183 -4 35V0H4V35V43ZM37 0V35C37 39.4183 33.4183 43 29 43V35V0H37Z" fill="white" mask="url(#path-1-inside-1_8_19)"></path>
                                <path d="M12 6L12 29" stroke="white" stroke-width="4"></path>
                                <path d="M21 6V29" stroke="white" stroke-width="4"></path>
                              </svg>
                            </button>
                            <button class="edit-button" id="editModal">
                              <svg class="edit-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 17.25V21H6.75L17.81 9.94L14.06 6.19L3 17.25Z" fill="white"></path>
                                <path d="M20.71 7.04C21.1 6.65 21.1 6.02 20.71 5.63L18.37 3.29C17.98 2.9 17.35 2.9 16.96 3.29L14.86 5.39L18.61 9.14L20.71 7.04Z" fill="white"></path>
                              </svg>
                            </button>
                            <button class="gear-button">
                              <svg class="gear-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19.43 12.98C19.45 12.66 19.5 12.34 19.5 12C19.5 11.66 19.45 11.34 19.43 11.02L21.54 9.63C21.71 9.52 21.78 9.31 21.71 9.12L19.76 4.98C19.68 4.8 19.48 4.7 19.28 4.76L16.89 5.55C16.42 5.21 15.92 4.91 15.37 4.67L15.03 2.21C15 2 14.81 1.87 14.6 1.87H9.4C9.19 1.87 9 2 8.97 2.21L8.63 4.67C8.08 4.91 7.58 5.21 7.11 5.55L4.72 4.76C4.52 4.7 4.32 4.8 4.24 4.98L2.29 9.12C2.22 9.31 2.29 9.52 2.46 9.63L4.57 11.02C4.55 11.34 4.5 11.66 4.5 12C4.5 12.34 4.55 12.66 4.57 12.98L2.46 14.37C2.29 14.48 2.22 14.69 2.29 14.88L4.24 19.02C4.32 19.2 4.52 19.3 4.72 19.24L7.11 18.45C7.58 18.79 8.08 19.09 8.63 19.33L8.97 21.79C9 22 9.19 22.13 9.4 22.13H14.6C14.81 22.13 15 22 15.03 21.79L15.37 19.33C15.92 19.09 16.42 18.79 16.89 18.45L19.28 19.24C19.48 19.3 19.68 19.2 19.76 19.02L21.71 14.88C21.78 14.69 21.71 14.48 21.54 14.37L19.43 12.98ZM12 15.5C10.07 15.5 8.5 13.93 8.5 12C8.5 10.07 10.07 8.5 12 8.5C13.93 8.5 15.5 10.07 15.5 12C15.5 13.93 13.93 15.5 12 15.5Z" fill="white"></path>
                              </svg>
                            </button>
                          </div>            
                        </td>';
                  echo '</tr>';
              }
          } else {
              echo '<tr><td colspan="5">No hay noticias disponibles.</td></tr>';
          }

          $conn->close();
        ?>
      </tbody>

    </table>
  </div>
</main> 
<?php
require_once 'obj/config.php';

$message = '';
$messagError = ''; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar si las variables están definidas
    if (isset($_POST['titulo']) && isset($_POST['contenido']) && isset($_POST['opcion'])) {
        $titulo = $_POST['titulo'];
        $cuerpo = $_POST['contenido'];
        $tipo = $_POST['opcion'];

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("SELECT id_categoria FROM categoria WHERE tipo = ?");
        $stmt->bind_param("s", $tipo);
        $stmt->execute();
        $stmt->bind_result($id_categoria);
        $stmt->fetch();
        $stmt->close();

        if ($id_categoria) {
            $estado = 1;

            $imagen = $_FILES['imagen']['name'];    
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($imagen);

            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file)) {
              $stmt = $conn->prepare("INSERT INTO contenido (titulo, cuerpo, id_categoria, foto, estado) VALUES (?, ?, ?, ?, ?)");
              $stmt->bind_param("ssisi", $titulo, $cuerpo, $id_categoria, $target_file, $estado);

              if ($stmt->execute()) {
                $message = 'Nuevo contenido agregado exitosamente.';
              } else {
                $message = 'Error: ' . $stmt->error;
              }
                $stmt->close();

            } else {
              $messagError  = 'Error al subir la imagen.';
            }

        } else {
          $messagError  = 'Categoría no válida.';
        }

        $conn->close();
    } else {
      $messagError  = 'Error: Faltan datos en el formulario.';
    }
}
?>

<!-- Modal de creación de noticia -->
<div id="agregarModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h2>Crear nueva noticia</h2>
      <span class="close-btn" onclick="closeModal('agregarModal')">&times;</span>
    </div>
    <form id="nuevaNoticia" action="noticias.php" method="post" enctype="multipart/form-data">
      <label for="titulo">Título:</label>
      <input type="text" id="titulo" name="titulo" required>
      <label for="contenido">Contenido:</label>
      <textarea id="contenido" name="contenido"></textarea>
      <label for="imagen">Subir imagen:</label>
      <input type="file" id="imagen" name="imagen" accept="image/*">
      <label for="opcion">Noticia:</label>
      <div class="modal-header">
        <select id="opcion"  class="opciones" name="opcion">
          <?php
          require_once 'obj/config.php';

          $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

          if ($conn->connect_error) {
              die("Conexión fallida: " . $conn->connect_error);
          }

          $result = $conn->query("SELECT id_categoria, tipo FROM categoria WHERE estado = 1");

          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo '<option value="' . $row['tipo'] . '">' . $row['tipo'] . '</option>';
              }
          }

          $conn->close();
          ?>
        </select>
        <button type="button" onclick="agregarTipo()" class="crear">
          <span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
              <path fill="none" d="M0 0h24v24H0z"></path>
              <path fill="currentColor" d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z"></path>
            </svg> 
            Categoría
          </span>
        </button>
      </div>
      <button type="submit" id="createButton" onclick="showMessage()">Crear</button>

    </form>
  </div>
</div>

<!-- Modal de eliminación -->
<div id="eliminarModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h4>¿Está seguro en eliminar la noticia?</h4>
    </div>
    <div id="viewContent">
      <p>¿Está seguro de que desea eliminar todo el contenido de la noticia? 
        Esta acción es irreversible y se perderán todos los datos de ella.</p>
    </div>
    <div class="modal-footer">
      <input type="hidden" id="idEliminar" name="id">
      <button class="btn-deactivate btnmodaleliminar" type="button" onclick="eliminarNoticia()">Eliminar</button>
      <button class="btn-cancel" type="button" onclick="closeModal('eliminarModal')">Cancelar</button>
    </div>
  </div>
</div>

<!-- modal para crear una edición -->
<div id="editModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h2>Editar noticia</h2>
      <span class="close-btn" data-modal="editModal">&times;</span> 
    </div>
    <form id="nuevaNoticia">
      <label for="titulo">Título:</label>
      <input type="text" id="titulo" name="ingrese titulo" required>
      <label for="contenido">Contenido:</label>
      <textarea id="exampleTextarea" name="exampleTextarea"></textarea>
      <label for="Imagen">Subir imagen:</label> 
      <input type="file" id="imagen" name="imagen" accept="image/*">
      <button type="submit">Editar</button>
    </form>
  </div>
</div>

<?php
require_once 'obj/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar si las variables están definidas
    if (isset($_POST['ingrese_categoria']) && isset($_POST['ingrese_estado_categoria'])) {
        $categoria = $_POST['ingrese_categoria'];
        $estado = $_POST['ingrese_estado_categoria'];

        // Crear conexión
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // Verificar conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Insertar datos en la tabla 'categoria'
        $stmt = $conn->prepare("INSERT INTO categoria (tipo, estado) VALUES (?, ?)");
        $stmt->bind_param("si", $categoria, $estado);

        if ($stmt->execute()) {
            $message = 'Nueva categoría agregada exitosamente.';
        } else {
            $messagError = 'Error: ' . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        $messagError = 'Error: Faltan datos en el formulario.';
    }
}
?>  

<!-- moadal para crear una nueva categoría -->
<div id="agregar" class="modal" style="display: none;">
  <div class="modal-content">
    <div class="modal-header">
      <h2>Crear Categoría</h2>
      <span class="close-btn" onclick="cerrarModal()">&times;</span> 
    </div>
    <form id="nuevaCategoria" action="noticias.php" method="POST">
    <label for="categoria">Nombre:</label>
    <input type="text" id="titulo" name="ingrese_categoria" required>
    
    <label for="estado">Estado:</label>
    <input type="text" id="estado" name="ingrese_estado_categoria" required>
    
    <button type="submit">Agregar</button>
</form>

  </div>
</div>


<!-- sección de mensajes mensajes -->
<div class="info" id="infoMessage" style="display: none;">
    <div class="info__icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" height="24" fill="none">
          <path fill="#393a37" d="m12 1.5c-5.79844 0-10.5 4.70156-10.5 10.5 0 5.7984 4.70156 10.5 10.5 10.5 5.7984 0 10.5-4.7016 10.5-10.5 0-5.79844-4.7016-10.5-10.5-10.5zm.75 15.5625c0 .1031-.0844.1875-.1875.1875h-1.125c-.1031 0-.1875-.0844-.1875-.1875v-6.375c0-.1031.0844-.1875.1875-.1875h1.125c.1031 0 .1875.0844.1875.1875zm-.75-8.0625c-.2944-.00601-.5747-.12718-.7808-.3375-.206-.21032-.3215-.49305-.3215-.7875s.1155-.57718.3215-.7875c.2061-.21032.4864-.33149.7808-.3375.2944.00601.5747.12718.7808.3375.206.21032.3215.49305.3215.7875s-.1155.57718-.3215.7875c-.2061.21032-.4864.33149-.7808.3375z"></path>
        </svg>
    </div>
    <div class="info__title"><?php echo $message; ?></div>
    <div class="info__close">
        <svg height="20" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg">
          <path d="m15.8333 5.34166-1.175-1.175-4.6583 4.65834-4.65833-4.65834-1.175 1.175 4.65833 4.65834-4.65833 4.6583 1.175 1.175 4.65833-4.6583 4.6583 4.6583 1.175-1.175-4.6583-4.6583z" fill="#393a37"></path>
        </svg>
    </div>
</div>

<div class="error" id="ErrorMessage" style="display: none;">
    <div class="error__icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" height="24" fill="none">
            <path fill="#393a37" d="m12 1.5c-5.79844 0-10.5 4.70156-10.5 10.5 0 5.7984 4.70156 10.5 10.5 10.5 5.7984 0 10.5-4.7016 10.5-10.5 0-5.79844-4.7016-10.5-10.5-10.5zm.75 15.5625c0 .1031-.0844.1875-.1875.1875h-1.125c-.1031 0-.1875-.0844-.1875-.1875v-6.375c0-.1031.0844-.1875.1875-.1875h1.125c.1031 0 .1875.0844.1875.1875zm-.75-8.0625c-.2944-.00601-.5747-.12718-.7808-.3375-.206-.21032-.3215-.49305-.3215-.7875s.1155-.57718.3215-.7875c.2061-.21032.4864-.33149.7808-.3375.2944.00601.5747.12718.7808.3375.206.21032.3215.49305.3215.7875s-.1155.57718-.3215.7875c-.2061.21032-.4864.33149-.7808.3375z"></path>
        </svg>
    </div>
    <div class="error__title"><?php echo $messagError; ?></div>
    <div class="error__close">
        <svg height="20" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg">
            <path d="m15.8333 5.34166-1.175-1.175-4.6583 4.65834-4.65833-4.65834-1.175 1.175 4.65833 4.65834-4.65833 4.6583 1.175 1.175 4.65833-4.6583 4.6583 4.6583 1.175-1.175-4.6583-4.6583z" fill="#393a37"></path>
        </svg>
    </div>
</div>


<script src="js/noticias.js"></script>

<footer class="text-center mt-4">
  <p>&copy; 2024 BCDGJS. Todos los derechos reservados.</p>
</footer>

</body>

<script>
function showMessage() {
    document.getElementById('infoMessage').style.display = 'flex';
}

document.querySelector('.info__close').addEventListener('click', function() {
    document.getElementById('infoMessage').style.display = 'none';
});

// Llama a la función showMessage() si hay un mensaje PHP
<?php if (isset($message) && !empty($message)): ?>
    showMessage();
<?php endif; ?>
</script>

<script>
function showMessageError() {
    document.getElementById('ErrorMessage').style.display = 'flex';
}

document.querySelector('.error__close').addEventListener('click', function() {
    document.getElementById('ErrorMessage').style.display = 'none';
});

// Llama a la función showMessage() si hay un mensaje PHP
<?php if (isset($messagError) && !empty($messagError)): ?>
  howMessageError();
<?php endif; ?>
</script>


</html>