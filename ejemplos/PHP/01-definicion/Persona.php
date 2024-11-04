<?php
class Persona {     //guardar clase y archivo con el mismo nombre
    private $nombre;
    //private $edad;

    public function inicializar($name){
        $this->nombre = $name;
    }
    
    public function mostrar(){
        echo '<p>Nombre: ' . $this->nombre . '</p>';
    }
}



?>