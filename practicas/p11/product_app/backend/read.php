<?php
    include_once __DIR__.'/database.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array();
    // SE VERIFICA HABER RECIBIDO LA BUSQUEDA
    if( isset($_POST['busqueda']) ) {
        $busqueda = $conexion->real_escape_string($POST['busqueda']); //evitar inyeccion sql
        //$id = $_POST['id'];
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        //if ( $result = $conexion->query("SELECT * FROM productos WHERE id = '{$id}'") ) {

        //QUERY DE BUSQUEDA
        $query = "
        SELECT * FROM productos WHERE
        nombre LIKE '%{$busqueda}%'
        OR marca LIKE '%{$busqueda}%'
        OR detalles LIKE '%{$busqueda}%'";
            // SE OBTIENEN LOS RESULTADOS
			//$row = $result->fetch_array(MYSQLI_ASSOC);

        if($result = $conexion->query($query)) {
            //  SE OBTIENEN LOS RESULTADOS Y SE GUARDAN EN ARRAY
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $producto = array();
                foreach ($row as $key => $value) {
                    $producto[$key] = utf8_encode($value);
                }
                $data[] = $producto;    //se agrega el producto al array
            }
            $result->free();
            // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
            //foreach($row as $key => $value) {
            //    $data[$key] = utf8_encode($value);
            
        //}
        //$result->free();
        } else {
            die('Query Error: '.mysqli_error($conexion));
        }
        $conexion->close();
    } 
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>