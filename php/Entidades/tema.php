<?php
header("Access-Control-Allow-Origin: *");
class Tema{
    
    public $idTema;
    public $nombre;
    public $archivoTema;
    public $nombreArtista;
    public $duracion;
    public $valoracion;
    public $imagen;
    
    public function __construct(){
        
    }
    
    /* --------- GETTER Y SETTERS ---------*/
    
    public function getIdTema(){
        return $this->idTema;
    }
    public function setIdTema($idTema){
        $this->idTema = $idTema;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function getArchivoTema(){
        return $this->archivoTema;
    }
    public function setArchivoTema($archivoTema){
        $this->archivoTema = $archivoTema;
    }
    public function getNombreArtista(){
        return $this->nombreArtista;
    }
    public function setNombreArtista($nombreArtista){
        $this->nombreArtista = $nombreArtista;
    }
    public function getDuracion(){
        return $this->duracion;
    }
    public function setDuracion($duracion){
        $this->duracion = $duracion;
    }
    public function getValoracion(){
        return $this->valoracion;
    }
    public function setValoracion($valoracion){
        $this->valoracion = $valoracion;
    }
    public function getImagen(){
        return $this->imagen;
    }
    public function setImagen($imagen){
        $this->imagen = $imagen;
    }
}


?>