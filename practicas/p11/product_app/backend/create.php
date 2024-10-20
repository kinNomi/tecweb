<?php
    include_once __DIR__.'/database.php';

    // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
    $producto = file_get_contents('php://input');
    if(!empty($producto)) {
        // SE TRANSFORMA EL STRING DEL JASON A OBJETO
        $jsonOBJ = json_decode($producto);
        
        if ($result = $conexion->query("SELECT * FROM productos WHERE nombre = '{$jsonOBJ->nombre}' and eliminado = 0")) {
            if($result->num_rows > 0) {
                echo '[SERVIDOR] Error: Producto ya registrado';
            } else {
                $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen) VALUES ('{$jsonOBJ->nombre}', '{$jsonOBJ->marca}', '{$jsonOBJ->modelo}', '{$jsonOBJ->precio}', '{$jsonOBJ->detalles}', '{$jsonOBJ->unidades}', '{$jsonOBJ->imagen}')";
                if($conexion->query($sql)) {
                    echo '[SERVIDOR] Éxito: Producto creado';
                }else{
                    echo '[SERVIDOR] Error: No se pudo crear el producto';
                }
            }

        }else{
            echo '[SERVIDOR] Error: No se pudo verificar el producto';
        }
    }else {
        echo '[SERVIDOR] Error: No se recibieron datos del producto';
    }
    $conexion->close();

?>