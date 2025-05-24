<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestionar";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$codigo = $_POST['codigo'];
$producto = $_POST['producto'];
$cantidad = $_POST['cantidad'];
$precio = $_POST['precio'];
$fecha_ingreso = isset($_POST['fecha_ingreso']) ? $_POST['fecha_ingreso'] : date("Y-m-d"); // Usar la fecha actual si no se proporciona

// Manejar la subida de la imagen
$imagen = $_FILES['imagen']['name'];
$imagen_tmp = $_FILES['imagen']['tmp_name'];
$directorio = "uploads/";

if (!file_exists($directorio)) {
    mkdir($directorio, 0777, true);
}

$imagen_path = $directorio . basename($imagen);

if (move_uploaded_file($imagen_tmp, $imagen_path)) {
    // Insertar los datos en la base de datos
    $sql = "INSERT INTO productos ( `Nombre`, `imagen`, `Cantidad`, `Precio`, `Fecha Ingreso`) 
            VALUES ('$producto', '$imagen_path', $cantidad, '$precio', '$fecha_ingreso')";

    if ($conn->query($sql) === TRUE) {
        echo "Producto agregado exitosamente";
        header("location:Codigo_Final.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Error al subir la imagen.";
}

$conn->close();
?>
