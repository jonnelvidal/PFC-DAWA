<?php
header("Access-Control-Allow-Origin: *");
class Playlist{
    
    public $idPlaylist;
    public $nombrePlaylist;
    public $numTemas;
    
    public function getidPlaylist(){
        return $this->idPlaylist;
    }
    public function setidPlaylist($idPlaylist){
        $this->idPlaylist = $idPlaylist;
    }
    public function getNombrePlaylist(){
        return $this->nombrePlaylist;
    }
    public function setNombrePlaylist($nombrePlaylist){
        $this->nombrePlaylist = $nombrePlaylist;
    }
    public function getNumTemas(){
        return $this->numTemas;
    }
    public function setNumTemas($numTemas){
        $this->numTemas = $numTemas;
    }
    
    public function __construct(){
        
    }
    
    
}

?