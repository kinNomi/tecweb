<?php

namespace TECWEB\MYAPI\Read;

require_once __DIR__ ."/../DataBase.php";

use TECWEB\MYAPI\Database\DataBase;

class Read extends DataBase {

    public function __construct($db,$user = 'root', $pass = 'kin12345') {
        parent::__construct($db,$user,$pass);
    }

    public function list() {
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        if ( $result = $this->conexion->query("SELECT * FROM productos WHERE eliminado = 0") ) {
            // SE OBTIENEN LOS RESULTADOS
            $rows = $result->fetch_all(MYSQLI_ASSOC);

            if(!is_null($rows)) {
                // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                foreach($rows as $num => $row) {
                    foreach($row as $key => $value) {
                        $this->data[$num][$key] = $value;
                    }
                }
            }
            $result->free();
        } else {
            die('Query Error: '.mysqli_error($this->conexion));
        }
        $this->conexion->close();
    }

    public function search($search) {
        // SE VERIFICA HABER RECIBIDO EL ID
        if( isset($search) ) {
            // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
            $sql = "SELECT * FROM productos WHERE (id = '{$search}' OR nombre LIKE '%{$search}%' OR marca LIKE '%{$search}%' OR detalles LIKE '%{$search}%') AND eliminado = 0";
            if ( $result = $this->conexion->query($sql) ) {
                // SE OBTIENEN LOS RESULTADOS
                $rows = $result->fetch_all(MYSQLI_ASSOC);

                if(!is_null($rows)) {
                    // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                    foreach($rows as $num => $row) {
                        foreach($row as $key => $value) {
                            $this->data[$num][$key] = $value;
                        }
                    }
                }
                $result->free();
            } else {
                die('Query Error: '.mysqli_error($this->conexion));
            }
            $this->conexion->close();
        }
    }

    public function single($id) {
        if( isset($id) ) {
            // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
            if ( $result = $this->conexion->query("SELECT * FROM productos WHERE id = {$id}") ) {
                // SE OBTIENEN LOS RESULTADOS
                $row = $result->fetch_assoc();
    
                if(!is_null($row)) {
                    // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                    foreach($row as $key => $value) {
                        $this->data[$key] = $value;
                    }
                }
                $result->free();
            } else {
                die('Query Error: '.mysqli_error($this->conexion));
            }
            $this->conexion->close();
        }
    }

    public function singleByName($name) {
        if (isset($name)) {
            // Escapar el valor para prevenir inyecciones SQL
            $name = $this->conexion->real_escape_string($name);
    
            // Realizar la consulta a la base de datos
            if ($result = $this->conexion->query("SELECT COUNT(*) AS count FROM productos WHERE nombre = '{$name}' AND eliminado = 0")) {
                // Obtener los resultados
                $row = $result->fetch_assoc();
    
                // Validar si el producto existe
                if (!is_null($row) && $row['count'] > 0) {
                    $this->data = [
                        'exists'  => true,
                        'message' => 'El producto ya existe.'
                    ];
                } else {
                    $this->data = [
                        'exists'  => false,
                        'message' => 'El producto no existe.'
                    ];
                }
                $result->free();
            } else {
                die('Query Error: ' . mysqli_error($this->conexion));
            }
    
            // Cerrar la conexión
            $this->conexion->close();
        }
    }
}