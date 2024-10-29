<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo 8</title>
</head>
<body>
    <?php
    require_once __DIR__ . '/Operacion.php';

    $suma = new Suma;
    $suma->setValor1(10);   //METODO DEFINIDO EN LA CLASE OPERACION
    $suma->setValor2(10);   //METODO DEFINIDO EN LA CLASE OPERACION
    $suma->operar();         //METODO DEFINIDO EN LA CLASE SUMA
    echo 'El resultado de la suma es: ' . $suma->getResultado(). '<br>';

    $resta = new Resta;
    $resta->setValor1(10);   //METODO DEFINIDO EN LA CLASE OPERACION
    $resta->setValor2(10);   //METODO DEFINIDO EN LA CLASE OPERACION
    $resta->operar();         //METODO DEFINIDO EN LA CLASE RESTA
    echo 'El resultado de la resta es: ' . $resta->getResultado(). '<br>';
    ?>
</body>
</html>