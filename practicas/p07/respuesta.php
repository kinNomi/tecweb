<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados</title>
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
    <?php
    $sexo = $_POST["sexo"];
    $edad = $_POST["edad"];

    if ($sexo == "m" && (18 <= $edad && $edad <= 35)) {
        echo "<h1>Bienvenida</h1>";
        echo "<h2>Usted está en el rango de edad permitido.</h2>";
        
    }
    else {
        echo "<h1>Error</h1>";
    }
    ?>

</body>
</html>

