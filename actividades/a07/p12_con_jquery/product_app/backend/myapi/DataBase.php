<?php
namespace MYAPI;

abstract class DataBase {
    protected $conexion;    //ALMACENA LA CONEXION A LA BD

    public function __construct($db, $user, $pass) {
        $this->conexion = @mysqli_connect('localhost', $user, $pass, $db); //SE INTENTA ESTABLECER LA CONEXION 
        if (!$this->conexion) {
            die('Error en la conexión: ' . mysqli_connect_error()); //SI NO SE CONECTA 
        }
    }

}

?>