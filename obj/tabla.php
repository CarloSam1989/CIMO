<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reportes_db";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos de la base de datos
$sql = "SELECT id, nombre, fecha FROM reportes";
$result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["nombre"] . "</td>";
        echo "<td>" . $row["fecha"] . "</td>";
        echo '<td>
                <button class="btn btn-primary btn-sm ver-btn">Ver</button>
                <button class="btn btn-eliminar btn-sm eliminar-btn">Eliminar</button>
                </td>';
        echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No hay reportes disponibles</td></tr>";
    }
    $conn->close();
?>