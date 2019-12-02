<?php

class Publicacion{
    
    public $idPublicacion;
    public $titulo;
    public $descripcion;
    public $fecha_publicacion;
    public $valoracion;
    
    public function __construct(){
        
    }
    
    /* --------- GETTER Y SETTERS ---------*/
    
    public function getIdPublicacion(){
        return $this->idPublicacion;
    }
    public function setIdPublicacion($idPublicacion){
        $this->idPublicacion = $idPublicacion;
    }
    public function getTitulo(){
        return $this->titulo;
    }
    public function setTitulo($titulo){
        $this->titulo = $titulo;
    }
    public function getDescripcion(){
        return $this->descripcion;
    }
    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }
    public function getFecha_publicacion(){
        return $this->fecha_publicacion;
    }
    public function setFecha_publicacion($fecha_publicacion){
        $this->fecha_publicacion = $fecha_publicacion;
    }
    public function getValoracion(){
        return $this->valoracion;
    }
    public function setValoracion($valoracion){
        $this->valoracion = $valoracion;
    }
    
}


?>