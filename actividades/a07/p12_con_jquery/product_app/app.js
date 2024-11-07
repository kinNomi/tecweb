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
    //var JsonString = JSON.stringify(baseJSON,null,2);
    //document.getElementById("description").value = JsonString;

    // SE LISTAN TODOS LOS PRODUCTOS
    listarProductos();
}


$(document).ready(function() {
   
    let edit = false;
    console.log('jquery is working!');

    //INICIALIZACION DE LOS EVENTOS DE VALIDACION
    $('#name').blur(validarNombre);
    $('#brand').blur(validarMarca);
    $('#model').blur(validarModelo);
    $('#price').blur(validarPrecio);
    $('#units').blur(validarUnidades);
    $('#details').blur(validarDetalles);

    //VALIDACION NOMBRE
    $('#name').keyup(function() {
        let nombreProducto = $(this).val().trim();
    
        if (nombreProducto.length > 0) {
            $.ajax({
                url: 'backend/product-searchName.php',
                type: 'GET',
                data: { nombre: nombreProducto },
                success: function(response) {
                    let result = JSON.parse(response);
                    if (result.exists) {
                        $('#nameStatus').text("El nombre del producto ya existe").removeClass("text-success").addClass("text-danger");
                    } else {
                        $('#nameStatus').text("Nombre disponible").removeClass("text-danger").addClass("text-success");
                    }
                }
            });
        } else {
            $('#nameStatus').text("").removeClass("text-danger text-success");
        }
    });

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
    
   
    //AGREGAR PRODUCTO
    $('#product-form').submit(function(e) {
        e.preventDefault();

        $('#container').html('');

        //VALIDACIONES
        let nombreValido = validarNombre();
        let marcaValida = validarMarca();
        let modeloValido = validarModelo();
        let precioValido = validarPrecio();
        let detallesValidos = validarDetalles();
        let unidadesValidas = validarUnidades();

        if (!(nombreValido && marcaValida && modeloValido && precioValido && detallesValidos && unidadesValidas)) {
            $('#container').append(`<div class="alert alert-danger">Complete los datos</div>`);
            $('#product-result').show();

            return;
        }

        //SE CREA EL JSON DEL PRODUCTO
        let productoJSON = {
            nombre: $('#name').val(),
            id: $('#productId').val(),
            marca: $('#brand').val(),
            modelo: $('#model').val(),
            precio: parseFloat($('#price').val()),
            unidades: parseInt($('#units').val()),
            detalles: $('#details').val(),
            imagen: $('#image').val() || 'img/default.png'
        };
      
        //SI SE EDITA UN PRODUCTO
        if(edit){
            $.post('backend/product-edit.php', productoJSON, function(response){
                $('#container').html('');
                let result = JSON.parse(response);
                $('#container').append(`<div class="alert alert-${result.status}">${result.message}</div>`);
                $('#product-result').show();
                listarProductos(); 
            });
            edit = false;
            //return;
        }else{
            //SI SE AGREGA UN PRODUCTO
            $.post('backend/product-add.php', JSON.stringify(productoJSON), function(response){
                $('#container').html('');
                let result = JSON.parse(response);
                $('#container').append(`<div class="alert alert-${result.status}">${result.message}</div>`);
                $('#product-result').show();
                listarProductos(); 
            });

        }

    });


    //ELIMINAR PRODUCTO
    $(document).on('click', '.product-delete', function(){
        $('#container').html('');
        if (!confirm('¿Estás seguro de querer eliminar este producto?')) {
            return; // SI NO SE CONFIRMA, NO SE ELIMINA
        }

        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr('productId');

        $.get('backend/product-delete.php', {id}, function(response){
            let result = JSON.parse(response);
            

            $('#container').append(`<div class="alert alert-${result.status}">${result.message}</div>`);
            $('#product-result').show();
            listarProductos();
        });
    });

    //EDITAR PRODUCTO
    $(document).on('click', '.product-item', function(){
        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr('productId');
        console.log(id);
        $.post('backend/product-single.php', {id}, function(response) {
            try {
                let producto = JSON.parse(response);

                console.log(producto);
                $('#name').val(producto.nombre);
                $('#productId').val(producto.id);
                delete producto.nombre;
                delete producto.id;
                $('#brand').val(producto.marca);
                $('#model').val(producto.modelo);
                $('#price').val(producto.precio);
                $('#units').val(producto.unidades);
                $('#details').val(producto.detalles);
                $('#image').val(producto.imagen);
                edit = true;
            } catch (error) {
                console.error('Error al analizar JSON:', error, response);
            }
        });
        
    });
    listarProductos();

});



function listarProductos() {
    $.ajax({
        url: 'backend/product-list.php',
        type: 'GET',
        success: function(response) {
            let products = JSON.parse(response);
            let template = '';

            products.forEach(product => {
                template += `<tr productId="${product.id}">
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
function validarNombre(){

    let nom = $('#name').val();
    if(nom.length > 100 || nom.length==0){
        $('#nameStatus').text("El nombre debe tener menos de 100 caracteres").addClass("text-danger");
        return false;
    }else{
        $('#nameStatus').text("Nombre válido").removeClass("text-danger").addClass("text-success");
        return true;
    }
}

function validarMarca(){
    let mar = $('#brand').val();
    if(!mar){
        $('#brandStatus').text("Seleccione una marca válida").addClass("text-danger");
        return false;
    }else{
        $('#brandStatus').text("Marca válido").removeClass("text-danger").addClass("text-success");
        return true;
    }
}

function validarModelo(){
    let model = $('#model').val();
    let regex = /^[a-zA-Z0-9]{1,25}$/; // Expresión regular
    if(!regex.test(model)){
        $('#modelStatus').text("El modelo debe de ser de menos de 25 caracteres y tener caracteres válidos").addClass("text-danger");
        return false;
    }else{
        $('#modelStatus').text("Modelo válido").removeClass("text-danger").addClass("text-success");
        return true;
    }
}

function validarPrecio(){
    let precio = parseFloat($('#price').val());

    if(isNaN(precio) || precio < 99.99){
        $('#priceStatus').text("El precio debe ser mayor a 99.99").addClass("text-danger");
        return false;
    }else{
        $('#priceStatus').text("Precio válido").removeClass("text-danger").addClass("text-success");
        return true;
    }
}

function validarDetalles(){
    let detalles = $('#details').val();
    if(detalles != ""){
        if(detalles.length > 255){
            $('#detailsStatus').text("Los detalles deben tener menos de 255 caracteres").addClass("text-danger");
            return false;
        }else{
            $('#detailsStatus').text("Detalles válidos").removeClass("text-danger").addClass("text-success");
                return true;
        }
    }
    return true;
}

function validarUnidades(){
    let unidades = $('#units').val();
    if(isNaN(unidades) || unidades < 0){
        $('#unitsStatus').text("Las unidades del producto debe ser igual o mayor a cero").addClass("text-danger");
        return false;
    }else{
        $('#unitsStatus').text("Unidades válidas").removeClass("text-danger").addClass("text-success");
        return true;
    }
}