// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };

// FUNCIÓN CALLBACK DE BOTÓN "Buscar"
function buscarID(e) {
    /**
     * Revisar la siguiente información para entender porqué usar event.preventDefault();
     * http://qbit.com.mx/blog/2013/01/07/la-diferencia-entre-return-false-preventdefault-y-stoppropagation-en-jquery/#:~:text=PreventDefault()%20se%20utiliza%20para,escuche%20a%20trav%C3%A9s%20del%20DOM
     * https://www.geeksforgeeks.org/when-to-use-preventdefault-vs-return-false-in-javascript/
     */
    e.preventDefault();

    // SE OBTIENE EL ID A BUSCAR
    var busqueda = document.getElementById('search').value;

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/read.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            console.log('[CLIENTE]\n'+client.responseText);
            
            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let productos = JSON.parse(client.responseText);    // similar a eval('('+client.responseText+')');
            console.log(productos);
            // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
            if(Object.keys(productos).length > 0) {
                // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                let descripcion = '';
                    descripcion += '<li>Precio: '+productos.precio+'</li>';
                    descripcion += '<li>Unidades: '+productos.unidades+'</li>';
                    descripcion += '<li>Modelo: '+productos.modelo+'</li>';
                    descripcion += '<li>Marca: '+productos.marca+'</li>';
                    descripcion += '<li>Detalles: '+productos.detalles+'</li>';
                
                // SE CREA UNA PLANTILLA PARA CREAR LA(S) FILA(S) A INSERTAR EN EL DOCUMENTO HTML
                let template = '';
                    template += `
                        <tr>
                            <td>${productos.id}</td>
                            <td>${productos.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                        </tr>
                    `;

                // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                document.getElementById("productos").innerHTML = template;
            }
        }
    };
    client.send("busqueda="+busqueda);
}

// FUNCIÓN CALLBACK DE BOTÓN "Agregar Producto"
function agregarProducto(e) {
    e.preventDefault();

    var productoJsonString = document.getElementById('description').value;
    var finalJSON = JSON.parse(productoJsonString);
    finalJSON['nombre'] = document.getElementById('name').value;

    if(nombre(finalJSON['nombre']) || marca(finalJSON['marca']) || modelo(finalJSON['modelo']) || precio(finalJSON['precio']) || detalles(finalJSON['detalles']) || unidades(finalJSON['unidades'])){
        return;
    }
    productoJsonString = JSON.stringify(finalJSON,null,2);

    var client = getXMLHttpRequest();
    client.open('POST', './backend/create.php', true);
    client.setRequestHeader('Content-Type', "application/json;charset=UTF-8");
    client.onreadystatechange = function () {
        if (client.readyState == 4 && client.status == 200) {
            console.log(client.responseText);
            //var response = JSON.parse(client.responseText);
            //if(response.status === 'success') {
            alert(client.responseText);
            // Actualizar la tabla de productos
            buscarProducto(new Event('submit'));
        } //else {
            //    alert(response.message);
            //}
    };
    client.send(productoJsonString);
}

// SE CREA EL OBJETO DE CONEXIÓN COMPATIBLE CON EL NAVEGADOR
function getXMLHttpRequest() {
    var objetoAjax;

    try{
        objetoAjax = new XMLHttpRequest();
    }catch(err1){
        /**
         * NOTA: Las siguientes formas de crear el objeto ya son obsoletas
         *       pero se comparten por motivos historico-académicos.
         */
        try{
            // IE7 y IE8
            objetoAjax = new ActiveXObject("Msxml2.XMLHTTP");
        }catch(err2){
            try{
                // IE5 y IE6
                objetoAjax = new ActiveXObject("Microsoft.XMLHTTP");
            }catch(err3){
                objetoAjax = false;
            }
        }
    }
    return objetoAjax;
}

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;
}

