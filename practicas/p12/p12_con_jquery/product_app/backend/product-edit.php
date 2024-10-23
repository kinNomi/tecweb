<?php
    include_once __DIR__.'/database.php';

    // Inicializa el array $data para evitar el warning
    $data = array('status' => 'error', 'message' => 'No se proporcionó la información necesaria');

    // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
    $producto = file_get_contents('php://input');
    
    if(!empty($producto)) {
        // SE TRANSFORMA EL STRING DEL JASON A OBJETO
        $jsonOBJ = json_decode($producto);
      
        
        if (isset($jsonOBJ->id) && isset($jsonOBJ ->nombre)){
            $id = $jsonOBJ->id;
            $nombre = $jsonOBJ->nombre;

            $sql = "UPDATE productos SET nombre = '{$jsonOBJ->nombre}', marca = '{$jsonOBJ->marca}', modelo = '{$jsonOBJ->modelo}', precio = {$jsonOBJ->precio}, detalles = '{$jsonOBJ->detalles}', unidades = {$jsonOBJ->unidades}, imagen = '{$jsonOBJ->imagen}' WHERE id = {$jsonOBJ->id}";
            $result = $conexion->query($sql);
        
            if($result){
                $data['status'] =  "success";
                $data['message'] =  "Producto actualizado exitosamente";
            } else {
                $data['status'] =  "error";
                $data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($conexion);
            }

        } else {
            $data['status'] =  "error";
            $data['message'] = "ERROR: No se proporcionó la información necesaria";
        }

    }
    // Cierra la conexion
    $conexion->close();
    //$result->free();
    

        
    //header('Content-Type: application/json');
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>