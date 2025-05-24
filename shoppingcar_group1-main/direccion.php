<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #2c3e50, #bdc3c7);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 40px 60px;
            text-align: center;
        }
        h1 {
            font-size: 2em;
            margin-bottom: 20px;
            color: #2c3e50;
        }
        .container form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .container input[type="submit"] {
            background: #27ae60;
            border: none;
            border-radius: 8px;
            color: white;
            padding: 10px 20px;
            font-size: 1em;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .container input[type="submit"]:hover {
            background: #2ecc71;
        }
        .container input[type="submit"]:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(39, 174, 96, 0.5);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Seleccione una opción:</h1>
        <form action="redirect.php" method="post">
            <input type="submit" name="enviar" value="Enviar observaciones y sugerencias">
            <input type="submit" name="gestionar" value="Gestionar observaciones y comentarios">
        </form>
    </div>
</body>
</html>
