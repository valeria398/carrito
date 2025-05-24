<!DOCTYPE html>
<html>
<head>
    <title>Editar Producto</title>
</head>
<body>
    <h2>Editar Producto</h2>

    <?php
    // Verificar si se recibió un ID de producto válido
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id_producto = $_GET['id'];

        // Conectar a la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "gestionar";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Consulta para obtener los datos del producto a editar
        $sql = "SELECT * FROM productos WHERE `Id producto` = $id_producto";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Mostrar el formulario de edición con los datos del producto
            $row = $result->fetch_assoc();
            ?>
            <form action="actualizar_producto.php" method="post" enctype="multipart/form-data">
                <!-- Campo oculto para enviar el ID del producto -->
                <input type="hidden" name="id" value="<?php echo $row['Id producto']; ?>">

                Imagen: <input type="file" name="imagen"><br>
                Código: <input type="text" name="codigo" value="<?php echo $row['Id producto']; ?>" required><br>
                Producto: <input type="text" name="producto" value="<?php echo $row['Nombre']; ?>" required><br>
                Cantidad: <input type="number" name="cantidad" value="<?php echo $row['Cantidad']; ?>" required><br>
                Precio: <input type="text" name="precio" value="<?php echo $row['Precio']; ?>" required><br>
                Fecha de Entrada: <input type="date" name="fecha_entrada" value="<?php echo $row['Fecha Ingreso']; ?>" required><br>
                <input type="submit" value="Actualizar Producto">
            </form>
            <?php
        } else {
            echo "No se encontró el producto en la base de datos.";
        }

        $conn->close();
    } else {
        echo "ID de producto inválido.";
    }
    ?>
</body>
</html>
