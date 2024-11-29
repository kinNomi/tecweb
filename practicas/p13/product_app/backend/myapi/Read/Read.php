<?php

namespace TECWEB\MYAPI\Read;

require_once __DIR__ ."/../Database.php";

use TECWEB\MYAPI\Database\Database;

class Read extends Database {

    public function __construct($db,$user = 'root', $pass = 'kin12345') {
        parent::__construct($db,$user,$pass);
    }

    // Método para listar todos los productos
    public function list() {
        $sql = "SELECT * FROM productos WHERE eliminado = 0";
        $result = $this->conexion->query($sql);

        if ($result->num_rows > 0) {
            $this->response = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            $this->response = ['status' => 'error', 'message' => 'No se encontraron productos'];
        }
    }

    // Método para buscar productos por ID, nombre, marca o detalles
    public function search($searchTerm) {
        $sql = "SELECT * FROM productos WHERE (id = '{$searchTerm}' OR nombre LIKE '%{$searchTerm}%' 
                OR marca LIKE '%{$searchTerm}%' OR detalles LIKE '%{$searchTerm}%') AND eliminado = 0";
        $result = $this->conexion->query($sql);

        if ($result->num_rows > 0) {
            $this->response = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            $this->response = ['status' => 'error', 'message' => 'No se encontraron productos'];
        }
    }

    // Método para obtener un solo producto por ID
    public function single($id) {
        $sql = "SELECT * FROM productos WHERE id = {$id} AND eliminado = 0";
        $result = $this->conexion->query($sql);

        if ($result->num_rows > 0) {
            $this->response = $result->fetch_assoc();
        } else {
            $this->response = ['status' => 'error', 'message' => 'Producto no encontrado'];
        }
    }

    // Método para obtener un solo producto por nombre
    public function singleByName($name) {
        $sql = "SELECT * FROM productos WHERE nombre LIKE '%{$name}%' AND eliminado = 0";
        $result = $this->conexion->query($sql);

        if ($result->num_rows > 0) {
            $this->response = $result->fetch_assoc();
        } else {
            $this->response = ['status' => 'error', 'message' => 'Producto no encontrado'];
        }
    }

}