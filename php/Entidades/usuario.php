<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
class Usuario{
    
    public $idUsuario;
    public $usuario;
    public $contrasena;
    public $nombre;
    public $apellido1;
    public $apellido2;
    public $email;
    public $telefono;
    public $fec_nac;
    public $pais;
    public $rol;
    
    public function __construct(){
    
    }
    
    /* --------- GETTER Y SETTERS ---------*/
    
    public function getIdUsuario(){
        return $this->idUsuario;
    }
    public function setIdUsuario($idUsuario){
        $this->idUsuario = $idUsuario;
    }
    public function getUsuario(){
        return $this->usuario;
    }
    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }
    public function getContrasena(){
        return $this->contrasena;
    }
    public function setContrasena($contrasena){
        $this->contrasena = $contrasena;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function getApellido1(){
        return $this->apellido1;
    }
    public function setApellido1($apellido1){
        $this->apellido1 = $apellido1;
    }
    public function getApellido2(){
        return $this->apellido2;
    }
    public function setApellido2($apellido2){
        $this->apellido2 = $apellido2;
    }
    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function getTelefono(){
        return $this->telefono;
    }
    public function setTelefono($telefono){
        $this->telefono = $telefono;
    }
    public function getFec_nac(){
        return $this->fec_nac;
    }
    public function setFec_nac($fec_nac){
        $this->fec_nac = $fec_nac;
    }
    public function getPais(){
        return $this->pais;
    }
    public function setPais($pais){
        $this->pais = $pais;
    }
    public function getRol(){
        return $this->rol;
    }
    public function setRol($rol){
        $this->rol = $rol;
    }
}
?>