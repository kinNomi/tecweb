<?php
$vehiculos = array(
    "NIC6338" => array(
        "Auto" => array(
            "marca" => "Toyota",
            "modelo" => 2008,
            "tipo" => "Sedan"
        ),
        "Propietario" => array(
            "nombre" => "Joselin Rojas",
            "ciudad" => "Puebla",
            "direccion" => "Constitucion Poniente #101"
        )
    ),

    "AIM6770" => array(
        "Auto" => array(
            "marca" => "Honda",
            "modelo" => 2023,
            "tipo" => "Sedan"
        ),
        "Propietario" => array(
            "nombre" => "Carlos Gómez",
            "ciudad" => "Madrid",
            "direccion" => "Calle 5 #12"
        )
    ),
    "NYU1036" => array(
        "Auto" => array(
            "marca" => "Ford",
            "modelo" => 2021,
            "tipo" => "Pickup"
        ),
        "Propietario" => array(
            "nombre" => "Ana Rodríguez",
            "ciudad" => "Buenos Aires",
            "direccion" => "Av. Central 45"
        )
    ),
    "JUA2852" => array(
        "Auto" => array(
            "marca" => "Chevrolet",
            "modelo" => 2022,
            "tipo" => "Pickup"
        ),
        "Propietario" => array(
            "nombre" => "Luis Martínez",
            "ciudad" => "Ciudad de México",
            "direccion" => "Calle Sol 23"
        )
    ),
    "PNV0908" => array(
        "Auto" => array(
            "marca" => "BMW",
            "modelo" => 2021,
            "tipo" => "SUV"
        ),
        "Propietario" => array(
            "nombre" => "María Fernández",
            "ciudad" => "Lima",
            "direccion" => "Av. Libertad 101"
        )
    ),
    "FEF0475" => array(
        "Auto" => array(
            "marca" => "Audi",
            "modelo" => 2021,
            "tipo" => "Sedan"
        ),
        "Propietario" => array(
            "nombre" => "Jorge López",
            "ciudad" => "Bogotá",
            "direccion" => "Calle Norte 67"
        )
    ),
    "YXI2599" => array(
        "Auto" => array(
            "marca" => "Nissan",
            "modelo" => 2022,
            "tipo" => "Sedan"
        ),
        "Propietario" => array(
            "nombre" => "Sofía Pérez",
            "ciudad" => "Santiago",
            "direccion" => "Calle Río 8"
        )
    ),
    "MAZ1796" => array(
        "Auto" => array(
            "marca" => "Mercedes-Benz",
            "modelo" => 2021,
            "tipo" => "Hatchback"
        ),
        "Propietario" => array(
            "nombre" => "Fernando Torres",
            "ciudad" => "Quito",
            "direccion" => "Av. del Parque 3"
        )
    ),
    "UBN6338" => array(
        "Auto" => array(
            "marca" => "Jeep",
            "modelo" => 2023,
            "tipo" => "SUV"
        ),
        "Propietario" => array(
            "nombre" => "Lucía Morales",
            "ciudad" => "Caracas",
            "direccion" => "Calle Sur 16"
        )
    ),
    "CQB6338" => array(
        "Auto" => array(
            "marca" => "Hyundai",
            "modelo" => 2022,
            "tipo" => "Sedan"
        ),
        "Propietario" => array(
            "nombre" => "José Herrera",
            "ciudad" => "San Juan",
            "direccion" => "Av. Palma 19"
        )
    ),
    "OGN1464" => array(
        "Auto" => array(
            "marca" => "Tesla",
            "modelo" => 2023,
            "tipo" => "Sedan"
        ),
        "Propietario" => array(
            "nombre" => "Camila Ruiz",
            "ciudad" => "Montevideo",
            "direccion" => "Calle Luna 22"
        )
    ),
    "OIC4194" => array(
        "Auto" => array(
            "marca" => "Kia",
            "modelo" => 2022,
            "tipo" => "SUV"
        ),
        "Propietario" => array(
            "nombre" => "Andrés Castillo",
            "ciudad" => "Asunción",
            "direccion" => "Av. Estrella 30"
        )
    ),
    "XNM1083" => array(
        "Auto" => array(
            "marca" => "Mazda",
            "modelo" => 2023,
            "tipo" => "SUV"
        ),
        "Propietario" => array(
            "nombre" => "Laura Sánchez",
            "ciudad" => "La Paz",
            "direccion" => "Calle Cielo 5"
        )
    ),
    "ZNN5686" => array(
        "Auto" => array(
            "marca" => "Subaru",
            "modelo" => 2021,
            "tipo" => "Station Wagon"
        ),
        "Propietario" => array(
            "nombre" => "Miguel Rivas",
            "ciudad" => "San José",
            "direccion" => "Av. Sol 90"
        )
    ),
    "GRO1161" => array(
        "Auto" => array(
            "marca" => "Ford",
            "modelo" => 2023,
            "tipo" => "Deportivo"
        ),
        "Propietario" => array(
            "nombre" => "Isabel Vegas",
            "ciudad" => "Managua",
            "direccion" => "Calle Flor 11"
        )
    )
);

echo "<h2>Vehículos registrados:</h2>";
echo "<pre>";
print_r($vehiculos);
echo "</pre>";

/*
echo "<h2>Vehículos registrados:</h2>";
foreach($vehiculos as $placa => $datos){
    echo "<b>Placa: $placa </b><br>";
    echo "Marca: ".$datos['Auto']['marca']."<br>";
    echo "Modelo: ".$datos['Auto']['modelo']."<br>";
    echo "Tipo: ".$datos['Auto']['tipo']."<br>";
    echo "Propietario: ".$datos['Propietario']['nombre']."<br>";
    echo "Ciudad: ".$datos['Propietario']['ciudad']."<br>";
    echo "Dirección: ".$datos['Propietario']['direccion']."<br><br>";

}
*/

?>