function buscarProducto(e) {
   
    e.preventDefault();

    // SE OBTIENE LA BÚSQUEDA
    var busqueda = document.getElementById('busqueda').value;
    let client = getXMLHttpRequest();

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    //var client = getXMLHttpRequest();
    client.open('POST', './backend/read.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            console.log('[CLIENTE]\n'+client.responseText);

            //SE OBTIENE EL ARREGLO DEL LOS PRODUCTOS
            let productos = JSON.parse(client.responseText);
            
            //SE VERIFICA SI EL ARREGLO TIENE DATOS
            if (productos.length > 0) {
                //SE CREA UNA PLANTILLA PARA INSERTAR EN HTML
                let template = '';
                productos.forEach(producto => {
                    let descripcion = '';
                    descripcion += '<li>Precio: '+producto.precio+'</li>';
                    descripcion += '<li>Unidades: '+producto.unidades+'</li>';
                    descripcion += '<li>Modelo: '+producto.modelo+'</li>';
                    descripcion += '<li>Marca: '+producto.marca+'</li>';
                    descripcion += '<li>Detalles: '+producto.detalles+'</li>';

                    template += `
                        <tr>
                            <td>${producto.id}</td>
                            <td>${producto.nombre}</td>
                            <td>${descripcion}</td>
                        </tr>
                    ;`
                });

                //SE INSERTA LA PLANTILLA
                document.getElementById("productos").innerHTML = template;
            }else{
                document.getElementById("productos").innerHTML = '<tr><td colspan = "3">No se encontraron productos</td></tr>';
            }
        }
    };
    client.send("busqueda"+busqueda);
}
    /*
            
            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let productos = JSON.parse(client.responseText);    // similar a eval('('+client.responseText+')');
            
            //SE VERIFA SI EL JSON TIENE DATOS
            if (Object.keys(productos).length > 0) {
                if (productos["error"] == 'Sin resultados') {
                    alert("No se encontraron productos");
                    
                }else{
                    let contenido = '';
                        //let template = '';

                        //SE MUESTRAN LOS DATOS
                    productos.forEach(producto => {
                            let descripcion = `
                                <li>Precio: ${producto.precio}</li>
                                <li>Unidades: ${producto.unidades}</li>
                                <li>Modelo: ${producto.modelo}</li>
                                <li>Marca: ${producto.marca}</li>
                                <li>Detalles: ${producto.detalles}</li>
                            `;

                        contenido += `
                            <tr>
                                <td>${producto.id}</td>
                                <td>${producto.nombre}</td>
                                <td><ul>${descripcion}</ul></td>
                            </tr>
                        `;

                    });
            
                    // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                    document.getElementById("productos").innerHTML = contenido;
                } //else{
                //SI NO HAY, SE LIMPIA LA TABLA
                //document.getElementById("productos").innerHTML = '<tr><td colspan = "3">Sin resultados</td></tr>';
            }
        }
    }
    //SE ENVIA LA PETICION AL SEVIDOR
    client.send("busqueda="+busqueda);
}
*/
/*
function Escuchar() {
    if (this.readyState == 4 && this.status == 200) {
        //console.log('[CLIENTE]\n'+client.responseText);
        
        // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
        let productos = JSON.parse(this.responseText);    // similar a eval('('+client.responseText+')');
        
        //SE VERIFA SI EL JSON TIENE DATOS
        if (Object.keys(productos).length > 0) {
            if (productos["error"] == 'Sin resultados') {
                alert("No se encontraron productos")
                
            }else{
                let i = 0;
                let descripcion = '';
                let template = '';
                while(productos[i] != undefined)
                {
                    descripcion = '';
                    descripcion =+ '<li>Precio: ' + productos[i].precio + '</li>';
                    descripcion =+ '<li>Unidades: ' + productos[i].unidades + '</li>';
                    descripcion =+ '<li>Modelo: ' + productos[i].modelo + '</li>';
                    descripcion =+ '<li>Marca: ' + productos[i].marca + '</li>';
                    descripcion =+ '<li>Detalles: ' + productos[i].detalles + '</li>';
                
                    template += `
                        <tr>
                            <td>${productos[i].id}</td>
                            <td>${productos[i].nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                        </tr>
                    `;

                    i++;
                }
            }
            
            //se inserta 
            document.getElementById("productos").innerHTML = template;
        }
    }
     
}
*/
function nombre(nom){

    if(nom.length > 100 || nom.length==0){

        alert("El nombre debe tener menos de 100 caracteres")
        return true;
    }else{
        return false;
    }
}

function marca(mar){
    let marcas = {
        "Audi":1,
        "Toyota":2,
        "Ford":3,
        "VW":4
    };
    if(marcas[mar] == undefined){
        alert("La marca debe ser válida");
        return true;
    }else{
        return false;
    }
}

function modelo(model){
    let regex = /^[a-zA-Z0-9]{1,25}$/; // Expresión regular
    if(model.length > 25 || regex.test(model) == false){
        alert("El modelo debe de ser de menos de 25 caracteres y caracteres válidos");
        return true;
    }else{
        return false;
    }
}

function precio(precio){
    if(Number(precio) < 99.99){
        alert("El precio debe ser mayor a 99.99");
        return true;
    }else{
        return false;
    }
}

function detalles(detalles){
    if(detalles!= ""){
        if(detalles.length > 255){
            alert("Los detalles deben tener menos de 255 caracteres");
            return true;
        }
    }
    return false;
}

function unidades(unidades){
    if(Number(unidades) < 0){
        alert("Las unidades del producto debe ser igual o mayor a cero");
        return true;
    }else{
        return false;
    }
}