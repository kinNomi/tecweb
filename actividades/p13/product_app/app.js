// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };

$(document).ready(function(){
    let edit = false;

    //VALIDACIONES
    function validarNombre(name) {
        // Check for required field and length (100 chars max)
        if (!name || name.length > 100) {
            $("#nameStatus").text("Nombre 100 caracteres o menos.");
            return false;
        } else {
            $("#nameStatus").text("");
            return true;
        }
    }

    function validarMarca(brand) {
      // Check for required selection.
      if (!brand) {
          $("#brandStatus").text("Marca requerida.");
          return false;
      } else {
          $("#brandStatus").text("");
          return true;
      }
    }


    function validarModelo(model) {
        // Check for required field, alphanumeric characters, and length (25 chars max)
        if (!model || !/^[a-zA-Z0-9]+$/.test(model) || model.length > 25) {
            $("#modelStatus").text("Modelo con 25 caracteres o menos.");
            return false;
        } else {
            $("#modelStatus").text("");
            return true;
        }
    }

    function validarPrecio(price) {
        // Check for required field and minimum value
        if (!price || parseFloat(price) <= 99.99) {
            $("#priceStatus").text("Precio mayor a 99.99.");
            return false;
        } else {
            $("#priceStatus").text("");
            return true;
        }
    }

    function validarUnidades(units) {
        // Check for required field and non-negative value
        if (!units || parseInt(units) < 0) {
            $("#unitsStatus").text("Unidades positivas.");
            return false;
        } else {
            $("#unitsStatus").text("");
            return true;
        }
    }

    function validarDetalles(details) {
        // Check for maximum length (250 chars)
        if (details && details.length > 250) {
            $("#detailsStatus").text("Detalles con 250 caracteres o menos.");
            return false;
        } else {
            $("#detailsStatus").text("");
            return true;
        }
    }

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
        const name = $("#name").val();
        const brand = $("#brand").val();
        const model = $("#model").val();
        const price = $("#price").val();
        const units = $("#units").val();
        const details = $("#details").val();
        //const image = $("#image").val() || 'img/default.png';


        // SE CONVIERTE EL JSON DE STRING A OBJETO
        //let postData = JSON.parse( $('#description').val() );
        // SE AGREGA AL JSON EL NOMBRE DEL PRODUCTO
        //postData['nombre'] = $('#name').val();
        //postData['id'] = $('#productId').val();

        
        //AQUÍ DEBES AGREGAR LAS VALIDACIONES DE LOS DATOS EN EL JSON
        //EN CASO DE NO HABER ERRORES, SE ENVIAR EL PRODUCTO A AGREGAR
        
        if (validarNombre(name) && validarMarca(brand) && validarModelo(model) && validarPrecio(price) && validarUnidades(units) && validarDetalles(details)) {
            // SE HACEN LAS VALIDACIONES
            const postData = {
                nombre: name,
                marca: brand,
                modelo: model,
                precio: price,
                unidades: units,
                detalles: details,
                imagen: image || 'img/default.png',
                id: $("#productId").val() // Include ID for updates
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

    $("#name").on("input", function() { validarNombre($(this).val()); });
    $("#brand").on("change", function() { validarMarca($(this).val()); });
    $("#model").on("input", function() { validarModelo($(this).val()); });
    $("#price").on("input", function() { validarPrecio($(this).val()); });
    $("#units").on("input", function() { validarUnidades($(this).val()); });
    $("#details").on("input", function() { validarDetalles($(this).val()); });


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
            let JsonString = JSON.stringify(product,null,2);
            // SE MUESTRA STRING EN EL <textarea>
            $('#description').val(JsonString);
            
            // SE PONE LA BANDERA DE EDICIÓN EN true
            edit = true;
        });
        e.preventDefault();
    });    
});