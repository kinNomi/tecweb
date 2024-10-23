// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;

    // SE LISTAN TODOS LOS PRODUCTOS
    listarProductos();
}

// BUSCADOR

$(document).ready(function() {
    /*
    $('#search').keyup(function(e){
        let search = $('#search').val();
        $.ajax({
            url: 'backend/product-search.php',
            type: 'GET',
            data: { search },
            success: function(response){
                let products = JSON.parse(response);
                let template = '';

                products.forEach(product => {
                    template += `<li>${product.nombre}</li>`;
                });
            }
        });
    });
    */
    let edit = false;
    console.log('jquery is working!');

    // BUSCADOR
    $('#product-result').hide();
    $('#search').keyup(function(e){
        let search = $('#search').val();
        if(!search){
            listarProductos();
            $('#product-result').hide();
            return;
        }

        $.ajax({
            url: 'backend/product-search.php',
            type: 'GET',
            data: { search },

            success: function(response){
                let products = JSON.parse(response);
                let template = '';
                products.forEach(product => {
                    template += `<li>${product.nombre}</li>`;
                });
                $('#container').html(template);
                if(template){
                    $('#product-result').show();
                }else{
                    $('#product-result').hide();
                }

                let productTemplate = '';
                products.forEach(product => {
                    let description = '';
                    description += '<li>Precio: ' + product.precio + '</li>';
                    description += '<li>Unidades: ' + product.unidades + '</li>';
                    description += '<li>Modelo: ' + product.modelo + '</li>';
                    description += '<li>Marca: ' + product.marca + '</li>';
                    description += '<li>Detalles: ' + product.detalles + '</li>';

                    productTemplate += `<tr productId="${product.id}">
                        <td>${product.id}</td>
                        <td>
                            <a href="#" class="product-item">${product.nombre}</a>
                        </td>
                        <td><ul>${description}</ul></td>

                        <td>
                            <button class="product-delete btn btn-danger">Eliminar</button>
                        </td>
                    </tr>`;
                });

                $('#products').html(productTemplate);
            }
        });
    });
    
    /*
    $('#product-result').hide();
    $('#search').keyup(function(e) {
        e.preventDefault();

        if ($('#search').val()) {
            let search = $('#search').val();

            $.ajax({
                url: 'backend/product-search.php',
                type: 'GET',
                data: { search },
                success: function(response) {
                    let products = JSON.parse(response);
                    if (products.length == 0) {
                        $('#product-result').hide();
                        return;
                    }

                    //let products = JSON.parse(response);
                    let template = '';

                    products.forEach(product => {
                        template += `
                        <li>
                        ${product.nombre}
                        </li>
                        `;
                    });

                    $('#container').html(template); // SE MUESTRA EL TEMPLATE
                    $('#product-result').show(); // SE MUESTRA EL DIV

                    template = ''; // SE LIMPIA EL TEMPLATE
                    products.forEach(product => {
                        template += `
                        <tr product-id="${product.id}">
                            <td>${product.id}</td>

                            <td>
                                <a href="#" class="product-item">${product.nombre}</a>
                            </td>

                            <td>
                                <ul>
                                    <li>Marca: ${product.marca}</li>
                                    <li>Modelo: ${product.modelo}</li>
                                    <li>Precio: ${product.precio}</li>
                                    <li>Unidades: ${product.unidades}</li>
                                    <li>Detalles: ${product.detalles}</li>
                                </ul>
                            </td>

                            <td>
                                <button class="product-delete btn btn-danger">Eliminar</button>
                            </td>
                        </tr>`;
                    });

                    $('#products').html(template);
                }
            });
        }
        else{
            $('#product-result').hide();
        }
    });
    */

    //AGREGAR PRODUCTO
    $('#product-form').submit(function(e) {
        e.preventDefault();

        let productoJSONstring = $('#description').val();
        let productoJSON = JSON.parse(productoJSONstring);  // PARSEA EL JSON
        productoJSON['nombre'] = $('#name').val();
        productoJSON['id'] = $('#product-id').val();

        // VALIDACIONES
        if(nombre(productoJSON['nombre']) || marca(productoJSON['marca']) || modelo(productoJSON['modelo']) || precio(productoJSON['precio']) || detalles(productoJSON['detalles']) || unidades(productoJSON['unidades'])){
            return;
        }
        productoJSON = JSON.stringify(productoJSON); // CONVIERTE EL JSON A STRING

        //SI SE EDITA UN PRODUCTO
        if(edit){
            $.post('backend/product-edit.php', productoJSON, function(response){
                console.log(response);
                listarProductos(); 
                listarProductos(); // LISTA LOS PRODUCTOS
            });
            edit = false;
            listarProductos();
            return;
        }

        //SI SE AGREGA UN PRODUCTO
        $.post('backend/product-add.php', productoJSON, function(response){
            console.log(response);
            listarProductos();
        });
    });


    //ELIMINAR PRODUCTO
    $(document).on('click', '.product-delete', function(){
        if (!confirm('¿Estás seguro de querer eliminar este producto?')) {
            return; // SI NO SE CONFIRMA, NO SE ELIMINA
        }

        let element = $(this)[0];
        let columna = element.parentElement;
        let fila = columna.parentElement;

        let productId = $(fila).attr('product-id');

        $.post('backend/product-delete.php', {id : productId}, function(response){
            console.log(response);
            listarProductos();
            listarProductos();
        });
        listarProductos();
    });

    //EDITAR PRODUCTO
    $(document).on('click', '.product-item', function(){
        let element = $(this)[0].parentElement.parentElement;
        let productId = $(element).attr('product-id');
        $.post('backend/product-single.php', {id : productId}, function(response){
            let producto = JSON.parse(response);
            console.log(producto);

            $('#name').val(producto.nombre);
            delete producto.nombre;
            let idProd = producto.id;
            delete producto.id;
            $('#description').val(JSON.stringify(producto,null,2));
            $('#product-id').val(idProd);
            edit = true;
        });
    });

});



function listarProductos() {
    $.ajax({
        url: 'backend/product-list.php',
        type: 'GET',
        success: function(response) {
            let products = JSON.parse(response);
            let template = '';

            products.forEach(product => {
                template += `<tr product-id="${product.id}">
                    <td>${product.id}</td>

                    <td>
                        <a href="#" class="product-item">${product.nombre}</a>
                    </td>   
                    <td>
                        <ul>
                            <li>Marca: ${product.marca}</li>
                            <li>Modelo: ${product.modelo}</li>
                            <li>Precio: ${product.precio}</li>
                            <li>Unidades: ${product.unidades}</li>
                            <li>Detalles: ${product.detalles}</li>
                        </ul>
                    </td>

                    <td>
                        <button class="product-delete btn btn-danger">Eliminar</button>
                    </td>
                </tr>`;
            });

            $('#products').html(template);
        }
    });
}


//VALIDACIONES
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