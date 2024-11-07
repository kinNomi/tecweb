<?php
namespace MYAPI;

require_once __DIR__ . '/DataBase.php';  //LLAMA AL ARCHIVO
use MYAPI\DataBase;     //SE HACE USO DE LA CLASE


class Products extends DataBase
{
    private $response;    


    public function __construct($db, $user='root', $pass='kin12345'){
        parent::__construct($db, $user, $pass);
        $this->response = [];
    }

    //METODOS
    //AGREGAR
    public function add($product){
        $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado) VALUES ('". $product->nombre ."', '". $product->marca ."', '". $product->modelo ."', ". $product->precio .", '". $product->detalles ."', ". $product->unidades .", '". $product->imagen ."', 0)";
        if ($this->conexion->query($sql)) {
            $this->response = ['status' => 'success', 'message' => 'Producto agregado exitosamente'];
        } else {
            $this->response = ['status' => 'error', 'message' => "Error al agregar el producto " . $this->conexion->error];
        }
    }

    //BORRAR
    public function delete($id){
        $sql = "UPDATE productos SET eliminado = 1 WHERE id = $id";
        if ($this -> conexion->query($sql)) {
            $this -> response = ['status' => 'success', 'message' => 'Producto eliminado exitosamente'];
        }else {
            $this -> response = ['status' => 'error', 'message' => 'Error al eliminar el producto'];
        }
    }

    //EDITAR
    public function edit($product){
        $sql = "UPDATE productos SET nombre = '" . $product->nombre . "', marca = '" . $product->marca . "',
        modelo = '" . $product->modelo . "', precio = " . $product->precio . ", detalles = '" . $product->detalles . "',
        unidades = " . $product->unidades . ", imagen = '" . $product->imagen . "' WHERE id = " . $product->id;
        if ($this->conexion->query($sql)) {
            $this->response = ['status' => 'success', 'message' => 'Producto modificado exitosamente'];
        } else {
            $this->response = ['status' => 'error', 'message' => "Error al modificar el producto " . $this->conexion->error];
        }
    }

    //LISTAR
    public function list(){
        $sql = "SELECT * FROM productos WHERE eliminado = 0";
        $result = $this->conexion->query($sql);
        if ($result) {
            $this->response = $result->fetch_all(MYSQLI_ASSOC);
        }else {
            $this->response = ['status' => 'error', 'message' => "No hay productos" . $this->conexion->error];
        }
    }

    //BUSCAR
    public function search($search){
        $sql = "SELECT * FROM productos WHERE ( id LIKE '%" . $search . "%' OR nombre LIKE '%" . $search . "%' 
        OR marca LIKE '%" . $search . "%' OR detalles LIKE '%" . $search . "%') AND eliminado = 0";
        $result = $this->conexion->query($sql);
        if ($result) {
            $this->response = $result->fetch_all(MYSQLI_ASSOC);
        }else {
            $this->response = ['status' => 'error', 'message' => "No se encontraros resultados con su búsqueda" . $this->conexion->error];
        }
    }

    //BUSCAR POR ID
    public function single($id){
        $sql = "SELECT * FROM productos WHERE  id = $id AND eliminado = 0";
        $result = $this->conexion->query($sql);
        if ($result) {
            $this->response = $result->fetch_all(MYSQLI_ASSOC);
        }else {
            $this->response = ['status' => 'error', 'message' => "No se encontró producto con el ID ingresado" . $this->conexion->error];
        }
    }

    //BUSCAR POR NOMBRE
    public function singleByName($name) {
        $sql = "SELECT * FROM productos WHERE nombre = '" . $name . "' AND eliminado = 0";
        $result = $this->conexion->query($sql);
        if ($result) {
            $this->response = $result->fetch_assoc();
        }else {
            $this->response = ['status' => 'error', 'message' => "No se encontró producto con el nombre ingresado" . $this->conexion->error];
        }
    }

    //OBTENER RESPUESTA
    public function getData() {
        return json_encode($this->response, JSON_PRETTY_PRINT);
    }
}
?>