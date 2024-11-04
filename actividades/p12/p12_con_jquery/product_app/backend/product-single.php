<?php
    include_once __DIR__.'/database.php';

    if (isset($_POST['id'])) {
        $id = mysqli_real_escape_string($conexion, $_POST['id']);

        $query = "SELECT * FROM productos WHERE id = {$id} AND eliminado = 0";

        $result = mysqli_query($conexion, $query);
        if (!$result) {
            die('Query Failed: ' . mysqli_error($conexion));
        }

        $json = array();
        if ($row = mysqli_fetch_assoc($result)) {
            $json = array(
                'id' => $row['id'],
                'nombre' => $row['nombre'],
                'marca' => $row['marca'],
                'modelo' => $row['modelo'],
                'precio' => $row['precio'],
                'detalles' => $row['detalles'],
                'unidades' => $row['unidades'],
                'imagen' => $row['imagen']
            );
        }
        echo json_encode($json);

        $result->free();
        $conexion->close();
    }
?>
