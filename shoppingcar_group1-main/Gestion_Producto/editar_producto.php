<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
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

                    <div class="form-group">
                        <label for="imagen">Imagen:</label>
                        <input type="file" class="form-control-file" name="imagen" id="imagen">
                    </div>
                    <div class="form-group">
                        <label for="codigo">Código:</label>
                        <input type="text" class="form-control" name="codigo" id="codigo" value="<?php echo $row['Id producto']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="producto">Producto:</label>
                        <input type="text" class="form-control" name="producto" id="producto" value="<?php echo $row['Nombre']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="cantidad">Cantidad:</label>
                        <input type="number" class="form-control" name="cantidad" id="cantidad" value="<?php echo $row['Cantidad']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="precio">Precio:</label>
                        <input type="text" class="form-control" name="precio" id="precio" value="<?php echo $row['Precio']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha_entrada">Fecha de Entrada:</label>
                        <input type="date" class="form-control" name="fecha_entrada" id="fecha_entrada" value="<?php echo $row['Fecha Ingreso']; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar Producto</button>
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
    </div>

    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
