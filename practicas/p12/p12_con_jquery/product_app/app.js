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
    console.log('jquery is working!');

    //$('#product-result').hide();
    $('#search').keyup(function(e) {
        e.preventDefault();
        if ($('#search').val()) {
            let search = $('#search').val();

            $.ajax({
                url: 'backend/product-search.php',
                type: 'GET',
                data: { search },
                success: function(response) {
                    if (response == "[]") {
                        $('#product-result').hide();
                        return;
                    }

                    let products = JSON.parse(response);
                    let template = '';

                    products.forEach(product => {
                        template += `
                        <li>
                        ${product.nombre}
                        </li>
                        `;
                    });

                    $('#product-result').show(); // SE MUESTRA EL DIV
                    $('#container').html(template); // SE MUESTRA EL TEMPLATE

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
    });


    //AGREGAR PRODUCTO
    $('#product-form').submit(function(e) {
        e.preventDefault();

        const postData = {

        }
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
