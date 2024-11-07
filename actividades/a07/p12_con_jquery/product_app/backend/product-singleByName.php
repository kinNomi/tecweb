<?php

include_once __DIR__.'/database.php';

if (isset($_GET['nombre'])) {
    $nombre = mysqli_real_escape_string($conexion, $_GET['nombre']);
    $query = "SELECT COUNT(*) as count FROM productos WHERE nombre = '$nombre'";
    $result = mysqli_query($conexion, $query);
    $data = mysqli_fetch_assoc($result);

    // Si count es mayor que 0, significa que el producto ya existe
    if ($data['count'] > 0) {
        echo json_encode(['exists' => true]);
    } else {
        echo json_encode(['exists' => false]);
    }
}
?>