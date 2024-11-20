// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };

  //VALIDACIONES
  function validarNombre() {
    let name = $('#name').val();
    let nameStatus = $('#nameStatus');
    if (name.length === 0) {
        nameStatus.text('El nombre es requerido.');
        nameStatus.addClass('text-danger');
        return false;
    } else if (name.length > 100) {
        nameStatus.text('El nombre debe tener 100 caracteres o menos.');
        nameStatus.addClass('text-danger');
        return false;
    } else {
        nameStatus.text('');
        nameStatus.removeClass('text-danger');
        return true;
    }
}

function validarMarca() {
    let brand = $('#brand').val();
    let brandStatus = $('#brandStatus');
    if(brand.length===0){
      brandStatus.text('Debes seleccionar una marca.');
      brandStatus.addClass('text-danger');
      return false;
    }else{
      brandStatus.text('');
      brandStatus.removeClass('text-danger');
      return true;
    }
}


function validarModelo() {
    let model = $('#model').val();
    let modelStatus = $('#modelStatus');
    const regex = /^[a-zA-Z0-9]{1,25}$/;
    if (!model || !regex.test(model) || model.length > 25) {
        modelStatus.text('Modelo con 25 caracteres o menos.');
        modelStatus.addClass('text-danger');
        return false;
    } else {
        modelStatus.text('');
        modelStatus.removeClass('text-danger');
        return true;
    }
}

function validarPrecio() {
    let price = parseFloat($('#price').val());
    let priceStatus = $('#priceStatus');
    if (!price || parseFloat(price) <= 99.99) {
        priceStatus.text('Precio mayor a 99.99.');
        priceStatus.addClass('text-danger');
        return false;
    } else {
        priceStatus.text('');
        priceStatus.removeClass('text-danger');
        return true;
    }
}

function validarUnidades() {
    let units = $('#units').val();
    let unitsStatus = $('#unitsStatus');
    if (isNaN(units) || units < 0) {
        unitsStatus.text('Ingresa unidades positivas.');
        unitsStatus.addClass('text-danger');
        return false;
    } else {
        unitsStatus.text('');
        unitsStatus.removeClass('text-danger');
        return true;
    }
}

function validarDetalles() {
    let details = $('#details').val();
    let detailsStatus = $('#detailsStatus');
    if (details && details.length > 250) {
        detailsStatus.text('Detalles con 250 caracteres o menos.');
        detailsStatus.addClass('text-danger');
        return false;
    } else {
        detailsStatus.text('');
        detailsStatus.removeClass('text-danger');
        return true;
    }
}

