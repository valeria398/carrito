<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "holamun";

$conexion = new mysqli($server, $user, $pass, $db);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}



// Comprobar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Asignar variables asegurándose de que no son null
    $username = isset($_POST['user']) ? $conexion->real_escape_string($_POST['user']) : '';
    $observaciones = isset($_POST['observations']) ? $conexion->real_escape_string($_POST['observations']) : '';

    // Validar que el usuario existe
    $sql = "SELECT usuarioID FROM usuarios WHERE nombre_us = ?";
    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Usuario válido, insertar comentario
            $usuario = $result->fetch_assoc();
            $usuario_id = $usuario['usuarioID'];

            $sql_insert = "INSERT INTO software (usuarioID, comentario) VALUES (?, ?)";
            if ($stmt_insert = $conexion->prepare($sql_insert)) {
                $stmt_insert->bind_param("is", $usuario_id, $observaciones);
                if ($stmt_insert->execute()) {
                    echo "Registro guardado exitosamente.";
                } else {
                    echo "Error al guardar el registro: " . $stmt_insert->error;
                }
                $stmt_insert->close();
            } else {
                echo "Error al preparar la consulta de inserción: " . $conexion->error;
            }
        } else {
            // Usuario no encontrado
            echo "Usuario no encontrado. Por favor, registrese.";
        }
        $stmt->close();
    } else {
        echo "Error al preparar la consulta de validación de usuario: " . $conexion->error;
    }
}

// Cerrar conexión
$conexion->close();
?>
