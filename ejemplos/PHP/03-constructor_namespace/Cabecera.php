<?php
namespace EJEMPLOS\POO; //Se crea este tipo de libreria para poder usar sus clases en otros archivos

class Cabecera{
    private $titulo;
    private $ubicacion;


    public function __construct($title, $location){   //constructor(siempre publico)
        $this->titulo = $title;
        $this->ubicacion = $location;
    }

    public function graficar(){
        $estilo = 'font-size: 40px; text-align: ' . $this->ubicacion;
        echo '<div style="' . $estilo . '">';
        echo '<h4>' . $this->titulo . '</h4>';
        echo '</div>';
    }

}


    class Cabecera2{
        private $titulo;
        private $ubicacion;
        private $enlace;
    
    
        public function __construct($title, $location, $link){   //constructor(siempre publico)
            //inicializamos los atributos
            $this->titulo = $title;
            $this->ubicacion = $location;
            $this->enlace = $link;
        }
    
        public function graficar(){
            $estilo = 'font-size: 40px; text-align: ' . $this->ubicacion;
            echo '<div style="' . $estilo . '">';
            echo '<h4>';
            echo  '<a href="' . $this->enlace . '">' . $this->titulo . '</a>';
            echo '</h4>';
        echo '</div>';
        }

    }

?>  