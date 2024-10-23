<?php
    include_once __DIR__.'/database.php';

    // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
    $producto = file_get_contents('php://input');
    
    if(!empty($producto)) {
        // SE TRANSFORMA EL STRING DEL JASON A OBJETO
        $jsonOBJ = json_decode($producto);
      
        if (isset($jsonOBJ->id) && isset($jsonOBJ ->nombre)){
            $id = $jsonOBJ->id;
            $nombre = $jsonOBJ->nombre;

            $sql = "UPDATE INTO productos SET nombre = '{$jsonOBJ->nombre}', marca = '{$jsonOBJ->marca}', modelo = '{$jsonOBJ->modelo}', precio = {$jsonOBJ->precio}, detalles = '{$jsonOBJ->detalles}', unidades = {$jsonOBJ->unidades}, imagen = '{$jsonOBJ->imagen}' WHERE id = {$id}";
            $result = $conexion->query($sql);
        
            if($result){
                $data['status'] =  "success";
                $data['message'] =  "Producto actualizado";
            } else {
                $data['status'] =  "error";
                $data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($conexion);
            }

            $result->free();
        }


        // Cierra la conexion
        $conexion->close();
    }
        
    header('Content-Type: application/json');
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>