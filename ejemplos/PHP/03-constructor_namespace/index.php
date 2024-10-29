<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo 3</title>
</head>

<body>
    <?php

    /*
    use EJEMPLOS\POO\Cabecera as Cabecera;  //usamos la clase Cabecera y le cambiamos el nombre a Cabecera
    require_once __DIR__ . '/Cabecera.php'; //incluimos el archivo Cabecera.php


    $cab = new Cabecera('El rincón del programador', 'center');
    $cab->graficar();
    */
    
    use EJEMPLOS\POO\Cabecera2 as Cabecera;  //usamos la clase Cabecera y le cambiamos el nombre a Cabecera
    require_once __DIR__ . '/Cabecera.php'; //incluimos el archivo Cabecera.php


    $cab = new Cabecera('El rincón del programador', 'center', 'https://cs.buap.mx');
    $cab->graficar();
    ?>
</body>
</html>