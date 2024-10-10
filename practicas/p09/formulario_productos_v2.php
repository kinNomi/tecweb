<!DOCTYPE html >
<html>

  <head>
    <meta charset="utf-8" >
    <title>Registro Productos</title>
    <style type="text/css">
      ol, ul { 
      list-style-type: none;
      }
      label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
      }
    </style>

<script>
    function validarFormulario(){
        var nombre = document.getElementById('nombre').value;
        var marca = document.getElementById('marca').value;
        var modelo = document.getElementById('modelo').value;
        var precio = document.getElementById('precio').value;
        var detalles = document.getElementById('detalles').value;
        var unidades = document.getElementById('unidades').value;
        var imagen = document.getElementById('imagen').value;


        //VALIDACIONES

        //nombre
        if (nombre === "" || nombre.length > 100) {
          alert("Ingrese nombre, debe tener menos 100 caracteres");
          return false;
        }
        
        //modelo
        var modeloRegex = /^[a-zA-Z0-9]+$/;
        if (modelo === "" || !modeloRegex.test(modelo) || modelo.length > 25) {
          alert("Ingrese modelo, debe tener 25 caracteres o menos");
          return false;
        }

        //precio
        if (precio === "" || parseFloat(precio) <= 99.99) {
          alert("El precio debe ser mayor a 99.99.");
          return false;
        }

        //detalles
        if (detalles.length > 250) {
          alert("Sus detalles tienen más de 250 caracteres");
          return false;
        }

        //unidades
        if (unidades === "" || parseInt(unidades) < 0) {
          alert("Las unidades deben ser mayores o iguales a 0");
          return false;
        }

        //imagen
        if (imagen === "") {
          /*const img = document.getElementById('imagen');
          const imagenRuta = img.files.length > 0 ? img.files[0].name : 'img/default.png';*/
          document.getElementById('imagen').value = "img/default.png"; // Ruta por defecto
        }

        return true;
    }


    
</script>
  </head>

  <body>
    <h1>Registro de productos</h1>

    <form id="formularioProductos" action="http://localhost/tecweb/practicas/p09/set_producto_v2.php" method="post" onsubmit="return validarFormulario()">

    <h2>Información del Producto</h2>

      <fieldset>
        <legend>Auto</legend>

        <ul>
          <li><label for="nombre">Nombre:</label> <input type="text" name="nombre" id="nombre" value="<?= !empty($_POST['nombre']) ? $_POST['nombre'] : '' ?>"></li>
          <li><label for="marca">Marca:</label> 
            <select name="marca" id="marca" required>
              <option value="Audi" <?= isset($_POST['marca']) && $_POST['marca'] == 'Audi' ? 'selected' : '' ?>>Audi</option>
              <option value="Toyota" <?= isset($_POST['marca']) && $_POST['marca'] == 'Toyota' ? 'selected' : '' ?>>Toyota</option>
              <option value="Ford" <?= isset($_POST['marca']) && $_POST['marca'] == 'Ford' ? 'selected' : '' ?>>Ford</option>
              <option value="VW" <?= isset($_POST['marca']) && $_POST['marca'] == 'VW' ? 'selected' : '' ?>>VW</option>
            </select>
          </li>
          <li><label for="modelo">Modelo:</label> <input type="text" name="modelo" id="modelo" value="<?= !empty($_POST['modelo']) ? $_POST['modelo'] : '' ?>"></li>
          <!-- <li><label for="precio">Precio:</label> <input type="number" placeholder="1.00" step="0.01" min="1.00" max="1000000.00" name="precio" id="precio" required></li>
        -->
          <li><label for="precio">Precio:</label> <input type="number" step="0.01" name="precio" id="precio" value="<?= !empty($_POST['precio']) ? $_POST['precio'] : '' ?>"></li>
          <li><label for="form-unidades">Unidades disponibles:</label> <input type="number" name="unidades" id="form-unidades" value="<?= !empty($_POST['unidades']) ? $_POST['unidades'] : '' ?>"></li>

          <li><label for="detalles">Detalles:<br></label><textarea name="detalles" rows="3" cols="50" id="detalles" value="<?= !empty($_POST['detalles']) ? $_POST['detalles'] : '' ?>"></textarea></li>
          <li><label for="imagen">URL imagen:</label><input type="text" name="imagen" id="imagen" value="<?= !empty($_POST['imagen']) ? $_POST['imagen'] : '' ?>"></li>

        </ul>
      </fieldset>

      <p>
        <input type="submit" value="Registrar">
        <input type="reset" value="Borrar">
      </p>

    </form>
    
  </body>
</html>