$(document).ready(function(){
    let edit = false;

    //INICIALIZACION DE LOS EVENTOS DE VALIDACION
    $('#name').on('blur', validarNombre);
    $('#brand').on('blur', validarMarca);
    $('#model').on('blur', validarModelo);
    $('#price').on('blur', validarPrecio);
    $('#units').on('blur', validarUnidades);
    $('#details').on('blur', validarDetalles);

    

    //let JsonString = JSON.stringify(baseJSON,null,2);
    //$('#description').val(JsonString);
    $('#product-result').hide();
    listarProductos();

    function listarProductos() {
        $.ajax({
            url: './backend/product-list.php',
            type: 'GET',
            success: function(response) {
                console.log(response);
                // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                const productos = JSON.parse(response);
            
                // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                if(Object.keys(productos).length > 0) {
                    // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                    let template = '';

                    productos.forEach(producto => {
                        // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                        let descripcion = '';
                        descripcion += '<li>precio: '+producto.precio+'</li>';
                        descripcion += '<li>unidades: '+producto.unidades+'</li>';
                        descripcion += '<li>modelo: '+producto.modelo+'</li>';
                        descripcion += '<li>marca: '+producto.marca+'</li>';
                        descripcion += '<li>detalles: '+producto.detalles+'</li>';
                    
                        template += `
                            <tr productId="${producto.id}">
                                <td>${producto.id}</td>
                                <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="product-delete btn btn-danger">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                    // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                    $('#products').html(template);
                }
            }
        });
    }

    $('#search').keyup(function() {
        if($('#search').val()) {
            let search = $('#search').val();
            $.ajax({
                url: './backend/product-search.php?search='+$('#search').val(),
                data: {search},
                type: 'GET',
                success: function (response) {
                    if(!response.error) {
                        // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                        const productos = JSON.parse(response);
                        
                        // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                        if(Object.keys(productos).length > 0) {
                            // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                            let template = '';
                            let template_bar = '';

                            productos.forEach(producto => {
                                // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                                let descripcion = '';
                                descripcion += '<li>precio: '+producto.precio+'</li>';
                                descripcion += '<li>unidades: '+producto.unidades+'</li>';
                                descripcion += '<li>modelo: '+producto.modelo+'</li>';
                                descripcion += '<li>marca: '+producto.marca+'</li>';
                                descripcion += '<li>detalles: '+producto.detalles+'</li>';
                            
                                template += `
                                    <tr productId="${producto.id}">
                                        <td>${producto.id}</td>
                                        <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                        <td><ul>${descripcion}</ul></td>
                                        <td>
                                            <button class="product-delete btn btn-danger">
                                                Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                `;

                                template_bar += `
                                    <li>${producto.nombre}</il>
                                `;
                            });
                            // SE HACE VISIBLE LA BARRA DE ESTADO
                            $('#product-result').show();
                            // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
                            $('#container').html(template_bar);
                            // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                            $('#products').html(template);    
                        }
                    }
                }
            });
        }
        else {
            $('#product-result').hide();
        }
    });

    $('#product-form').submit(e => {
        e.preventDefault();

        //VALIDACIONES
        let name = validarNombre();
        let brand = validarMarca();
        let model = validarModelo();
        let price = validarPrecio();
        let units = validarUnidades();
        let details = validarDetalles();
        /*
        let name = $("#name").validarNombre();
        let brand = $("#brand").validarMarca();
        let model = $("#model").validarModelo();
        let price = $("#price").validarPrecio();
        let units = $("#units").validarUnidades();
        let details = $("#details").validarDetalles();
        //const image = $("#image").val() || 'img/default.png';
        */

        // SE CONVIERTE EL JSON DE STRING A OBJETO
        //let postData = JSON.parse( $('#description').val() );
        // SE AGREGA AL JSON EL NOMBRE DEL PRODUCTO
        //postData['nombre'] = $('#name').val();
        //postData['id'] = $('#productId').val();

        
        //AQUÍ DEBES AGREGAR LAS VALIDACIONES DE LOS DATOS EN EL JSON
        //EN CASO DE NO HABER ERRORES, SE ENVIAR EL PRODUCTO A AGREGAR
        
        if (validarNombre(name) && validarMarca(brand) && validarModelo(model) && validarPrecio(price) && validarUnidades(units) && validarDetalles(details)) {
            // SE HACEN LAS VALIDACIONES
            let postData = {
                nombre: $('#name').val(),
                id: $('#productId').val(),
                marca: $('#brand').val(),
                modelo: $('#model').val(),
                precio: parseFloat($('#price').val()),
                unidades: parseInt($('#units').val()),
                detalles: $('#details').val(),
                imagen: $('#image').val() || 'img/default.png'
            };


            const url = edit === false ? './backend/product-add.php' : './backend/product-edit.php';
        
            $.post(url, postData, (response) => {
                console.log(response);
                // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                let respuesta = JSON.parse(response);
                // SE CREA UNA PLANTILLA PARA CREAR INFORMACIÓN DE LA BARRA DE ESTADO
                let template_bar = '';
                template_bar += `
                            <li style="list-style: none;">status: ${respuesta.status}</li>
                            <li style="list-style: none;">message: ${respuesta.message}</li>
                        `;
                // SE REINICIA EL FORMULARIO
                //$('#name').val('');
                //$('#description').val(JsonString);
                // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
                $('#container').html(template_bar);
                // SE HACE VISIBLE LA BARRA DE ESTADO
                $('#product-result').show();
                
                // SE LISTAN TODOS LOS PRODUCTOS
                listarProductos();
                // SE REGRESA LA BANDERA DE EDICIÓN A false
                edit = false;
            });
        }
        
    });

    
    $(document).on('click', '.product-delete', (e) => {
        if(confirm('¿Realmente deseas eliminar el producto?')) {
            const element = $(this)[0].activeElement.parentElement.parentElement;
            const id = $(element).attr('productId');
            $.post('./backend/product-delete.php', {id}, (response) => {
                $('#product-result').hide();
                listarProductos();
            });
        }
    });

    $(document).on('click', '.product-item', (e) => {
        const element = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(element).attr('productId');
        $.post('./backend/product-single.php', {id}, (response) => {
            // SE CONVIERTE A OBJETO EL JSON OBTENIDO
            let product = JSON.parse(response);
            // SE INSERTAN LOS DATOS ESPECIALES EN LOS CAMPOS CORRESPONDIENTES
            $('#name').val(product.nombre);
            // EL ID SE INSERTA EN UN CAMPO OCULTO PARA USARLO DESPUÉS PARA LA ACTUALIZACIÓN
            $('#productId').val(product.id);
            // SE ELIMINA nombre, eliminado E id PARA PODER MOSTRAR EL JSON EN EL <textarea>
            delete(product.nombre);
            delete(product.eliminado);
            delete(product.id);
            // SE CONVIERTE EL OBJETO JSON EN STRING
            //let JsonString = JSON.stringify(product,null,2);
            // SE MUESTRA STRING EN EL <textarea>
            //$('#description').val(JsonString);
            $('#brand').val(product.marca);
            $('#model').val(product.modelo);
            $('#price').val(product.precio);
            $('#units').val(product.unidades);
            $('#details').val(product.detalles);
            $('#image').val(product.imagen);
            // SE PONE LA BANDERA DE EDICIÓN EN true
            edit = true;
        });
        e.preventDefault();
    });    
});