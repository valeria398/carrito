<?php

if (isset($_GET['id'])) {

    $codigo = $_GET['id'];


    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gestionar";

    $conn = new mysqli($servername, $username, $password, $dbname);


    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    
    $sql = "DELETE FROM productos WHERE `Id producto` = '$codigo'";


    if ($conn->query($sql) === TRUE) {
        echo "Producto eliminado exitosamente";
        header("location: Codigo_Final.php");
    } else {
        echo "Error al eliminar el producto: " . $conn->error;
    }

    
    $conn->close();
} else {
    echo "No se proporcionó un ID de producto para eliminar.";
}
?>
