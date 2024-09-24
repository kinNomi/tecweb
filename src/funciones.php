<?php

//numero multiplo de 3 y 5
function multiplo5_7($num){
    if ($num%5==0 && $num%7==0)
    {
        echo '<h3>R= El número '.$num.' SÍ es múltiplo de 5 y 7.</h3>';
    }
    else
    {
        echo '<h3>R= El número '.$num.' NO es múltiplo de 5 y 7.</h3>';
    }
    
}

//numero aleatorio
function numAleatorio(){
    return rand(1,200); //intervalo de numeros aleatorios
}

//si es par
function par($numero){
    return $numero % 2 == 0;
}

//lleanar matriz con numeros aleatorios
function llenarMatriz($numFila, $numColumna){
    $matriz = [];
    $numeros = 0;
    $encontrada = false;
    $salida = "";

    for ($i = 0; $i < $numFila && !$encontrada; $i++){
        $fila = [];
        for ($j = 0; $j < $numColumna; $j++){
            $fila[] = numAleatorio();
            $numeros++;
        }
        //verifica 
        if(condicionParo($fila)){
            $encontrada = true;
            
        }

        $matriz[] = $fila;  //agrega otra fila
    }

    // Generar la salida como una cadena
    foreach ($matriz as $fila) {
        $salida .= implode(", ", $fila) . "<br>";
    }
    

    if($encontrada){
        $salida .= '<h3>R= '.$numeros.' números obtenidos en '.$i.' iteraciones.</h3>';
        //echo '<h3>R= '.$numeros.' números obtenidos en '.$i.' iteraciones.</h3>';
    }

    return $salida;

}

//condicion si es impar, par, impar
function condicionParo($fila){
    return !par($fila[0]) && par($fila[1]) && !par($fila[2]);
}


//verificar si es multiplo de otro
function siMultiplo($numero, $multiplo){
    return $numero % $multiplo == 0;
}

//encontrar multiplo con WHILE
function cicloWhile($multiplo){
    $numero = numAleatorio();
    
    while(!siMultiplo($numero, $multiplo)){
        $numero = numAleatorio();
    }

    echo '<h3> '.$numero.' es el primer múltiplo de '.$multiplo.' con ciclo WHILE.</h3>'; 
}


//encontrar multiplo con DO-WHILE
function cicloDOWhile($multiplo){

    do {
        $numero = numAleatorio();   
    } while (!siMultiplo($numero, $multiplo));

    echo '<h3> '.$numero.' es el primer múltiplo de '.$multiplo.' con ciclo DO-WHILE.</h3>'; 
}

//areglo con valores ASCCI
function arregloASCII($min, $max){
    $arr = [];

    //ciclo for para ASCII
    for ($i = $min; $i <= $max ; $i++) { 
        $arr[$i] = chr($i);
    }

    foreach ($arr as $clave => $valor) {
        echo "{$clave} => {$valor} " .'<br>';
        //print_r($arr);
    }
}


?>

