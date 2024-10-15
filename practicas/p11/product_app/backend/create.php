<?php
    include_once __DIR__.'/database.php';

    // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
    $producto = file_get_contents('php://input');
    if(!empty($producto)) {
        // SE TRANSFORMA EL STRING DEL JASON A OBJETO
        $jsonOBJ = json_decode($producto);
        /**
         * SUSTITUYE LA SIGUIENTE LÍNEA POR EL CÓDIGO QUE REALICE
         * LA INSERCIÓN A LA BASE DE DATOS. COMO RESPUESTA REGRESA
         * UN MENSAJE DE ÉXITO O DE ERROR, SEGÚN SEA EL CASO.
         */
        echo '[SERVIDOR] Nombre: '.$jsonOBJ->nombre;

        if ( $result = $conexion->query("SELECT * FROM productos WHERE nombre='{$jsonOBJ->nombre}' and marca='{$jsonOBJ->marca}' and modelo='{$jsonOBJ->modelo}';") ) 
		{
            /** Se extraen las tuplas obtenidas de la consulta */
			if($result->num_rows > 0){
                echo "<h1>ERROR: YA SE REGISTRÓ</h1>";
            }else{

                $sql = "INSERT INTO productos(nombre,marca,modelo,precio,detalles,unidades,imagen) VALUES ('{$jsonOBJ->nombre}', '{$jsonOBJ->marca}', '{$jsonOBJ->modelo}', {$jsonOBJ->precio}, '{$jsonOBJ->detalles}', {$jsonOBJ->unidades}, '{$jsonOBJ->imagen}')";
                if ( $conexion->query($sql) ) 
                {
                }
                else
                {
                    echo 'El Producto no pudo ser agregado';
                }

                echo "<h1>Datos registrados:</h1>";
                echo "<p>Nombre: $jsonOBJ->nombre</p>";
                echo "<p>Marca: $jsonOBJ->marca</p>";
                echo "<p>Modelo: $jsonOBJ->modelo</p>";
                echo "<p>Precio: $jsonOBJ->precio</p>";
                echo "<p>Detalles: $jsonOBJ->detalles</p>";
                echo "<p>Unidades: $jsonOBJ->unidades</p>";
                echo "<p>Imagen: $jsonOBJ->imagen</p>";
            }
		} 
    }
?>