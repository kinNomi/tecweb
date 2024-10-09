<?php
/* MySQL Conexion*/
@$link = new mysqli('localhost', 'root', 'kin12345', 'marketzone');
// Chequea coneccion
if ($link === false) {
    die("ERROR: No pudo conectarse con la DB. " . mysqli_connect_error());
}


// Obtener los valores del formulario
$idProducto = mysqli_real_escape_string($link, $_POST['id']);
$nombre = mysqli_real_escape_string($link, $_POST['nombre']);
$marca = mysqli_real_escape_string($link, $_POST['marca']);
$modelo = mysqli_real_escape_string($link, $_POST['modelo']);
$precio = mysqli_real_escape_string($link, $_POST['precio']);
$unidades = mysqli_real_escape_string($link, $_POST['unidades']);
$detalles = mysqli_real_escape_string($link, $_POST['detalles']);
$imagen = mysqli_real_escape_string($link, $_POST['imagen']);

// Verificar si todos los campos requeridos están presentes
if(empty($idProducto) || empty($nombre) || empty($marca) || empty($modelo) || empty($precio)){
    die("ERROR: Faltan campos obligatorios.");
}

// Preparar la consulta SQL para actualizar el registro
$sql = "UPDATE productos 
        SET nombre='$nombre', marca='$marca', modelo='$modelo', precio='$precio', 
            unidades='$unidades', detalles='$detalles', imagen='$imagen' 
        WHERE id='$idProducto'";

// Ejecutar la consulta
if(mysqli_query($link, $sql)){
    echo "Producto actualizado correctamente.";
} else {
    echo "ERROR: No se pudo actualizar el producto. " . mysqli_error($link);
}

// Cerrar la conexión
mysqli_close($link);

?>