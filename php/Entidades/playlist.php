<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
class Playlist{
    
    public $idPlaylist;
    public $idUsuario;
    public $nombrePlaylist;
    
    public function getIdPlaylist(){
        return $this->idPlaylist;
    }
    public function setIdPlaylist($idPlaylist){
        $this->idPlaylist = $idPlaylist;
    }
    public function getNombrePlaylist(){
        return $this->nombrePlaylist;
    }
    public function setNombrePlaylist($nombrePlaylist){
        $this->nombrePlaylist = $nombrePlaylist;
    }
    public function getIdUSuario(){
        return $this->idUsuario;
    }
    public function setIdPlaylist($idUsuario){
        $this->idUsuario = $idUsuario;
    }
    public function __construct(){
        
    }
    
    
    
}

?