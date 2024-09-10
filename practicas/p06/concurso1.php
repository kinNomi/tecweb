<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información</title>
    <style>
        body{
            background-color: #20948B;
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
            color: #A1D6E2; 
        }

        h2 {
            color: #BCBABE;
            font-size: 1em;  
        }
    </style>
</head>
<body>
  <h1>MUCHAS GRACIAS</h1>
  <p>Gracias por entrar al concurso de Tenis Mike® "Chidos mis Tenis". Hemos recibido la siguiente información de tu registro:</p>
  <h2><b>Acerca de ti:</b></h2>
  <div>
    <ul>
        <li><b>Nombre:</b> <?php echo $_GET['name'];?> </li>   
        <li><b>E-mail:</b> <?php echo $_GET['email'];?></li>
        <li><b>Teléfono:</b> <?php echo $_GET['phone'];?></li>     
    </ul>
    <p><b>Tu triste historia:</b> </p>
    <?php echo $_GET['story'];?>
   </div>

   <h2><b>Tu diseño de Tenis (si ganas)</b></h2>
  <div>
    <ul>
        <li><b>Color:</b> <?php echo $_GET['color'];?> </li>
        <li><b>Tamaño:</b> <?php echo $_GET['size'];?></li>
    </ul>
   </div>

</body>
</html>

