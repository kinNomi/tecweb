<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejemplo 05</title>
</head>
<body>
    <?php
    require_once __DIR__ . '/Pagina.php';
    $pagina = new Pagina('Título de la página', 'Pie de la página');
    $pagina->insertar_cuerpo('Este es el cuerpo de la página.');
    $pagina->graficar();
    ?>
</body>
</html>