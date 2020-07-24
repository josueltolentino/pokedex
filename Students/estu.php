<?php

class estu{

    public $id;
    public $nombre;
    public $region;
    public $tipo;
    public $ataque;  
    public $profilePhoto;

    private $utilities;

    public function __construct(){

        $this->utilities = New utilities();

    }

    public function InicializeData($id,$nombre,$region,$tipo,$ataque){
        
        $this->id = $id; 
        $this->nombre = $nombre; 
        $this->region = $region; 
        $this->tipo = $tipo; 
        $this->ataque = $ataque; 
    }

    public function set($data){

        foreach($data as $key => $value) $this->{$key} = $value;
    }

    public function getRegion(){

        if($this->region != 0 && $this->region != null){

            return $this->utilities->region[$this->region];

        }
    }

    public function getTipo(){

        if($this->tipo != 0 && $this->tipo != null){

            return $this->utilities->tipo[$this->tipo]; 

        }
    }

}

?>