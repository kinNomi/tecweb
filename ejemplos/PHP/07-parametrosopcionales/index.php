<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo 7</title>
</head>

<body>
    <?php

    /*
    use EJEMPLOS\POO\Cabecera as Cabecera;  //usamos la clase Cabecera y le cambiamos el nombre a Cabecera
    require_once __DIR__ . '/Cabecera.php'; //incluimos el archivo Cabecera.php


    $cab = new Cabecera('El rincón del programador', 'center');
    $cab->graficar();
    */
    
    require_once __DIR__ . '/Cabecera.php'; //incluimos el archivo Cabecera.php


    $cab1 = new Cabecera('El rincón del programador');
    $cab1->graficar();

    echo '<br>';

    $cab2 = new Cabecera('El rincón del programador', 'left');
    $cab2->graficar();

    echo '<br>';

    $cab3 = new Cabecera('El rincón del programador', 'right', '#FF0000');
    $cab3->graficar();

    echo '<br>';

    $cab4 = new Cabecera('El rincón del programador', 'right', '#FF0000', '#FFFF00');
    $cab4->graficar();  

    ?>
</body>
</html>