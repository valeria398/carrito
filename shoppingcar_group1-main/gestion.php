<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Observaciones y Sugerencias</title>
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
}

.title-container {
    background-color: black;
    padding: 20px;
    border-radius: 10px;
    margin-top: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
}

h1 {
    color: white;
    margin: 0;
}

.observaciones-container {
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 10px;
    margin-top: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

th {
    background-color: #bdc3c7;
    color: #333;
}

td form {
    display: flex;
    justify-content: center;
}

input[type="submit"],
input[type="button"] {
    background-color: green;
    color: white;
    border: none;
    padding: 8px 12px;
    cursor: pointer;
    margin-right: 5px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover,
input[type="button"]:hover {
    background-color: darkgreen;
}

.important {
    font-weight: bold;
    color: green;
}

.delete {
    color: red;
}

.responder {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 8px 12px;
    cursor: pointer;
    margin-right: 5px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.responder:hover {
    background-color: #0056b3;
}
    </style>
</head>
<body>
    <div class="title-container">
        <h1>Gestión de Observaciones y Sugerencias</h1>
    </div>
    <div class="observaciones-container">
        <table>
            <tr>
                <th>Nombre de Usuario</th>
                <th>Observación/Sugerencia</th>
                <th>Fecha</th>
                <th>Acción</th>
            </tr>
            <?php
            // Establecer conexión
            $conexion = new mysqli("localhost", "root", "", "holamun");
            if ($conexion->connect_error) {
                die("Conexión fallida: " . $conexion->connect_error);
            }

            // Funciones de manejo
            function mostrarDatos() {
                global $conexion;
                $sql = "SELECT * FROM software INNER JOIN usuarios ON software.usuarioID = usuarios.usuarioID";
                $result = $conexion->query($sql);
                while ($fila = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($fila['nombre_us']) . "</td>";
                    echo "<td>" . htmlspecialchars($fila['comentario']) . "</td>";
                    echo "<td>" . htmlspecialchars($fila['fecha_envio']) . "</td>";
                    echo '<td>';
                    echo '<form action="gestion.php" method="post">';
                    echo '<input type="hidden" name="id" value="' . $fila['id'] . '">';
                    echo '<input type="submit" name="accion" value="Marcar Importante" class="important">';
                    echo '<input type="submit" name="accion" value="Eliminar" class="delete">';
                    echo '<input type="button" name="accion" value="Responder" class="responder" onclick="abrirFormulario(\'mailto:' . $fila['correo_electro'] . '?subject=Respuesta a tu observación/sugerencia&body=Escribe aquí tu respuesta...\')">';
                    echo '</form>';
                    echo '</td>';
                    echo "</tr>";
                }
            }

            function marcarImportante($id) {
                global $conexion;
                $sql = "UPDATE software SET importante = 1 WHERE id = ?";
                $stmt = $conexion->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $stmt->close();
            }

            function eliminarRegistro($id) {
                global $conexion;
                $sql = "DELETE FROM software WHERE id = ?";
                $stmt = $conexion->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $stmt->close();
            }

            // Manejar acciones
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['accion']) && isset($_POST['id'])) {
                    if ($_POST['accion'] == 'Marcar Importante') {
                        marcarImportante($_POST['id']);
                    } elseif ($_POST['accion'] == 'Eliminar') {
                        eliminarRegistro($_POST['id']);
                    }
                }
            }

            // Siempre mostrar los datos
            mostrarDatos();

            // Cerrar conexión
            $conexion->close();
            ?>
        </table>
    </div>
    <script>
        function abrirFormulario(url) {
            var ventana = window.open(url, '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=100,width=800,height=600');
            ventana.document.write('<html><head><title>Responder</title>');
            ventana.document.write('<style>');
            ventana.document.write('body {font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px;}');
            ventana.document.write('h2 {color: ;}');
            ventana.document.write('h2 {color: #333;}');
            ventana.document.write('form {margin-top: 20px;}');
            ventana.document.write('</style>');
            ventana.document.write('</head><body>');
            ventana.document.write('<h2>Responder</h2>');
            ventana.document.write('<form action="' + url + '" method="post" enctype="text/plain">');
            ventana.document.write('Para: <input type="text" name="email"><br>');
            ventana.document.write('Mensaje:<br>');
            ventana.document.write('<textarea name="mensaje" rows="5" cols="50"></textarea><br>');
            ventana.document.write('<input type="submit" value="Enviar">');
            ventana.document.write('</form>');
            ventana.document.write('</body></html>');
            ventana.document.close();
        }
    </script>
</body>
</html>



            
