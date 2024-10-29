/*
function getDatos(){
    var nombre = window.prompt("Nombre:", "");
    var edad = prompt("Edad:", "");

    var div1 = document.getElementById('nombre');
    div1.innerHTML = '<h3> Nombre: ' + nombre + '</h3>';

    var div2 = document.getElementById('edad');
    div2.innerHTML = '<h3> Edad: ' + edad + '</h3>';
}
    */

function saludo(){
    var div1 = document.getElementById('saludo');
    div1.innerHTML = 'Hola mundo!!! <br>';
}

function mostrar(){
    var nombre = 'Juan';
    var edad = 10;
    var altura = 1.92;
    var casado = false;
    
    var div2 = document.getElementById('variables');
    div2.innerHTML = 'Nombre: ' + nombre + '<br>' +
                    'Edad: ' + edad + '<br>' +
                    'Altura: ' + altura + '<br>' +
                    'Casado: ' + casado + '<br>';
    
}

function datos(){
    
    var nombre = prompt('Ingresa tu nombre: ', '');
    var edad = prompt('Ingresa tu edad:', '');
    var div3 = document.getElementById('datos');
    div3.innerHTML = 'Hola ' + nombre + ', así que tienes ' + edad + ' años' + '<br>'; 
              
}

function sumaMultipli(){
    var valor1 = prompt('Introducir primer número:', '');
    var valor2 = prompt('Introducir segundo número', '');
    var suma = parseInt(valor1)+parseInt(valor2);
    var producto = parseInt(valor1)*parseInt(valor2);

    var div4 = document.getElementById('operaciones');
    div4.innerHTML = 'La suma es: ' + suma +
                    '<br>' + 'El producto es: ' + producto; 
}

function aprobado(){
    var nombre = prompt('Ingresa tu nombre:', '');
    var nota = prompt('Ingresa tu nota:', '');
    var div5 = document.getElementById('if');
    if (nota>=4) {
        div5.innerHTML = nombre + ' está aprobad@ con un: ' + nota;
    }
}

function numMayor(){
    var num1 = prompt('Ingresa el primer número:', '');
    var num2 = prompt('Ingresa el segundo número:', '');
    var div6 = document.getElementById('ifElse');
    num1 = parseInt(num1);
    num2 = parseInt(num2);
    if (num1>num2) {
        div6.innerHTML = 'El mayor es: ' + num1; 
    }
    else {
        div6.innerHTML = 'El mayor es: ' + num2; 
    }
}

function notas(){
    var nota1 = prompt('Ingresa 1ra. nota:', '');
    var nota2 = prompt('Ingresa 2da. nota:', '');
    var nota3 = prompt('Ingresa 3ra. nota:', '');
    var div7 = document.getElementById('ifElseAnidados');

    //Convertimos los 3 string en enteros
    nota1 = parseInt(nota1);
    nota2 = parseInt(nota2);
    nota3 = parseInt(nota3);

    var pro = (nota1+nota2+nota3)/3;

    if (pro>=7) {
        div7.innerHTML = 'Aprobado'; 
    }
    else {
        if (pro>=4) {
            div7.innerHTML = 'Regular'; 
        }
        else {
            div7.innerHTML = 'Reprobado'; 
        }
    }
}

function rango(){
    var valor = prompt('Ingresar un valor comprendido entre 1 y 5:', '' );
    //Convertimos a entero
    valor = parseInt(valor);
    var div8 = document.getElementById('switch');


    switch (valor) {

        case 1: div8.innerHTML = 'Uno'; 
        ;
            break;

        case 2: div8.innerHTML = 'Dos'; 

            break;

        case 3: div8.innerHTML = 'Tres'; 

            break;

        case 4: div8.innerHTML = 'Cuatro'; 

            break;

        case 5: div8.innerHTML = 'Cinco'; 

            break;

        default:div8.innerHTML = 'Debe ingresar un valor comprendido entre 1 y 5'; 
    }
}

