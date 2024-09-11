<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 7</title>
</head>
<body>

<!--Se incluye el doc con las funciones-->
    <?php
    include_once('C:\xampp\htdocs\tecweb\src\funciones.php');
    ?>
    <h2>Ejercicio 1</h2>
    <form action="http://localhost/tecweb/practicas/p07/index.php" method="get">
        <p>Escribir programa para comprobar si un número es un múltiplo de 5 y 7</p>
        Número: <input type="number" name="numero"><br> 
        <?php
            if(isset($_GET['numero']))
            {
                $numero = $_GET['numero'];
                echo multiplo5_7($numero);

            }
        ?>
    </form>
    
    <h2>Ejercicio 2</h2>
    <p>Crea un programa para la generación repetitiva de 3 números aleatorios hasta obtener una
    secuencia compuesta por: impar  par impar</p>

    <h2>Ejercicio 3</h2>
    <p>Utiliza un ciclo while para encontrar el primer número entero obtenido aleatoriamente,
    pero que además sea múltiplo de un número dado. </p>

    <h2>Ejercicio 4</h2>
    <p>Crear un arreglo cuyos índices van de 97 a 122 y cuyos valores son las letras de la ‘a’
    a la ‘z’. Usa la función chr(n) que devuelve el caracter cuyo código ASCII es n para poner
    el valor en cada índice.</p>

    <h2>Ejemplo de POST</h2>
    <form action="http://localhost/tecweb/practicas/p07/index.php" method="post">
        Name: <input type="text" name="name"><br>
        E-mail: <input type="text" name="email"><br>
        <input type="submit">
    </form>
    <br>
    <?php
        if(isset($_POST["name"]) && isset($_POST["email"]))
        {
            echo $_POST["name"];
            echo '<br>';
            echo $_POST["email"];
        }
    ?>
</body>
</html>