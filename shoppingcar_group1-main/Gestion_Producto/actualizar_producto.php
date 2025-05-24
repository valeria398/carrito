<?php
// Verificar si se han recibido los datos del formulario
if(isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['codigo']) && isset($_POST['producto']) && isset($_POST['cantidad']) && isset($_POST['precio']) && isset($_POST['fecha_entrada'])) {
    $producto_id = $_POST['id'];
    $codigo = $_POST['codigo'];
    $producto = $_POST['producto'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];
    $fecha_entrada = $_POST['fecha_entrada'];

    // Manejar la subida de la imagen (si se ha proporcionado una nueva)
    if(isset($_FILES['imagen']) && !empty($_FILES['imagen']['name'])) {
        $imagen = $_FILES['imagen']['name'];
        $imagen_tmp = $_FILES['imagen']['tmp_name'];
        $directorio = "uploads/";
        $imagen_path = $directorio . basename($imagen);

        if(move_uploaded_file($imagen_tmp, $imagen_path)) {
            // Actualizar los datos del producto en la base de datos
            $sql = "UPDATE productos SET `Id producto` = '$codigo', Nombre = '$producto', Cantidad = $cantidad, Precio = '$precio', `Fecha Ingreso` = '$fecha_entrada', imagen = '$imagen_path' WHERE `Id producto` = '$producto_id'";
        } else {
            echo "Error al subir la imagen.";
            exit();
        }
    } else {
        // Actualizar los datos del producto en la base de datos (sin modificar la imagen)
        $sql = "UPDATE productos SET `Id producto` = '$codigo', Nombre = '$producto', Cantidad = $cantidad, Precio = '$precio', `Fecha Ingreso` = '$fecha_entrada' WHERE `Id producto` = '$producto_id'";
    }

    // Conectar a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gestionar";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Ejecutar la consulta de actualización
    if ($conn->query($sql) === TRUE) {
        header("location: Codigo_Final.php");
        echo "Producto actualizado exitosamente";
    } else {
        echo "Error al actualizar el producto: " . $conn->error;
    }

    $conn->close();
} else {
    echo "No se han proporcionado todos los datos del formulario.";
}
?>
