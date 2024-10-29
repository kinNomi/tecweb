<?php
require_once __DIR__ . '/Cabecera.php';
require_once __DIR__ . '/Cuerpo.php';
require_once __DIR__ . '/Pie.php';

class Pagina{
    private $cabecera;
    private $cuerpo;
    private $pie;

    public function __construct($text1, $text2){
        $this->cabecera = new Cabecera($text1);
        $this->cuerpo = new Cuerpo();
        $this->pie = new Pie($text2);
    }

    public function insertar_cuerpo($text){
        $this->cuerpo->insertar_parrafo($text);
    }

    public function graficar(){
        $this->cabecera->graficar();
        $this->cuerpo->graficar();
        $this->pie->graficar();
    }
}
?>