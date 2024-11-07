<?php
namespace myapi;

require_once __DIR__ . '/DataBase.php';  //LLAMA AL ARCHIVO
use myapi\DataBase;     //SE HACE USO DE LA CLASE


class Products extends DataBase
{
    private $data;
    public $response;    


    public function __construct($user, $pass, $db){
        parent::__construct($user, $pass, $db);
        $this->data = [];
        $this->response = [];
    }
}

    


?>