<?php
    include_once __DIR__.'/database.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array();
    // SE VERIFICA HABER RECIBIDO EL ID
    if( isset($_POST['busqueda'])) {
        $busqueda = $_POST['busqueda'];
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        $busqueda = "%{$busqueda}%";

        $query = "SELECT * FROM productos WHERE 
                  nombre LIKE ? OR 
                  marca LIKE ? OR 
                  detalles LIKE ?";

        if($stmt = $conexion->prepare($query)) {
            $stmt->bind_param("sss", $busqueda, $busqueda, $busqueda);
            $stmt->execute();
            $result = $stmt->get_result();
            
            while($row = $result->fetch_assoc()) {
                $product = array();
                foreach($row as $key => $value) {
                    $product[$key] = utf8_encode($value);
                }
                $data[] = $product;
            }
            
            $stmt->close();
        } else {
            die('Query Error: '.mysqli_error($conexion));
        }
        $conexion->close();
    } 
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>