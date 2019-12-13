<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
class Playlist{
    
    public $idPlaylist;
    public $idUsuario;
    public $nombrePlaylist;
    public $imagen;
    
    public function getIdPlaylist(){
        return $this->idPlaylist;
    }
    public function setIdPlaylist($idPlaylist){
        $this->idPlaylist = $idPlaylist;
    }
    public function getIdUSuario(){
        return $this->idUsuario;
    }
    public function setIdUsuario($idUsuario){
        $this->idUsuario = $idUsuario;
    }
    public function getNombrePlaylist(){
        return $this->nombrePlaylist;
    }
    public function setNombrePlaylist($nombrePlaylist){
        $this->nombrePlaylist = $nombrePlaylist;
    }
    public function getImagen(){
        return $this->imagen;
    }
    public function setImagen($imagen){
        $this->imagen = $imagen;
    }
    public function __construct(){
        
    }
    
    
    
}

?>