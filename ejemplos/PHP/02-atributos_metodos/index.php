<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejemplo de 2</title>
</head>

<body>
    <?php
    require_once __DIR__ . '/Menu.php';
    $menu = new Menu();
    $menu->cargar_opcion('https://www.instagram.com', 'Instagram');
    $menu->cargar_opcion('https://www.facebook.com', 'Facebook');
    $menu->cargar_opcion('https://www.x.com', 'X');
    $menu->mostrar();
    ?>
</body>
