<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['enviar'])) {
        header("Location: index.html"); // Redirige a la página de enviar observaciones
        exit;
    } elseif (isset($_POST['gestionar'])) {
        header("Location: gestion.php"); // Redirige a la página de gestionar observaciones
        exit;
    }
}
?>