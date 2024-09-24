<?php
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $precio = $_POST['precio'];
    $unidades = $_POST['unidades'];
    $detalles = $_POST['detalles'];
    $imagen = $_POST['imagen'];

    /** SE CREA EL OBJETO DE CONEXION */
	@$link = new mysqli('localhost', 'root', 'kin12345', 'marketzone');	

	/** comprobar la conexión */
    if ($link->connect_errno) 
    {
        die('Falló la conexión: '.$link->connect_error.'<br/>');
            /** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */
    }

    //que el producto no exista ya
    $sql = "SELECT * FROM productos WHERE nombre = ? AND marca = ? AND modelo = ?";
    $stmt = $link -> prepare($sql);
    $stmt -> bind_param("sss", $nombre, $marca, $modelo);
    $stmt -> execute();
    $result = $stmt -> get_result();

    if ($result -> num_rows > 0){
        echo '<h2>Error:El producto ya está en la BD</h2>';

    }else{
        $sql_insert = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen)
                       VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt_insert = $link -> prepare ($sql_insert);
        $stmt_insert -> bind_param("sssdsis", $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen);

        if ($stmt_insert->execute()){

            echo '<h2>Producto registrado</h2>';

        }else{
            echo '<h2>Error: no se pudo registrar el producto</h2>';
        }

    }
    //cerrar conexion
    $link->close();
?>