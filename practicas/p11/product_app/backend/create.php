<?php
    include_once __DIR__.'/database.php';

    $response = array('status' => 'error', 'message' => '');

    $producto = file_get_contents('php://input');
    if(!empty($producto)) {
        $jsonOBJ = json_decode($producto);
        
        $checkQuery = "SELECT * FROM productos WHERE nombre='{$jsonOBJ->nombre}' AND marca='{$jsonOBJ->marca}' AND modelo='{$jsonOBJ->modelo}'";
        $result = $conexion->query($checkQuery);
        
        if($result->num_rows > 0) {
            $response['message'] = 'ERROR: El producto ya está registrado';
        } else {
            $insertQuery = "INSERT INTO productos(nombre,marca,modelo,precio,detalles,unidades,imagen) VALUES ('{$jsonOBJ->nombre}', '{$jsonOBJ->marca}', '{$jsonOBJ->modelo}', {$jsonOBJ->precio}, '{$jsonOBJ->detalles}', {$jsonOBJ->unidades}, '{$jsonOBJ->imagen}')";
            
            if ($conexion->query($insertQuery)) {
                $response['status'] = 'success';
                $response['message'] = 'Producto agregado con éxito';
            } else {
                $response['message'] = 'Error al agregar el producto: ' . $conexion->error;
            }
        }
    } else {
        $response['message'] = 'No se recibieron datos del producto';
    }

    echo json_encode($response);
?>