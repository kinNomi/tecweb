<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejemplo de 1</title>
</head>
<body>
    <?php
    require_once __DIR__ . '/Persona.php'; //obtener la ruta actual del archivo
    $per1 = new Persona();
    $per1->inicializar('Fulanito');
    $per1->mostrar();

    $per2 = new Persona();
    $per2->inicializar('Menganito');
    $per2->mostrar();
    ?>
</body>
</html>