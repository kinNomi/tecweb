<?php
namespace myapi;

abstract class DataBase {
    protected $conexion;    //ALMACENA LA CONEXION A LA BD

    public function __construct($user, $pass, $db) {
        $this->conexion = @mysqli_connect('localhost', $user, $pass, $db); //SE INTENTA ESTABLECER LA CONEXION 
        if (!$this->conexion) {
            die('Error en la conexión: ' . mysqli_connect_error()); //SI NO SE CONECTA 
        }
        $this->conexion->set_charset("utf8");
    }

}

?>