function color(){
    var col = prompt('Ingresa el color con que quierar pintar el fondo de la ventana (rojo, verde, azul' , '' );
    var div9 = document.getElementById('switch2');

    switch (col) {
    case 'rojo': div9.style.backgroundColor='#ff0000';
    
    break;
    
    case 'verde': div9.style.backgroundColor='#00ff00';
    
    break;
    
    case 'azul': div9.style.backgroundColor='#0000ff';
    
    break;
    
    }
}

function incrementar(){
    var x=1;
    var div10 = document.getElementById('while');

    while (x<=100) {
        div10.innerHTML += x + '<br>'; 
        x=x+1;
    }
}

function suma(){
    var x=1;
    var suma=0;
    var valor;
    var div11 = document.getElementById('while2');

    while (x<=5){
        valor = prompt('Ingresa el valor: '+ x, '');
        valor = parseInt(valor);
        suma = suma+valor;
        x = x+1;
    }

    div11.innerHTML = 'La suma de los valores es: ' + suma + '<br>';
}

function digitos(){
    var valor;
    var div12 = document.getElementById('doWhile');
    do{
        valor = prompt('Ingresa un valor entre 0 y 999:', '');
        valor = parseInt(valor);
        div12.innerHTML+= 'El valor '+valor+' tiene: ';
        if (valor<10)
            div12.innerHTML+='1 dígitos';
        else
            if (valor<100) {
                div12.innerHTML+='2 dígitos';
            }
            else {
                div12.innerHTML+='3 dígitos';
            }
        div12.innerHTML += '<br>';

    }while(valor!=0);
}

function numeros(){
    var f;
    var div13 = document.getElementById('for');
 
    for(f=1; f<=10; f++)
    {
        div13.innerHTML += f + '<br>';
        }

}

function advertencia(){
    var div14 = document.getElementById('mensaje');
    div14.innerHTML = 'Cuidado' + '<br>';
    div14.innerHTML += 'Ingresa tu documento correctamente' + '<br>';
    div14.innerHTML += 'Cuidado' + '<br>';
    div14.innerHTML += 'Ingresa tu documento correctamente' + '<br>';
    div14.innerHTML += 'Cuidado' + '<br>';
    div14.innerHTML += 'Ingresa tu documento correctamente' + '<br>';
}

function advertencia1(a){
    var div15 = document.getElementById('mensajeF');
    var f;
    for (f=1; f<=a; f++){
        div15.innerHTML += 'Cuidado' + '<br>';
        div15.innerHTML += 'Ingresa tu documento correctamente' + '<br>';
    }
    
}

function mostrarRango(){
    
    var div16 = document.getElementById('rangoF');
    var v1 = prompt('Ingresa el valor inferior:', '');
    v1 = parseInt(v1);
    var v2 = prompt('Ingresa el valor superior:', '');
    v2 = parseInt(v2);
    var inicio;
    for(inicio=v1; inicio<=v2; inicio++) {
        div16.innerHTML += inicio + '<br>';
    }
}

function convertirNum(){
    var div17 = document.getElementById('ifElseFunc');
    var x = prompt('Ingresar un valor comprendido entre 1 y 5:', '' );
    //Convertimos a entero
    x = parseInt(x);
    if(x==1)
        return div17.innerHTML = 'uno';
        else
            if(x==2)
        
                return div17.innerHTML = 'dos';
            else
                if(x==3)
                    return div17.innerHTML = 'tres';
                else
                     if(x==4)
        
                        return div17.innerHTML = 'cuatro';
        
                    else
        
                        if(x==5)
                            return div17.innerHTML = 'cinco';
                        else
                            return div17.innerHTML = 'valor incorrecto';
}

function convertirNum2(){
    var div18 = document.getElementById('switchFunc');
    var x = prompt('Ingresar un valor comprendido entre 1 y 5:', '' );
    //Convertimos a entero
    x = parseInt(x);

    switch (x) {
        case 1: return div18.innerHTML = "uno";
        case 2: return div18.innerHTML = "dos";
        case 3: return div18.innerHTML = "tres";
        case 4: return div18.innerHTML = "cuatro";
        case 5: return div18.innerHTML = "cinco";
        default: return div18.innerHTML = "valor incorrecto";
    }
}