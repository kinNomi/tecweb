<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejemplo 05</title>
</head>
<body>
    <?php
    require_once __DIR__ . '/Pagina.php';

    $pag = new Pagina('El rincón del Programador', 'El sótano del Programador');

    for($i = 0; $i <= 15; $i++){
        $pag->insertar_cuerpo('Prueba No. ' . ($i+1) . ' que debe aparecer en la página');
    }

    $pag->graficar();
    ?>
</body>
</html>