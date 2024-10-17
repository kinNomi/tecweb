<?php
    include_once __DIR__.'/database.php';

    $response = array('status' => 'error', 'message' => '', 'data' => array());

    if(isset($_POST['busqueda'])) {
        $busqueda = $conexion->real_escape_string($_POST['busqueda']);
        
        $query = "SELECT * FROM `productos` WHERE nombre LIKE '%{$busqueda}%' OR marca LIKE '%{$busqueda}%' OR detalles LIKE '%{$busqueda}%'";
        
        if ($result = $conexion->query($query)) {
            while ($row = $result->fetch_assoc()) {
                $response['data'][] = $row;
            }
            
            if (empty($response['data'])) {
                $response['message'] = 'Sin resultados';
            } else {
                $response['status'] = 'success';
                $response['message'] = 'Productos encontrados';
            }
            
            $result->free();
        } else {
            $response['message'] = 'Error en la consulta: ' . $conexion->error;
        }
        
        $conexion->close();
    } else {
        $response['message'] = 'No se recibió término de búsqueda';
    }
    
    echo json_encode($response);
?>