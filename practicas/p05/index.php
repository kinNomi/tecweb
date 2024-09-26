<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Práctica 5</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Determina cuál de las siguientes variables son válidas y explica por qué:</p>
    <p>$_myvar,  $_7var,  myvar,  $myvar,  $var7,  $_element1, $house*5</p>
    <?php
        //AQUI VA MI CÓDIGO PHP
        $_myvar;
        $_7var;
        //myvar;       // Inválida
        $myvar;
        $var7;
        $_element1;
        //$house*5;     // Invalida
        
        echo '<h4>Respuesta:</h4>';   
    
        echo '<ul>';
        echo '<li>$_myvar es válida porque inicia con guión bajo.</li>';
        echo '<li>$_7var es válida porque inicia con guión bajo.</li>';
        echo '<li>myvar es inválida porque no tiene el signo de dolar ($).</li>';
        echo '<li>$myvar es válida porque inicia con una letra.</li>';
        echo '<li>$var7 es válida porque inicia con una letra.</li>';
        echo '<li>$_element1 es válida porque inicia con guión bajo.</li>';
        echo '<li>$house*5 es inválida porque el símbolo * no está permitido.</li>';
        echo '</ul>';
    ?>

<h2>Ejercicio 2</h2>
    <p>Proporcionar los valores de $a, $b, $c</p>
    <p>$a = “ManejadorSQL”<br>$b = 'MySQL’<br>$c = &$a</p>
    <?php
        $a = "ManejadorSQL";
        $b = 'MySQL';
        $c = &$a;
    ?>
    <p>a) Ahora muestra el contenido de cada variable</p>
    <?php
        echo '$a: '.$a.'<br>';
        echo '$b: '.$b.'<br>';
        echo '$c: '.$c.'<br>';
    ?> 

    <p>b) Agrega al código actual las siguientes asignaciones:</p>
    <p>$a = “PHP server”<br>$b = &$a</p>
    <?php
         $a = "PHP server";
         $b = &$a;
    ?>
    <p>c) Vuelve a mostrar el contenido de cada uno</p>
    <?php
        echo '$a: '.$a.'<br>';
        echo '$b: '.$b.'<br>';
        echo '$c: '.$c.'<br>';
    ?> 
    
    <h2>Ejercicio 3</h2>
    <p>Muestra el contenido de cada variable inmediatamente después de cada asignación,
    verificar la evolución del tipo de estas variables (imprime todos los componentes de los
    arreglo):</p>
    <p>$a = “PHP5”<br>$z[] = &$a<br>$b = “5a version de PHP”<br>$c = $b*10<br>$a .= $b<br>$b *= $c<br>$z[0] = “MySQL”</p>
    <?php
        $a = "PHP5";
        $z[] = &$a;
        $b = "5a version de PHP";
        $c = $b * 10;
        $a .= $b;
        $b *= $c;
        $z[0] = "MySQL";
    
        echo '$a: '.$a.'<br>';
        echo '$b: '.$b.'<br>';
        echo '$c: '.$c.'<br>';
        echo '$z[0]: '.$z[0].'<br>';   
    ?>

<h2>Ejercicio 4</h2>
    <p>Lee y muestra los valores de las variables del ejercicio anterior, pero ahora con la ayuda de
    la matriz $GLOBALS o del modificador global de PHP</p>

    <?php
        
        echo '$a: '.$GLOBALS['a'].'<br>';
        echo '$b: '.$GLOBALS['b'].'<br>';
        echo '$c: '.$GLOBALS['c'].'<br>';
    ?>

<h2>Ejercicio 5</h2>
    <p>Dar el valor de las variables $a, $b, $c al final del siguiente script:</p>
    <p>$a = “7 personas”<br>$b = (integer) $a<br>$a = “9E3”;<br>$c = (double) $a</p>

    <?php
        $a = "7 personas";
        $b = (integer) $a;
        $a = "9E3";
        $c = (double) $a;
    ?>

<h2>Ejercicio 6</h2>
    <p>Dar y comprobar el valor booleano de las variables $a, $b, $c, $d, $e y $f y muéstralas
    usando la función var_dump(<datos>).</p>
    <?php
        $a = "0";
        $b = "TRUE";
        $c = FALSE;
        $d = ($a OR $b);
        $e = ($a AND $c);
        $f = ($a XOR $b);

        //mostrar
        echo '<h4>Valores booleanos: </h4>';
        echo '$a: ';
        var_dump($a);
        echo '<br>';

        echo '$b: ';
        var_dump($b);
        echo '<br>';

        echo '$c: ';
        var_dump($c);
        echo '<br>';

        echo '$d: ';
        var_dump($d);
        echo '<br>';

        echo '$e: ';
        var_dump($e);
        echo '<br>';

        echo '$f: ';
        var_dump($f);
        echo '<br>';
    ?>

    <p>Después investiga una función de PHP que permita transformar el valor booleano de $c y $e
    en uno que se pueda mostrar con un echo:</p>
    <?php
        echo '<h4>Valores booleanos con echo: </h4>';
        echo '$c: '.(int)$c.'<br>';
        echo '$e: '.(int)$e.'<br>';
    ?>
    

</body>
</html>