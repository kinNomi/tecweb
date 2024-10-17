<?php
    include_once __DIR__.'/database.php';

    // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
    $producto = file_get_contents('php://input');
    if(!empty($producto)) {
        // SE TRANSFORMA EL STRING DEL JASON A OBJETO
        $jsonOBJ = json_decode($producto);
        
        $response = array('status' => 'error', 'message' => '');

        if ( $result = $conexion->query("SELECT * FROM productos WHERE nombre='{$jsonOBJ->nombre}' and marca='{$jsonOBJ->marca}' and modelo='{$jsonOBJ->modelo}';") ) 
		{
            /** Se extraen las tuplas obtenidas de la consulta */
			if($result->num_rows > 0){
                $response['message'] = "ERROR: El producto ya está registrado";
            } else {
                $sql = "INSERT INTO productos(nombre,marca,modelo,precio,detalles,unidades,imagen) VALUES ('{$jsonOBJ->nombre}', '{$jsonOBJ->marca}', '{$jsonOBJ->modelo}', {$jsonOBJ->precio}, '{$jsonOBJ->detalles}', {$jsonOBJ->unidades}, '{$jsonOBJ->imagen}')";
                if ( $conexion->query($sql) ) 
                {
                    $response['status'] = 'success';
                    $response['message'] = "Producto agregado con éxito";
                }
                else
                {
                    $response['message'] = "El Producto no pudo ser agregado: " . $conexion->error;
                }
            }
		} 
        echo json_encode($response);
    }
?>