<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
	<?php
	if(isset($_GET['tope'])){
		$tope = $_GET['tope'];
	}
		

	if (!empty($tope))
	{
		/** SE CREA EL OBJETO DE CONEXION */
		@$link = new mysqli('localhost', 'root', 'kin12345', 'marketzone');	

		/** comprobar la conexión */
		if ($link->connect_errno) 
		{
			die('Falló la conexión: '.$link->connect_error.'<br/>');
			    /** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */
		}

		/** Crear una tabla que no devuelve un conjunto de resultados */
		if ( $result = $link->query("SELECT * FROM productos WHERE unidades <= $tope") ) 
		{
			$productos = $result->fetch_all(MYSQLI_ASSOC);
			/** útil para liberar memoria asociada a un resultado con demasiada información */
			$result->free();
		}

		$link->close();
	}
	?>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Productos por unidades</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!--
		<script>
        function show(event) {
            // Obtener el id de la fila donde está el botón presionado
            var rowId = event.target.parentNode.parentNode.id;

            // Obtener los datos de la fila en forma de arreglo
            var data = document.getElementById(rowId).querySelectorAll(".row-data");

            // Extraer datos
            var nombre = data[0].innerHTML;
            var marca = data[1].innerHTML;
            var modelo = data[2].innerHTML;
            var precio = data[3].innerHTML;
            var unidades = data[4].innerHTML;
            var detalles = data[5].innerHTML;

            // Mostrar los datos en una alerta
            alert("Nombre: " + nombre + "\nMarca: " + marca + "\nModelo: " + modelo);

            // Enviar los datos al formulario
            send2form(rowId, nombre, marca, modelo, precio, unidades, detalles);
        }

        function send2form(rowId, nombre, marca, modelo, precio, unidades, detalles) {
            var form = document.createElement("form");

            // Crear campos ocultos en el formulario
            var idIn = document.createElement("input");
            idIn.type = 'text';
            idIn.name = 'id';
            idIn.value = rowId;
            form.appendChild(idIn);

            // Nombre
            var nombreIn = document.createElement("input");
            nombreIn.type = 'text';
            nombreIn.name = 'nombre';
            nombreIn.value = nombre;
            form.appendChild(nombreIn);

            // Marca
            var marcaIn = document.createElement("input");
            marcaIn.type = 'text';
            marcaIn.name = 'marca';
            marcaIn.value = marca;
            form.appendChild(marcaIn);

            // Modelo
            var modeloIn = document.createElement("input");
            modeloIn.type = 'text';
            modeloIn.name = 'modelo';
            modeloIn.value = modelo;
            form.appendChild(modeloIn);

            // Precio
            var precioIn = document.createElement("input");
            precioIn.type = 'text';
            precioIn.name = 'precio';
            precioIn.value = precio;
            form.appendChild(precioIn);

            // Unidades
            var unidadesIn = document.createElement("input");
            unidadesIn.type = 'text';
            unidadesIn.name = 'unidades';
            unidadesIn.value = unidades;
            form.appendChild(unidadesIn);

            // Detalles
            var detallesIn = document.createElement("input");
            detallesIn.type = 'text';
            detallesIn.name = 'detalles';
            detallesIn.value = detalles;
            form.appendChild(detallesIn);

            // Configurar y enviar el formulario
            form.method = 'POST';
            form.action = 'http://localhost/tecweb/practicas/p09/formulario_productos_v3.php';
            document.body.appendChild(form);
            form.submit();
        }
    </script>
            -->
	</head>
	<body>
		<h3>PRODUCTOS</h3>

		<br/>
		
		<?php if( isset($productos) && count($productos) > 0 ) : ?>

			<table class="table">
				<thead class="thead-dark">
					<tr>
					<th scope="col">#</th>
					<th scope="col">Nombre</th>
					<th scope="col">Marca</th>
					<th scope="col">Modelo</th>
					<th scope="col">Precio</th>
					<th scope="col">Unidades</th>
					<th scope="col">Detalles</th>
					<th scope="col">Imagen</th>
					<th scope="col">Acciones</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($productos as $producto): ?>
						<tr>
							<th scope="row"><?= $producto['id'] ?></th>
							<td><?= $producto['nombre'] ?></td>
							<td><?= $producto['marca'] ?></td>
							<td><?= $producto['modelo'] ?></td>
							<td><?= $producto['precio'] ?></td>
							<td><?= $producto['unidades'] ?></td>
							<td><?= utf8_encode($producto['detalles']) ?></td>
							<td><img src="<?= $producto['imagen'] ?>" alt="Producto" /></td>
                        	<td>
                                <a href = "formulario_productos_v2.php?id=<?= $producto ['id'] ?>" class="btn btn-primary">Modificar</a>
                            <!--<input type="button" value="Modificar" onclick="show(event)" />-->
                        	</td>
                    </tr>
					<?php endforeach; ?>
				</tbody>
			</table>

		<?php elseif(!empty($tope)) : ?>

			 <script>
                alert('El tope del producto no existe');
             </script>

		<?php endif; ?>
	</body>
</html>