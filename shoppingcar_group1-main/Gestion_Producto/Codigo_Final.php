<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Producto</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function mostrarFormularioEdicion() {
            var formularioEdicion = document.getElementById("formularioEdicion");
            formularioEdicion.style.display = "block";
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Agregar Producto</h2>
        <form action="insertar_producto.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Imagen:</label>
                <input type="file" class="form-control-file" name="imagen">
            </div>
            <div class="form-group">
                <label>Código:</label>
                <input type="number" class="form-control" name="codigo" required>
            </div>
            <div class="form-group">
                <label>Producto:</label>
                <input type="text" class="form-control" name="producto" required>
            </div>
            <div class="form-group">
                <label>Cantidad:</label>
                <input type="number" class="form-control" name="cantidad" required>
            </div>
            <div class="form-group">
                <label>Precio:</label>
                <input type="text" class="form-control" name="precio" required>
            </div>
            <div class="form-group">
                <label>Fecha de Entrada:</label>
                <input type="date" class="form-control" name="fecha_entrada" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Producto</button>
        </form>

        <?php
     
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "gestionar";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Consulta para obtener todos los productos
        $sql = "SELECT * FROM productos"; 
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Mostrar todos los productos en la base de datos
            echo "<h2>Productos en la Base de Datos</h2>";
            echo "<table class='table'>";
            echo "<tr><th>Código</th><th>Producto</th><th>Cantidad</th><th>Precio</th><th>Fecha de Entrada</th><th>Imagen</th><th>Acciones</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['Id producto'] . "</td>";
                echo "<td>" . $row['Nombre'] . "</td>";
                echo "<td>" . $row['Cantidad'] . "</td>";
                echo "<td>" . $row['Precio'] . "</td>";
                echo "<td>" . $row['Fecha Ingreso'] . "</td>";
                echo "<td><img src='" . $row['imagen'] . "' alt='Imagen del producto' style='max-width: 100px;'></td>";
                echo "<td>";
                echo "<a href='editar_producto.php?id=" . $row['Id producto'] . "' onclick='mostrarFormularioEdicion()' target='editFrame' class='btn btn-info'>Editar</a> | ";
                echo "<a href='eliminar_producto.php?id=" . $row['Id producto'] . "' class='btn btn-danger'>Eliminar</a>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No se encontraron productos en la base de datos.";
        }

        $conn->close();
        ?>

        <!-- Formulario de edición -->
        <div id="formularioEdicion" style="display: none;">
            <h2>Editar Producto</h2>
            <?php
            
            ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
