<?php
    include_once __DIR__.'/database.php';

    // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
    $producto = file_get_contents('php://input');
    if(!empty($producto)) {
        // SE TRANSFORMA EL STRING DEL JASON A OBJETO
        $jsonOBJ = json_decode($producto);
        
        //SE VALIDA SI EL PRODUCTO YA EXISTE
        $nombre = $jsonOBJ->nombre;
        $checkQuery = "SELECT * FROM productos WHERE nombre = '$nombre' AND eliminado = 0";
        $result = $conexion->query($checkQuery);

        if ($result -> num_rows > 0 ) 
		{
            echo "ERROR: Porducto existente";
        }else {
            //SE INSERTA AL QUERY
            $query = "INSERT INTO productos(nombre, marca, modelo, precio, detalles, unidades, imagen)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

            //DECLARACION
            $stmt = $conexion->prepare($query);

            //PARAMENTROS
            $stmt->bind_param("sssdsds",
                $jsonOBJ->nombre,
                $jsonOBJ->marca,
                $jsonOBJ->modelo,
                $jsonOBJ->precio,
                $jsonOBJ->detalles,
                $jsonOBJ->unidades,
                $jsonOBJ->imagen
            );

            if ($stmt -> execute()) {
                echo "Producto agregado"; 
            }else {
                echo "ERROR: no se pudo agregar el producto ". $stmt->error;
            }

            $stmt->close();
        }

        $conexion->close();
    }else {
        echo "ERROR: No se recibieron datos";
    }
    /*
            //Se extraen las tuplas obtenidas de la consulta 
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
    */
?>