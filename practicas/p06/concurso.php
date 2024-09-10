<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información</title>
    <style>
        body{
            background-color: #7bc57c;
            margin: 0 15%;
            font-family: Lucida Sans;
        }
        h1 {
            text-align: center;
            font-family: serif;
            font-weight: normal;
            text-transform: uppercase;
            border-bottom: 1px solid #f0f2eb;
            margin-top: 30px;  
            color: #194f06; 
        }

        h2 {
            color: #6d36b5;
            font-size: 1em;  
        }
    </style>
</head>
<body>
  <h1>MUCHAS GRACIAS</h1>
  <p>Gracias por entrar al concurso de Tenis Mike® "Chidos mis Tenis". Hemos recibido la siguiente información de tu registro:</p>
  <h2>Acerca de ti:</h2>
  <div>
    <ul>
        <li>Nombre: </li>
        <?php echo $_GET['name'];?>
        <li>E-mail: </li>
        <?php echo $_GET['email'];?>
        <li>Teléfono: </li>
        <?php echo $_GET['phone'];?>
    </ul>
    <p>Tu triste historia: </p>
    <?php echo $_GET['story'];?>
   </div>

   <h2>Tu diseño de Tenis (si ganas)</h2>
  <div>
    <ul>
        <li>Color: </li>
        <li>Tamaño: </li>
    </ul>
   </div>

</body>
</html>

