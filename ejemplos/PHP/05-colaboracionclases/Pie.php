<?php

class Pie{
    private $mensaje;

    public function __construct($mjs){
        $this->mensaje = $mjs;
    }

    public function graficar(){
        $estilo = 'text-align: center;';
        echo '<h4 style="' . $estilo . '">' . $this->mensaje . '</h4>';
        
    }
}
?>